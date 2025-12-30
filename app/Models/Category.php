<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model
{
  use HasFactory;
  protected $table = 'categories';
  protected $primaryKey = 'id';

  protected $fillable = [
    'nama_category',
    'image',
    'id_size_group',
    'slug',
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($category) {
      if (empty($category->slug)) {
        $category->slug = $category->generateSlug();
      }
    });

    static::updating(function ($category) {
      if ($category->isDirty('nama_category') && empty($category->slug)) {
        $category->slug = $category->generateSlug();
      }
    });
  }

  protected function generateSlug(): string
  {
    $baseSlug = Str::slug($this->nama_category);
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

  protected static function booted(): void
  {
    static::deleting(function (Category $category) {
      if ($category->image) {
        Storage::disk('public')->delete($category->image);
      }
    });
  }

  public function products()
  {
    return $this->hasMany(Product::class, 'id_category', 'id');
  }

  public function sizeGroup(): BelongsTo
  {
    return $this->belongsTo(SizeGroup::class, 'id_size_group', 'id');
  }
}
