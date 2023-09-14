<?php

require "app/Controllers/ProductController.php";
$controller = new Controllers\ProductController();
$products = $controller->getEntities();
foreach ($products as $product) {
    echo 'Product ID: ' . $product['id'] . '<br>';
    echo 'Product Title: ' . $product['title'] . '<br>';
    echo 'Product Price: ' . $product['variants'][0]['price'] . '<br>';
    echo '<hr>';
}
?>