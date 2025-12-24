<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

  public function products()
  {
    return $this->hasMany(Product::class, 'id_category', 'id');
  }

  public function sizeGroup(): BelongsTo
  {
    return $this->belongsTo(SizeGroup::class, 'id_size_group', 'id');
  }
}
