<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Haber extends Model
{
    use HasFactory, SoftDeletes;
    //protected $fillable = ['baslik', 'icerik', 'kategori_id', 'status'];
    protected $guarded = ['id'];

    public static function getAllHaber()
    {
        return self::all();
        // return self::where('status', 1)->get();
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id')->where('status', 1);
    }

    public function getCreatedAtAttribute($value)
    {
        // return Carbon::parse($value)->format('d.M.Y H:i');
        return Carbon::parse($value)->isoFormat('DD MMMM YYYY');
    }
}
