<?php

namespace App\Http\Controllers;

use App\Models\Account;



class HomeController extends Controller
{
    public function homePage()
     $profiles = Account::get();


        return view('profile.myProfile', ['profiles' => $profiles]);
}
