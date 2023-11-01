<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Portfolio;

class HomeController extends Controller
{


    public function home()
    {
        $profiles = Profile::with('user')->orderBy('views', 'desc')->get();

        $galleries = Portfolio::all();


        return view('home', ['profiles' => $profiles, 'galleries' => $galleries]);
    }
}
