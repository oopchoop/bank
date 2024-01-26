<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersCredits extends Model
{
    use HasFactory;

    protected $table = 'users_credits';
    protected $fillable =
        [
            'id',
            'user_id',
            'credit_id',
            'years',
            'sum',
            'month_pay',
            'result_sum',
            'date'
        ];
}
