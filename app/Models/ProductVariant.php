<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductVariant extends Model
{
  use HasFactory;
  protected $table = 'product_variants';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_product',
    'id_color',
    'image',
  ];

  protected static function booted(): void
  {
    static::deleting(function (ProductVariant $variant) {
      if ($variant->image) {
        Storage::disk('public')->delete($variant->image);
      }
    });
  }



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
