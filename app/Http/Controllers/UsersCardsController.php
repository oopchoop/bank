<?php

namespace App\Http\Controllers;

use App\Models\UsersCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersCardsController extends Controller
{
    public function getUserCards()
    {
        if(empty(Auth::user())) return redirect('/auth');

        $result = UsersCards::query()
            ->select('users_cards.card_number', 'cards.*')
            ->leftJoin('cards', 'cards.id', '=', 'users_cards.card_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return $result;
    }

    public function addCardToUser($id)
    {
        if(empty(Auth::user())) return redirect('/auth');

        $card_number = '';

        for ($i = 1; $i <= 16; $i++)
        {
            $rndNum = mt_rand(0, 9);

            $card_number .= $rndNum;

            if($i != 16 && $i % 4 == 0) $card_number .= ' ';
        }

        $result =
            [
                'user_id' => Auth::user()->id,
                'card_id' => $id,
                'card_number' => $card_number
            ];

        UsersCards::create($result);

        return redirect('/cards');
    }
}
