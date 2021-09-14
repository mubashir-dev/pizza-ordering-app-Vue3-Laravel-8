<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;
    protected $fillable = ['title','pizza_category_id','photo_url','description','ingredients','price','tax'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'];
    public function category()
    {
        return $this->hasOne(PizzaCategory::class);
    }


}
