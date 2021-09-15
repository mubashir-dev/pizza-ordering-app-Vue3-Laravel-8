<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PizzasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'pizza_category'=>$this->category->title??"N/A",
            'pizza_category_id'=>$this->pizza_category_id,
            'description'=>$this->description,
            'photo'=>url($this->photo_url),
            'ingredients'=>json_decode($this->ingredients),
            'price'=>$this->price,
            'tax'=>$this->tax,
            'created_at'=>$this->created_at->format('Y-m-d'),
            'updated_at'=>$this->updated_at->format('Y-m-d')
        ];
    }
}
