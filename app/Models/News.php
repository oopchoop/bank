<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $fillable =
        [
          'id',
          'date',
          'name',
          'text',
        ];

    protected $casts = [
        'date' => 'date'
    ];
}
