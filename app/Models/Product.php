<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'is_active',
        'category_id',
    ];


    public function images(){
        return $this->hasMany(ProductImage::class);
    }//relacion uno a muchos, el producto puede tener muchas imagenes.

    public function category(){
        return $this->belongsTo(Category::class);
    }//relacion uno a uno o uno a mucho, el producto esta en alguna categoria.
}
