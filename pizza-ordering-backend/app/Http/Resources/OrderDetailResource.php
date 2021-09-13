<?php

namespace App\Http\Resources;

use App\Models\Pizza;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            // 'pizza'=>PizzaResource::collection($this->pizza),
            'pizza'=>$this->pizza->title,
            'qty'=>$this->qty,
        ];
    }
}
