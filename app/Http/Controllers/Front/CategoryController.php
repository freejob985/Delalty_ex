<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    private  $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    public function index()
    {
   
       return $this->apiResponse(200,'success',null,$this->categoryRepository->getAllCategories());
    }


    public function  show($id)
    {
       $category= $this->categoryRepository->getCategoryById($id);
       if($category){
        return $this->apiResponse(200,'success',null,$category);
       }else{
        return $this->apiResponse(200,'category not found');
       }  
    }

function store(CategoryRequest $request){ 
  
    $categoryDetails = $request->only([
   'category_name'
    ]);
return $this->apiResponse(200,'category created successfully',null,$this->categoryRepository->createCategory($categoryDetails));

}



public function destroy($id)
    {
        
       $category= $this->categoryRepository->deleteCategory($id);
       if($category){
        return $this->apiResponse(200,'category deleted successfully',null);
       }else{
        return $this->apiResponse(200,'category not found',null);
       }

}




}