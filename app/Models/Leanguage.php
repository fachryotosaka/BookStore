<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leanguage extends Model
{
    use HasFactory;

    public function books()
    {
        $this->hasMany(Book::class);
    }
}
