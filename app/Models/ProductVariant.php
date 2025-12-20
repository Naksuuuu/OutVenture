<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
  use HasFactory;

  protected $table = 'ProductVariant';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_product',
    'id_color',
    'sku',

  ];



  public function product()
  {
    return $this->belongsTo(Product::class, 'id_product', 'id');
  }

  public function color()
  {
    return $this->belongsTo(Color::class, 'id_color', 'id');
  }

  public function specs()
  {
    return $this->hasMany(ProductVariantSpec::class, 'id_variant', 'id');
  }
}
