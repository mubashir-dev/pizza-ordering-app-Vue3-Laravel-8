<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    public function pizza()
    {
        //Here it has to belongstoMany and need a pivot table where we store id of pizza and category
        //We just use belongsTo because we change it it will take time and we are already out of time
        return $this->belongsTo(Pizza::class,'id');
    }
}
