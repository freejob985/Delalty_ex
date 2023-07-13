<?php
namespace App\Traits;

trait ApiResponseTrait{

private function apiResponse($code=200,$message=null,$errors=null,$data=null){
    
$array=[
    'status'=>$code,
    'message'=>$message
];
if(is_null($data) && !is_null($errors)){
$array['errors']=$errors;
}elseif(!is_null($data) && is_null($errors)){
$array['date']=$data;
}else{
    $array['date']=$data;
    $array['errors']=$errors;
}


return response()->json($array,$code);

}




}