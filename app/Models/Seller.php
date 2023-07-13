<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Seller extends Model
{
    use HasFactory;

    
function User(){
    return $this->belongsTo(User::class);
 }
}
