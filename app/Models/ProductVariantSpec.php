<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantSpec extends Model
{
  use HasFactory;
  protected $table = 'product_variant_specs';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_variant',
    'id_size_value',
    'sku',
    'harga',
    'stok',
  ];

  public function variant()
  {
    return $this->belongsTo(ProductVariant::class, 'id_variant', 'id');
  }

  public function size()
  {
    return $this->belongsTo(SizeValue::class, 'id_size_value', 'id');
  }

  public function orderItems()
  {
    return $this->hasMany(OrderItem::class, 'id_variant_spec', 'id');
  }
}
