<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $table = 'products';
  protected $primaryKey = 'id_product';

  protected $fillable = [
    'id_category',
    'nama_product',
    'brand',
    'deskripsi',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'id_category', 'id_category');
  }

  public function variants()
  {
    return $this->hasMany(ProductVariant::class, 'id_product', 'id_product');
  }
}
