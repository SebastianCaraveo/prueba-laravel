<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    //Por si deseas acceder a todos los productos relacionados con una categoría, por ejemplo, cuando quieras listar todos los productos de una categoría.
}
