<?php
namespace Model;

require_once __DIR__ . '/../../app/Storages/Storage.php';

use Storages\Storage;
class ProductModel
{
     public function __construct()
     {
        $this->storege = new Storage;
     }

     public function getProductsFromStorage()
     {
        $storageProductsJson = $this->storege->getStorage()->getData('productList');
        $products = json_decode($storageProductsJson, true);

        return $this->getProductsJson($products);
     }

    public function getProductsJson($products)
    {
        $priceInfo = $this->getProductsPriceInfo($products);
        $productsOutput = [
            'products' => $products,
            'productsPriceInfo' => $priceInfo
        ];

        return json_encode($productsOutput);
    }

    public function getProductsPriceInfo($products)
    {
        $productsCount = 0;
        $priceSum = 0;
        $minimumPrice = null;
        $maximumPrice = null;

        foreach($products as $product) {
            $tt = $product;
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

            $test = '';
        }

        $averagePrice = $priceSum / $productsCount;

        return [
            'minimumPrice' => $minimumPrice,
            'maximumPrice' => $maximumPrice,
            'averagePrice' => $averagePrice,
        ];
    }
}