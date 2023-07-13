<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'product_id' => $this->id,
            'product_title' => $this->title,
            'product_description' => $this->description,
            'product_name'=>$this->name,
            'product_model'=>$this->model,
            'product_price'=>$this->price,
            'product_clicks'=>$this->clicks,
            'product_views'=>$this->views,
            'seller' => ['name'=>$this->seller->user->name,'seller_id'=>$this->seller->id],
            'product_brand' => $this->brand,
            'product_images'=> ImageResource::collection($this->images)
        ];
    }
}
