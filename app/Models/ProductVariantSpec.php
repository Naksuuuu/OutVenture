<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantSpec extends Model
{
  use HasFactory;

  protected $table = 'product_variant_specs';
  protected $primaryKey = 'id_spec';

  protected $fillable = [
    'id_variant',
    'id_attribute',
    'value',
  ];

  public function variant()
  {
    return $this->belongsTo(ProductVariant::class, 'id_variant', 'id_variant');
  }

  public function attribute()
  {
    return $this->belongsTo(Attribute::class, 'id_attribute', 'id_attribute');
  }
}
