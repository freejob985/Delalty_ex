<?php
namespace App\Repositories\Front;
use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryRepository implements CategoryRepositoryInterface {

    public function getAllCategories() 
    {
      $categories=Category::get();
      if($categories){
$categories=CategoryResource::collection($categories);
      }
        return $categories;
    
    }


    public function createCategory(array $CategoryDetails) 
    {
          return Category::create([
            'name'=>$CategoryDetails['category_name']
          ]); 
    }


    public function getCategoryById($id) 
    {
      $category=Category::find($id);
      if($category){
        new CategoryResource($category) ;
      }
      return  $category;
    }
        
    public function updateCategory($categoryId, array $newDetails) 
    {
        return Category::whereId($categoryId)->update($newDetails);
    }

    public function deleteCategory($categoryId) 
    {
        return Category::destroy($categoryId);
        
    }


}