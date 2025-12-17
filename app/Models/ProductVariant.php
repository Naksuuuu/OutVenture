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
    'sku',
    'harga',
    'stok',
  ];

  protected function casts(): array
  {
    return [
      'harga' => 'decimal:2',
    ];
  }

  public function product()
  {
    return $this->belongsTo(Product::class, 'id_product', 'id');
  }

  public function specs()
  {
    return $this->hasMany(ProductVariantSpec::class, 'id_variant', 'id');
  }
}
