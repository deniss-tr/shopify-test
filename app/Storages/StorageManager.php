<?php
namespace Storages;

require_once __DIR__ . '/../../app/Interfaces/StorageInterface.php';

use Interfaces\StorageInterface;

class StorageManager {
    private $storage;

    /**
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage) {
        $this->storage = $storage;
    }

    /**
     * @param $key
     * @param $data
     * @return void
     */
    public function saveData($key, $data) {
        $this->storage->set($key, $data);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getData($key) {
        return $this->storage->get($key);
    }

    /**
     * @param $key
     * @return void
     */
    public function deleteData($key) {
        $this->storage->delete($key);
    }
}


