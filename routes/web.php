<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// public function deleteFolder()
// {
//    //deleting directory using the storage facade
// }
Route::get('/', function () {
echo"ssss
";

    return view('welcome');
});
