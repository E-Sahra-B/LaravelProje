<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Haber extends Model
{
    use HasFactory;
    protected $fillable = ['baslik', 'icerik', 'kategori_id', 'status'];

    public static function getAllHaber()
    {
        return self::all();
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class);
    }
}
