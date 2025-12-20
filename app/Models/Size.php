<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
  use HasFactory;

  // table name must match migration (plural, lowercase)
  protected $table = 'Size';
  protected $primaryKey = 'id';

  protected $fillable = [
    'label_size',
    'id_category',
  ];

  public function specs()
  {
    return $this->hasMany(ProductVariantSpec::class, 'id_size', 'id');
  }

  public function category()
  {
    return $this->belongsTo(Category::class, 'id_category', 'id');
  }
}
