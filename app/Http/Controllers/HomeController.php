<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Portfolio;

class HomeController extends Controller
{


    public function home()
    {
        $profiles = Account::with('user')->orderBy('views', 'desc')->get();

        $galleries = Portfolio::all();


        return view('home', ['profiles' => $profiles, 'galleries' => $galleries]);
    }
}
