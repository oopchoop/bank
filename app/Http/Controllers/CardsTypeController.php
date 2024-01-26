<?php

namespace App\Http\Controllers;

use App\Models\CardsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardsTypeController extends Controller
{
    public function getCardsType()
    {
        if(empty(Auth::user())) return redirect('/auth');

        $result = CardsType::all();

        return $result;
    }
}
