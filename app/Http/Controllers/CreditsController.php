<?php

namespace App\Http\Controllers;

use App\Models\Credits;
use App\Models\UsersCredits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditsController extends Controller
{
    public function getCredits()
    {
        if(empty(Auth::user())) return redirect('/auth');

        return Credits::all();
    }

    public function getCreditFromId($id)
    {
        if(empty(Auth::user())) return redirect('/auth');

        $result = Credits::query()
            ->where('id', '=', $id)
            ->get();

        return $result[0];
    }

    public function updateCredit(Request $request)
    {
        if(empty(Auth::user())) return redirect('/auth');
        else if(!Auth::user()->isAdmin) return redirect('/');

        $creditId = $request['id'];

        Credits::query()
            ->where('id', '=', $creditId)
            ->update(
                [
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'rate' => $request['rate'],
                    'limit' => $request['limit'],
                    'term' => $request['term'],
                    'type_id' => $request['type_id'],
                ]
            );

        $request->session()->regenerate();

        return redirect('/admin');
    }

    public function addNewCredit(Request $request)
    {
        if(empty(Auth::user())) return redirect('/auth');
        else if(!Auth::user()->isAdmin) return redirect('/');

        $object =
            [
                'name' => $request['name'],
                'description' => $request['description'],
                'rate' => $request['rate'],
                'limit' => $request['limit'],
                'term' => $request['term'],
                'type_id' => $request['type_id'],
            ];

        Credits::create($object);

        return redirect('/admin');
    }

    public function deleteCredit($id)
    {
        if(empty(Auth::user())) return redirect('/auth');
        else if(!Auth::user()->isAdmin) return redirect('/');

        UsersCredits::query()
            ->where('credit_id', '=', $id)
            ->delete();

        Credits::query()
            ->where('id', '=', $id)
            ->delete();

        return redirect('/admin');
    }
}
