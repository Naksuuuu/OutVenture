<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantSpec extends Model
{
  use HasFactory;

  protected $table = 'ProductVariantSpec';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_variant',
    'id_size',
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
    return $this->belongsTo(Size::class, 'id_size', 'id');
  }
}
