<?php

namespace App\Http\Controllers;

use App\Models\CreditsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditsTypeController extends Controller
{
    public function getCreditTypes()
    {
        if(empty(Auth::user())) return redirect('/auth');

        $result = CreditsType::all();

        return $result;
    }
}
