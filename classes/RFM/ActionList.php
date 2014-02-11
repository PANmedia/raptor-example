<?php
/**
 * RFM\ActionList
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class ActionList extends Action {

    public function __invoke() {
        $path = str_replace(['~', '..'], '', $this->fileManager->getInput('path', '/'));
        $search = $this->fileManager->getInput('search');
        $start = $this->fileManager->getInput('start');
        $limit = intval($this->fileManager->getInput('limit')) ?: 10;
        $sort = $this->fileManager->getInput('sort', 'mtime');
        if ($sort !== 'name' &&
                $sort !== 'type' &&
                $sort !== 'size' &&
                $sort !== 'mtime') {
            $sort = 'mtime';
        }
        $direction = $this->fileManager->getInput('direction', 'desc');
        if ($direction !== 'asc' &&
                $direction !== 'desc') {
            $direction = 'desc';
        }
        $tags = $this->fileManager->getInput('tags', '');
        if ($tags) {
            $tags = explode(',', $this->fileManager->getInput('tags', ''));
        } else {
            $tags = [];
        }

        $json = [
            'directories' => [],
            'tags' => [
                'Image',
                'Document',
            ],
            'files' => [],
            'totalFiles' => 0,
            'currentDirectory' => 0,
            'start' => $start,
            'limit' => $limit,
        ];

        function fileGetExtension($file, $lastDot = true) {
            if (strpos($file, '.') === false) {
                return '';
            }
            $parts = explode('.', $file);
            if ($lastDot) {
                return array_pop($parts);;
            }
            array_shift($parts);
            return implode('.', $parts);
        }

        function fileIsImage($file) {
            $extension = strtolower(fileGetExtension($file));
            return $extension === 'jpg'
                || $extension === 'jpeg'
                || $extension === 'png'
                || $extension === 'gif';
        }

        function getTags($path) {
            $tags = [];
            $extension = strtolower(fileGetExtension($path));
            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    $tags[] = 'Image';
                    break;
                case 'doc':
                case 'docx':
                case 'pdf':
                    $tags[] = 'Document';
                    break;
            }
            return $tags;
        }

        function format($bytes, $decimal_places = 2) {
            $suffix = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            for ($i = 0; $bytes > 1024 && $i < 8; $i++) {
                $bytes /= 1024;
            }
            return round($bytes, $decimal_places).' '.$suffix[$i];
        }

        $result = [];
        $startPath = $this->fileManager->getRoot() . '/' . $path;
        $length = strlen($startPath);
        $stack[] = $startPath;
        foreach (scandir($startPath) as $name) {
            $fullPath = $startPath . '/' . $name;
            if (!$name || $name[0] === '.') {
                continue;
            }
            if (is_dir($fullPath)) {
                $json['directories'][] = $name;
            } elseif (is_file($fullPath)) {
                $json['files'][] = [
                    // Static path example
                    // 'name' => "http://www.my-cloud-storage.com/images/$name",
                    // 'iconSrc' => "http://www.my-cloud-storage.com/images/icons/$name",

                    // Relitive path example
                    'name' => $name,

                    // Required attributes
                    'type' => fileGetExtension($name),
                    'size' => filesize($fullPath),
                    'mtime' => filemtime($fullPath),
                    'tags' => getTags($fullPath),
                ];
            }
        //    $currentDir = array_pop($stack);
        //    if ($next = scandir($currentDir)) {
        //        $i = 0;
        //        while (isset($next[$i])) {
        //            if ($next[$i] !== '.'
        //                    && $next[$i] !== '..') {
        //                $currentFile = "{$currentDir}/{$next[$i]}";
        //                if (is_file($currentFile)) {
        //                    //$json['files'][] = substr("{$currentDir}/{$next[$i]}", $length);
        //                } elseif (is_dir($currentFile)) {
        //                    $json['directories'][] = substr("{$currentDir}/{$next[$i]}", $length);
        //                    $stack[] = $currentFile;
        //                }
        //            }
        //            $i++;
        //        }
        //    }
        }

        // Sort
        usort($json['directories'], function($a, $b) {
            return strcasecmp($a, $b);
        });

        $direction = $direction === 'asc' ? 1 : -1;

        $sortString = function($a, $b) use($direction, $sort) {
            return strcasecmp($a[$sort], $b[$sort]) * $direction;
        };

        $sortNumber = function($a, $b) use($direction, $sort) {
            return ($a[$sort] - $b[$sort]) * $direction;
        };

        switch ($sort) {
            case 'name':
            case 'type': {
                $sortFunction = $sortString;
                break;
            }
            case 'size':
            case 'mtime':
            default: {
                $sortFunction = $sortNumber;
            }
        }

        usort($json['files'], $sortFunction);

        // Total
        $json['total'] = sizeof($json['files']);

        // Filter
        if ($search) {
            $search = str_replace(['*', '%'], ' ', $search);
            $search = preg_quote($search, '/');
            $search = preg_split('/\s+/', $search);
            $search = implode('.*?', $search);
            $search = '/^.*?' . $search . '.*?$/i';
        }
        foreach ($json['files'] as $i => $file) {
            foreach ($tags as $tag) {
                if (!in_array($tag, $file['tags'])) {
                    unset($json['files'][$i]);
                    break;
                }
            }
            if ($search && preg_match($search, $file['name']) === 0) {
                unset($json['files'][$i]);
            }
        }

        // Filtered Total
        $json['filteredTotal'] = sizeof($json['files']);

        // Paginate
        $json['files'] = array_splice($json['files'], $start, $limit);

        // Reindex files for JSON
        $json['files'] = array_values($json['files']);

        echo json_encode($json, JSON_PRETTY_PRINT);

    }

}
