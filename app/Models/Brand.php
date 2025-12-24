<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_brand', 'image', 'wide_image', 'logo', 'is_trusted'];


    public function products()
    {
        return $this->hasMany(Product::class, 'id_brand', 'id');
    }
}
