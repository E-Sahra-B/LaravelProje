<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['ad', 'status'];

    public function haberler()
    {
        return $this->hasMany(Haber::class);
    }
}
