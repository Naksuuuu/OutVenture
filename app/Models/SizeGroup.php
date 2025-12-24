<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SizeGroup extends Model
{
  use HasFactory;

  protected $table = 'size_groups';
  protected $primaryKey = 'id';

  protected $fillable = [
    'nama_group',
  ];

  public function values()
  {
    return $this->hasMany(SizeValue::class, 'id_size_group', 'id');
  }

  public function categories()
  {
    return $this->hasMany(Category::class, 'id_size_group', 'id');
  }
}
