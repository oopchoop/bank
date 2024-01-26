<?php

namespace App\Http\Controllers;

use App\Models\UsersCredits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class UsersCreditsController extends Controller
{
    public function addStroke(Request $request)
    {
        if(empty(Auth::user())) return redirect('/auth');

        $strDate = \date('Y-m-d');

        $result =
            [
                'user_id' => Auth::user()->id,
                'credit_id' => $request['credit_id'],
                'years' => $request['years'],
                'sum' => $request['sum'],
                'month_pay' => $request['month_pay'],
                'result_sum' => $request['result_sum'],
                'date' => $strDate,
            ];

        UsersCredits::create($result);
    }

    public function getCreditsToUser()
    {
        if(empty(Auth::user())) return redirect('/auth');

        $result = UsersCredits::query()
            ->select('users_credits.*', 'credits.*')
            ->leftJoin('credits', 'credits.id', '=', 'users_credits.credit_id')
            ->where('users_credits.user_id', '=',1)
            ->get();

        return $result;
    }
}


