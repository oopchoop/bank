<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersCards extends Model
{
    use HasFactory;

    protected $table = 'users_cards';
    protected $fillable =
        [
            'id',
            'user_id',
            'card_id',
            'card_number'
        ];
}
