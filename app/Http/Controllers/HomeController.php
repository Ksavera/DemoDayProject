<?php

namespace App\Http\Controllers;

use App\Models\Account;



class HomeController extends Controller
{


    public function home()
    {
        $profiles = Account::with('user')->get();


        return view('home', ['profiles' => $profiles]);
    }
}
