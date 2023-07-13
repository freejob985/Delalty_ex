<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_image;
use App\Models\Color;
use App\Models\Seller;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'title', 'description', 'price', 'seller_id', 'category_id', 'budget', 'brand', 'views', 'model', 'clicks'
    ];
    public const PATH="images/products";
    function images()
    {
        return $this->hasMany(Product_image::class);
    }

    function colors()
    {
        return $this->hasMany(Color::class);
    }
    function Seller()
    {
        return $this->belongsTo(Seller::class);
    }
    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
