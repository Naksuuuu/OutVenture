<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'Brand';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_brand'];


    public function products()
    {
        return $this->hasMany(Product::class, 'id_brand', 'id');
    }
}
