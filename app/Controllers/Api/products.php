<?php
require_once "../ProductController.php";
require_once __DIR__ . '/../../Model/ProductModel.php';

$productModel = new Model\ProductModel();

if (isset($_REQUEST['first'])) {
    // getting products from storage on page load
    $productsInfoJson = $productModel->getProductsFromStorage();
} else {
    // getting products from shopify api
    $controller = new Controllers\ProductController();
    $products = $controller->getEntities();
    $productsInfoJson = $productModel->getProductsJson($products);
}

header('Content-Type: application/json');

echo $productsInfoJson;