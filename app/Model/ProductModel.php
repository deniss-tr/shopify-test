<?php
namespace Model;

require_once __DIR__ . '/../../app/Storages/Storage.php';

use Storages\Storage;

class ProductModel
{
    /**
     * @return false|string
     */
    public function getProductsFromStorage()
     {
        $storage = new Storage;
        $storageProductsJson = $storage->getStorage()->getData('productList');

        if (!$storageProductsJson) {
            return '{}';
        }

        $products = json_decode($storageProductsJson, true);

        return $this->getProductsJson($products);
     }

    /**
     * @param $products
     * @return false|string
     */
    public function getProductsJson($products)
    {
        $priceInfo = $this->getProductsPriceInfo($products);
        $productsOutput = [
            'products' => $products,
            'productsPriceInfo' => $priceInfo
        ];

        return json_encode($productsOutput);
    }

    /**
     * @param $products
     * @return array
     */
    public function getProductsPriceInfo($products)
    {
        $productsCount = 0;
        $priceSum = 0;
        $minimumPrice = null;
        $maximumPrice = null;

        foreach($products as $product) {
            $productVariants = $product['variants'];

            foreach($productVariants as $variant) {
                $productsCount++;
                $price = $variant['price'];
                $priceSum += $price;

                if (!$minimumPrice || $minimumPrice > $price) {
                    $minimumPrice = $price;
                }

                if (!$maximumPrice || $maximumPrice < $price) {
                    $maximumPrice = $price;
                }
            }
        }

        $averagePrice = $priceSum / $productsCount;

        return [
            'minimumPrice' => $minimumPrice,
            'maximumPrice' => $maximumPrice,
            'averagePrice' => $averagePrice,
        ];
    }
}