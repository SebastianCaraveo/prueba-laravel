<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }//relacion inversa uno a uno o uno a muchos, una imagen puede estar en un producto.
}
