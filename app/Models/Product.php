<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
  use HasFactory;
  protected $table = 'products';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_category',
    'nama_product',
    'id_brand',
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

  public function latestVariant()
  {
    return $this->hasOne(ProductVariant::class, 'id_product', 'id')->latestOfMany();
  }


  public function allSpecs()
  {
    return $this->hasManyThrough(ProductVariantSpec::class, ProductVariant::class, 'id_product', 'id_variant', 'id', 'id');
  }

  public function brand()
  {
    return $this->belongsTo(Brand::class, 'id_brand', 'id');
  }
}
