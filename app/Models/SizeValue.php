<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeValue extends Model
{
    use HasFactory;

    protected $table = 'size_values';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_size_group',
        'label_size',
        'sort_order',
    ];

    public function group()
    {
        return $this->belongsTo(SizeGroup::class, 'id_size_group', 'id');
    }

    public function specs()
    {
        return $this->hasMany(ProductVariantSpec::class, 'id_size_value', 'id');
    }
}
