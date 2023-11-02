<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;

class HomeController extends Controller
{


    public function home()
    {
        $profiles = Profile::with('user')->orderBy('views', 'desc')->get();

        $projects = Project::with('profile')->get();

        return view('home', ['profiles' => $profiles, 'projects' => $projects]);
    }
}
