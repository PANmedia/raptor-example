<?php
namespace Raptor\CSRF;
use Raptor;

class Example extends Raptor\JsonExample {

    public function __construct($name = null) {
        parent::__construct($name);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function save($file) {
        if (!isset($_POST['csrf'])) {
            http_response_code(400);
            return [
                'csrf' => $this->generateCsrf(),
                'success' => false,
                'message' => 'CSRF token missing.',
            ];
        }
        if (!$this->validateCsrf($_POST['csrf'])) {
            http_response_code(400);
            return [
                'csrf' => $this->generateCsrf(),
                'success' => false,
                'message' => 'CSRF invalid.',
            ];
        }
        if (!parent::saveJson($file)) {
            http_response_code(500);
            return [
                'csrf' => $this->generateCsrf(),
                'success' => false,
                'message' => 'Failed to save content.',
            ];
        }
        return [
            'csrf' => $this->generateCsrf(),
            'success' => true,
        ];
    }

    public function generateCsrf() {
        $token = hash('sha512', mt_rand(0, mt_getrandmax()));
        $_SESSION['csrf-token'] = $token;
        return $token;
    }

    public function validateCsrf($token) {
        if (!isset($_SESSION['csrf-token'])) {
            return false;
        }
        $sessionToken = $_SESSION['csrf-token'];
        unset($_SESSION['csrf-token']);
        return $sessionToken === $token;
    }

}
