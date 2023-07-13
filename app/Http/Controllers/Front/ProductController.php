<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\ProductRepositoryInterface;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageTrait;
use App\Http\Requests\Api\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
class ProductController extends Controller
{
    use ApiResponseTrait,ImageTrait;
    private  $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository) 
    {
        $this->productRepository = $productRepository;
    }


    public function index()
    {
       return $this->apiResponse(200,'success',null,$this->productRepository->getAllProducts());
    }



    public function store(ProductRequest $request)
    {
 
if(!$this->productRepository->findCategory($request->product_category_id) ){
    return $this->apiResponse(401,'validation error',['category'=>"category not found"]);

}
if(!$this->productRepository->findSeller($request->product_seller_id) ){
    return $this->apiResponse(401,'validation error',['seller'=>"seller not found"]);

}

        $productDetails = $request->only([
            'product_name',
            'product_price',
            'product_description',
            'product_title',
            'product_brand',
            'product_model',
            'product_budget',
            'product_category_id',
            'product_seller_id'
        ]);
        return $this->apiResponse(200,'product created successfully',null,$this->productRepository->createProduct($productDetails,$request->product_images));

    }




    public function  show($id)
    {
        
       $product= $this->productRepository->getProductById($id);
       if($product){
        return $this->apiResponse(200,'success',null,$product);
       }else{
        return $this->apiResponse(200,'product not found');
       }

       
    }


    public function destroy($id)
    {
        
       $product= $this->productRepository->deleteProduct($id);
       if($product){
        return $this->apiResponse(200,'product deleted successfully',null);
       }else{
        return $this->apiResponse(200,'product not found',null);
       }

       
    }




}
