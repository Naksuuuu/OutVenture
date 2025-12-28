<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
  use HasFactory;
  protected $table = 'categories';
  protected $primaryKey = 'id';

  protected $fillable = [
    'nama_category',
    'image',
    'id_size_group'
  ];

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
