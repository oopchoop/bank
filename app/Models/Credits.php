<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credits extends Model
{
    use HasFactory;

    protected $table = 'credits';
    protected $fillable = [
        'id',
        'name',
        'description',
        'rate',
        'limit',
        'term',
        'type_id',
    ];
}
