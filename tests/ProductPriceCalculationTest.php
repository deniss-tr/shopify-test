<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/Model/ProductModel.php';

class ProductPriceCalculationTest extends TestCase {
    /**
     * @return void
     */
    public function testMinimumProductPrice() {
        $products = [
            ['id' => '1', 'variants' => [
                0 => [
                    'price' => 10.30
                ]
            ]],
            ['id' => '2', 'variants' => [
                0 => [
                    'price' => 222.20,
                ],
                1 => [
                    'price' => 422.20,
                ]
            ]],
            ['id' => '3', 'variants' => [
                0 => [
                    'price' => 140.50
                ]
            ]],
        ];

        $productModel = new Model\ProductModel();
        $result = $productModel->getProductsPriceInfo($products);
        $this->assertEquals(10.30, $result['minimumPrice']);
        $this->assertEquals(422.20, $result['maximumPrice']);
        $this->assertEquals(198.8, $result['averagePrice']);
    }
}

