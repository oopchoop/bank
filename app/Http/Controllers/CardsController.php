<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use App\Models\UsersCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
{
    public function getCards()
    {
        if(empty(Auth::user())) return redirect('/auth');

        return Cards::all();
    }

    public function getCardsFromId($id)
    {
        if(empty(Auth::user())) return redirect('/auth');

        $result = Cards::query()
            ->select('cards.*',
            'cards-type.name as type-name')
            ->leftJoin('cards-type', 'cards-type.id', '=', 'cards.type_id')
            ->where('cards.id', '=', $id)
            ->get();

        return $result[0];
    }

    public function deleteCard($id)
    {
        if(empty(Auth::user())) return redirect('/auth');
        else if(!Auth::user()->isAdmin) return redirect('/');

        UsersCards::query()
            ->where('card_id', '=', $id)
            ->delete();

        Cards::query()
            ->where('id', '=', $id)
            ->delete();

        return redirect('/admin');
    }

    public function updateCard(Request $request)
    {
        if(empty(Auth::user())) return redirect('/auth');
        else if(!Auth::user()->isAdmin) return redirect('/');

        $cardId = $request['id'];

        Cards::query()
            ->where('id', '=', $cardId)
            ->update(
                [
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'service' => strval($request['service']),
                    'limit' => $request['limit'],
                    'type_id' => $request['type_id'],
                ]
            );

        return redirect('/admin');
    }

    public function addNewCard(Request $request)
    {
        if(empty(Auth::user())) return redirect('/auth');
        else if(!Auth::user()->isAdmin) return redirect('/');

        $object =
            [
                'name' => $request['name'],
                'description' => $request['description'],
                'service' => strval($request['service']),
                'limit' => $request['limit'],
                'type_id' => $request['type_id'],
            ];

        Cards::create($object);

        return redirect('/admin');
    }
}
