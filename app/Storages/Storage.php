<?php
namespace Storages;

require_once 'SessionStorage.php';
require_once 'StorageManager.php';

class Storage {
    public function __construct() {
        $this->sessionStorage = new SessionStorage();
    }

    /**
     * @return StorageManager
     */
    public function getStorage() {
        return new StorageManager($this->sessionStorage);
    }
}