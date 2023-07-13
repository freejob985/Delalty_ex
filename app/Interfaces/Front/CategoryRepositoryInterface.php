<?php
namespace App\Interfaces\Front;


interface CategoryRepositoryInterface {


    public function getAllCategories();
    public function getCategoryById($categoryId);
    public function createCategory(array $categoryDetails);
    public function updateCategory($categoryId, array $newDetails);
    public function deleteCategory($categoryId);




}


// Illuminate\Contracts\Container\BindingResolutionException: Target
//  [App\Interfaces\Front\CategoryRepositoryInterface]
//   is not instantiable while building [App\Http\Controllers\Front\CategoryController].
//    in file C:\Users\DELL\Desktop\projects\Delalty\vendor\laravel\framework\src\Illuminate\Container\Container.php on 
//    line 1126
