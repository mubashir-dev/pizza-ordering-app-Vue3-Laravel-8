<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name'=>$this->name,
            'city'=>$this->city??"N/A",
            'mobile'=>$this->mobile??"N/A",
            'address'=>$this->address??"N/A",
            'orders'=>$this->orders->count('id')??0,
            'created_at'=>$this->created_at->format('Y-m-d'),
            'updated_at'=>$this->updated_at->format('Y-m-d')
        ];

    }
}
