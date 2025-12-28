<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_warna',
        'hex_code'
    ];






    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'id_color', 'id');
    }
}
