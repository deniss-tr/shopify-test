<?php
namespace Controllers;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../../app/Interfaces/EntitiesListInterface.php';
require_once __DIR__ . '/../../app/Storages/Storage.php';

use GuzzleHttp\Exception\GuzzleException;
use Interfaces\EntitiesListInterface;
use Storages\Storage;

class ProductController extends BaseController implements EntitiesListInterface {
    private const PRODUCT_LIST_ENDPOINT = '/admin/api/2023-07/products.json';

    private $storege;

    public function __construct()
    {
        parent::__construct();
        $this->storege = new Storage;
    }

    /**
     * @return array|mixed|void
     * @throws GuzzleException
     */
    public function getEntities() {
        $this->client = $this->initGuzzleClient();

        try {
            $response = $this->client->request('GET', SELF::PRODUCT_LIST_ENDPOINT);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                $products = $data['products'];
                $productsJson = json_encode($products);
                $storage = $this->storege->getStorage();
                // In task description was mentioned just to save products in storage.
                // Retriving from storage logic vas not mentioned, methods was created but not used.
                $storage->saveData('productList', $productsJson);

                return $products;
            } else {
                echo 'Error: ' . $response->getStatusCode() . ' - ' . $response->getReasonPhrase();
                exit;
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
            exit;
        }
    }
}