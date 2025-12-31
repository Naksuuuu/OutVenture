<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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
    'slug',
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($product) {
      if (empty($product->slug)) {
        $product->slug = $product->generateSlug();
      }
    });

    static::updating(function ($product) {
      if ($product->isDirty('nama_product') && empty($product->slug)) {
        $product->slug = $product->generateSlug();
      }
    });
  }

  protected function generateSlug(): string
  {
    $baseSlug = Str::slug($this->nama_product);
    $slug = $baseSlug;
    $counter = 1;

    while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
      $slug = $baseSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }

  public function getRouteKeyName(): string
  {
    return 'slug';
  }

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
