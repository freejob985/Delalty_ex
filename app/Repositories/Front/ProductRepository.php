<?php
namespace App\Repositories\Front;
use App\Interfaces\Front\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\User;
use App\Models\Product_image;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Seller;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageTrait;
class ProductRepository implements ProductRepositoryInterface {
use ApiResponseTrait,ImageTrait;

    public function getAllProducts() 
    {
        
        
        // $products= Product::with(['images,product_id','category:id,name','seller:id,name'])->get(['name','title','description','price','brand','budget','model','seller_id','category_id']);
   $products=Product::get();
   if($products){
$products=ProductResource::collection($products);
   }
        return $products;
    
    }

    public function createProduct(array $productDetails,array $images) 
    {
           $product=product::create([
            'name'=>$productDetails['product_name'],
            'price'=>$productDetails['product_price'],
            'description'=>$productDetails['product_description'],
            'title'=>$productDetails['product_title'],
            'brand'=>$productDetails['product_brand'],
            'model'=>$productDetails['product_model'],
            'budget'=>$productDetails['product_budget'],
            'category_id'=>$productDetails['product_category_id'],
            'seller_id'=>$productDetails['product_seller_id'],
           ]);
          
          $images= $this->uploadImages($images,Product::PATH.'/'.$product->id);
           foreach ($images as $image ){
            Product_image::create([
           'image'=>$image,
           'product_id'=>$product->id
               ]);
           }
          
           return new ProductResource($product->load('images'));
       
    }
    public function getProductById($id) 
    {
        $product=Product::find($id);
        if($product){
            $product=new ProductResource($product) ;
        }
       
       
        return $product;
    }

   

    public function updateProduct($productId, array $newDetails) 
    {
        return Product::whereId($productId)->update($newDetails);
    }

    public function deleteProduct($productId) 
    {
        
        
        $product=Product::destroy($productId);
        if($product){
     $this->deleteImages(Product::PATH.'/'.$productId);
        }
        return $product;
    }

    public function findCategory($categoryId){
        return Category::find($categoryId);
    }

    public function findSeller($sellerId){
        return Seller::find($sellerId);
    } 
}