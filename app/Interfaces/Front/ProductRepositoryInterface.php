<?php
namespace App\Interfaces\Front;


interface ProductRepositoryInterface {


    public function getAllProducts();
    public function getProductById($orderId);
    public function createProduct(array $ProductDetails,array $images);
    public function updateProduct($ProductId, array $newDetails);
    public function deleteProduct($ProductId);
    public function findCategory($categoryId);
    public function findSeller($sellerId);


}
