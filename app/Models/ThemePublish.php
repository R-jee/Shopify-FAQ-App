<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThemePublish extends Model
{
    use HasFactory;
    protected $table = 'theme_publish';
    protected $fillable = [
        'theme_id',
    ];
}
