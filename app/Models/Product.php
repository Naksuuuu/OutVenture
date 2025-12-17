<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $table = 'Product';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_category',
    'nama_product',
    'brand',
    'deskripsi',

  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'id_category', 'id');
  }

  public function variants()
  {
    return $this->hasMany(ProductVariant::class, 'id_product', 'id');
  }
}
