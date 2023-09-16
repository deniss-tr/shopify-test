<?php
namespace Interfaces;

interface StorageInterface {
    public function get($key);
    public function set($key, $value);
    public function delete($key);
}