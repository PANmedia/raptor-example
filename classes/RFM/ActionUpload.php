<?php
/**
 * RFM\ActionUpload
 *
 * @author Michael Robinson <michael@panmedia.co.nz>
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class ActionUpload extends Action {

    const FAILED_OPENING_TEMP = 100;
    const FAILED_INPUT_STREAM = 101;
    const FAILED_OUTPUT_STREAM = 102;
    const FAILED_MOVE_FILE = 103;
    const FAILED_OPENING_TEMP_FILE = 104;
    const FAILED_CREATING_UPLOAD_DIRECTORY = 105;
    const FAILED_SAVING_FILE_DATA = 106;

    public $maxFileAge = 15000;
    public $uploadedFileId = null;
    public $debug = [];

    /**
     * @param  string $file Filename to append to the current upload directory
     * @return string Full path to upload directory or temporary directory, with $file appended if passed
     */
    public function targetDir($file = null) {
        return $this->fileManager->getRoot() . '/' . $file;
    }

    public function getContentType() {
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $this->debug['content_type'] = $_SERVER['CONTENT_TYPE'];
            return $_SERVER['CONTENT_TYPE'];
        } else if (isset($_SERVER['HTTP_CONTENT_TYPE'])) {
            $this->debug['content_type'] = $_SERVER['HTTP_CONTENT_TYPE'];
            return $_SERVER['HTTP_CONTENT_TYPE'];
        }
        return null;
    }

    /**
     * @return integer Current chunk, or 0.
     */
    public function chunk() {
        $this->debug['chunk'] = intval($this->fileManager->getInput('chunk'));
        return intval($this->fileManager->getInput('chunk'));
    }

    /**
     * @return integer Total chunks.
     */
    public function chunks() {
        $this->debug['chunks'] = intval($this->fileManager->getInput('chunks'));
        return intval($this->fileManager->getInput('chunks'));
    }

    /**
     * @return string Uploaded file name.
     */
    public function fileName() {
        $this->debug['file_name'] = $this->fileManager->getInput('name');
        return $this->fileManager->getInput('name');
    }

    /**
     * Handle multipart file uploads.
     *
     * @param  string $filePath Full path to uploaded file
     * @return boolean True if upload was successful
     */
    public function multipart($filePath) {
        $this->debug['multipart'] = true;
        $this->debug['file_path'] = $filePath;
        $uploadedFile = $_FILES['file'];
        $temporaryFileName = false;
        if ($uploadedFile) {
            $temporaryFileName = $uploadedFile['tmp_name'];
        }
        $this->debug['temporay_file'] = $temporaryFileName;
        if (!is_uploaded_file($temporaryFileName)) {
            $this->sendError(self::FAILED_OPENING_TEMP_FILE, 'Failed to open temporary file.');
            return false;
        }

        // Open temp file
        $out = null;
        $this->debug['out'] = "{$filePath}.part";
        if ($this->chunk() === 0) {
            $out = fopen("{$filePath}.part", 'wb');
        } else {
            $out = fopen("{$filePath}.part", 'ab');
        }

        if (!$out) {
            $this->sendError(self::FAILED_OUTPUT_STREAM, 'Failed to open output stream.');
            unlink($temporaryFileName);
            return false;
        }

        // Read binary input stream and append it to temp file
        $in = fopen($_FILES['file']['tmp_name'], 'rb');

        if (!$in) {
            $this->sendError(self::FAILED_INPUT_STREAM, 'Failed to open input stream.');
            fclose($out);
            unlink($temporaryFileName);
            return false;
        }

        while (!feof($in)) {
            fwrite($out, fread($in, 8192));
        }

        fclose($in);
        fclose($out);
        unlink($temporaryFileName);

        return true;
    }

    /**
     * Handle streamed uploads.
     *
     * @param  string $filePath Full path to uploaded file
     * @return boolean True if file was uploaded successfully
     */
    public function stream($filePath) {
        // Open temp file
        $out = fopen("{$filePath}.part", $this->chunk() == 0 ? "wb" : "ab");
        if (!$out) {
            $this->sendError(self::FAILED_OUTPUT_STREAM, 'Failed to open output stream.');
            return false;
        }

        // Read binary input stream and append it to temp file
        $in = fopen('php://input', 'rb');
        if (!$in) {
            $this->sendError(self::FAILED_INPUT_STREAM, 'Failed to open input stream.');
            fclose($out);
            return false;
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        fclose($in);
        fclose($out);
        return true;
    }

    /**
     * Handle file upload, determining type
     */
    function upload() {
        $this->uploadedFileId = basename($this->fileManager->getInput('name'));

        // Clean the fileName for security reasons
        $fileName = $this->fileName();
        $fileName = preg_replace('/[^\w\._]+/', '-', $fileName);
        $fileName = strtolower($fileName);

        // Make sure the fileName is unique but only if chunking is disabled
        $fileExists = file_exists($this->targetDir($fileName));
        $filePath = $this->targetDir($fileName);

        // Create target dir
        if (!file_exists($this->targetDir())) {
            if (!mkdir($this->targetDir())) {
                $this->sendError(self::FAILED_CREATING_UPLOAD_DIRECTORY, 'Failed to create upload directory.');
                return false;
            }
        }

        // Look for the content type header
        $contentType = $this->getContentType();

        // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
        if (strpos($contentType, 'multipart') !== false) {
            if (!$this->multipart($filePath)) {
                return;
            }
        } else {
            if (!$this->stream($filePath)) {
                return false;
            }
        }

        // Check if file has been uploaded, rename it to the desired name if so
        // $completeFilePath = $this->makeFilenameUnique($filePath);
        $completeFilePath = tempnam(sys_get_temp_dir(), 'xmod_file_manager-');
        if ($this->chunks()) {
            $currentChunk = $this->chunk() + 1;
            if ($currentChunk !== $this->chunks()) {
                // Successfully uploaded this chunk
                $this->sendSuccess($fileName, $result);
                return;
            }
        }

        // Final chunk or upload was not chunked, strip the temp .part suffix off
        if (!rename("{$filePath}.part", $completeFilePath)) {
            $this->sendError(self::FAILED_MOVE_FILE, 'Failed to move uploaded chunked file.');
            return false;
        }

        // File has been uploaded successfully
        $newPath = $this->getUniquePath($this->fileManager->getRoot() . '/' . $this->getFileName());
        $newPath = $this->normalisePath($newPath, $this->fileManager->getRoot());

        if (!copy($completeFilePath, $newPath)) {
            $this->sendError(self::FAILED_MOVE_FILE, 'Failed to move uploaded file.');
            return false;
        }

        // Successfully uploaded
        $this->sendSuccess($newPath);
    }

    public function sendSuccess($file) {
        echo json_encode([
            'jsonrpc' => '2.0',
            'result' => basename($file),
            'id' => $this->uploadedFileId,
            'debug' => $this->debug,
        ]);
    }

    public function sendError($code, $message) {
        echo json_encode([
            'jsonrpc' => '2.0',
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
            'id' => $this->uploadedFileId,
        ]);
    }

    /**
     * Make a file name unqiue in a path.
     *
     * @param  string $filePath Full path to file to be made unique.
     * @return string Full path to be used as $filePath's unique name.
     */
     public static function getUniquePath($filePath) {
        $fileName = basename($filePath);
        $directory = dirname($filePath) . '/';
        $i = 2;
        while (file_exists($directory . $fileName)) {
            $parts = explode('.', $fileName);
            // Remove any numbers in brackets in the file name
            $parts[0] = preg_replace('/-([0-9]+)$/', '', $parts[0]);
            $parts[0] .= '-' . $i;
            $new_file_name = implode('.', $parts);
            if (!file_exists($new_file_name)) {
                $fileName = $new_file_name;
            }
            $i++;
        }
        return $directory . $fileName;
    }

    public function normalisePath($filePath, $root) {
        $filePath = substr($filePath, strlen($root));
        $filePath = str_replace('\\', '/', $filePath);
        $filePath = trim($filePath, '/');
        $filePath = strtolower($filePath);
        $filePath = preg_replace('/[^a-z0-9.]+/', '-', $filePath);
        return $root . '/' . $filePath;
    }

    public function getFileName() {
        return $this->uploadedFileId;
    }

    public function __invoke() {
        $this->upload();
    }

}
