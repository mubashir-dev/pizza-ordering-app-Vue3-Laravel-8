<?php

namespace App\Http\Resources;

use App\Models\OrderDetails;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $thisuest
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'order_no'=>$this->order_no,
            'customer_id'=>$this->customer->id,
            'customer_name'=>$this->customer->name,
            'mobile'=>$this->customer->mobile,
            'city'=>$this->customer->city,
            'address'=>$this->customer->address,
            'total_amount'=>$this->total_amount,
            'total_tax'=>$this->total_tax_amount,
            'order_details'=> OrderDetailResource::collection($this->orderDetails),
            'status'=>$this->status=='true'?'The Order has Closed':'The  Order is Pending',
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
