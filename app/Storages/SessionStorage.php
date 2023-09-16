<?php
namespace Storages;

require_once __DIR__ . '/../../app/Interfaces/StorageInterface.php';

use Interfaces\StorageInterface;

class SessionStorage implements StorageInterface {
    public function __construct() {
        $this->sessionInit();
    }

    /**
     * @return void
     */
    private function sessionInit()
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return void
     */
    public function delete($key) {
        $_SESSION[$key] = null;
    }
}