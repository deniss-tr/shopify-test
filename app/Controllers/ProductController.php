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
        $this->client = $this->initGuzzleClient();
    }

    /**
     * @return array|mixed|void
     * @throws GuzzleException
     */
    public function getEntities() {
        if (!$this->client) {
            $error = json_encode(['error' => 'Service unavailable']);
            echo $error;
            exit;
        }

        try {
            // fetching products
            $response = $this->client->request('GET', SELF::PRODUCT_LIST_ENDPOINT);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                $products = $data['products'];
                $productsJson = json_encode($products);
                // saving fetched products to storage
                $storage = $this->storege->getStorage();
                $storage->saveData('productList', $productsJson);

                return $products;
            } else {
                $errorMessage = 'Error: ' . $response->getStatusCode() . ' - ' . $response->getReasonPhrase();
                $error = json_encode(['error' => $errorMessage]);
                echo $error;
                exit;
            }
        } catch (\Exception $e) {
            $errorMessage = 'Error: ' . $e->getMessage();
            $error = json_encode(['error' => $errorMessage]);
            echo $error;
            exit;
        }
    }
}