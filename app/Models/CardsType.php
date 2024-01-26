<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsType extends Model
{
    use HasFactory;

    protected $table = 'cards-type';

    protected $fillable =
        [
            'id',
            'name'
        ];
}
