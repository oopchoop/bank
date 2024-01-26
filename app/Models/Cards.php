<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    protected $table = 'cards';
    protected $fillable =
        [
          'id',
          'name',
          'description',
          'service',
          'limit',
          'type_id',
        ];
}
