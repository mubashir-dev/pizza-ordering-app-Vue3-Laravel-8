<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','pizza_id','qty'];

    public function pizza()
    {
        return $this->hasOne(Pizza::class,'id','pizza_id');
    }
}
