<?php
namespace Storages;

require_once __DIR__ . '/../../app/Interfaces/StorageInterface.php';

use Interfaces\StorageInterface;

class StorageManager {
    private $storage;

    public function __construct(StorageInterface $storage) {
        $this->storage = $storage;
    }

    public function saveData($key, $data) {
        $this->storage->set($key, $data);
    }

    public function getData($key) {
        return $this->storage->get($key);
    }

    public function deleteData($key) {
        $this->storage->delete($key);
    }
}


