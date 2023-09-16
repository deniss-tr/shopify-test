<?php
require_once "../ProductController.php";
require_once __DIR__ . '/../../Model/ProductModel.php';

$productModel = new Model\ProductModel();

if (isset($_REQUEST['first'])) {
    $productsInfoJson = $productModel->getProductsFromStorage();
} else {
    $controller = new Controllers\ProductController();
    $products = $controller->getEntities();
    $productsInfoJson = $productModel->getProductsJson($products);
}

header('Content-Type: application/json');

echo $productsInfoJson;