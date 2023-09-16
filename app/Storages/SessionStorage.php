<?php
namespace Storages;

require_once __DIR__ . '/../../app/Interfaces/StorageInterface.php';

use Interfaces\StorageInterface;

class SessionStorage implements StorageInterface {
    public function __construct() {
        $this->sessionInit();
    }

    private function sessionInit()
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function delete($key) {
        $_SESSION[$key] = null;
    }
}