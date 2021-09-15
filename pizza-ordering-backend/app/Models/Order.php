<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['order_no', 'customer_id', 'total_amount', 'total_tax_amount', 'status'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $hidden = ['pivot'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public function customer()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }

}
