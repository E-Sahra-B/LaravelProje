<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stoktakip extends Model
{
    use HasFactory;
    protected $table = 'stoktakips';
    protected $fillable = ['urun_adi', 'urun_fiyati', 'urun_stok', 'user_id'];
}
