<?php
namespace App\Traits;

trait ImageTrait{
// upload folder
private function uploadImages($images,$path){
    $images_name=[];
foreach($images as $image){
    $image_name='product-'.time().'.'.$image->getClientOriginalExtension();
    $image->move(public_path($path),$image_name);
    $images_name[]=$image_name; 
}
return $images_name;
}



// upload file

private function uploadImage($file,$path,$old_file=null){
    
    if($old_file !=null){
        $this->delete_file($old_file,$path);
    }
    $file_name=time().'-'.'.'.$file->getClientOriginalExtension();
    $file->move(public_path($path),$file_name);
    return $file_name;
}

// delete file
private function deleteImage($path){

if(file_exists($path)){
    unlink($path);
}
}



// delete folder
function deleteImages($path)
{
    $path=public_path($path);
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file)
        {
            
            $this->deleteImage($path.'/'.$file);
        }

         rmdir($path);
    }

    else if (is_file($path) === true)
    {
        $this->deleteImage($path);
    }

   
}




}
