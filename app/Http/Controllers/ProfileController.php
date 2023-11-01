<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Portfolio;

class ProfileController extends Controller
{

    public function myProfile()
    {
        $profiles = Profile::where('user_id', auth()->id())->get();
        $galleries = [];
        $categories = [];

        if ($profiles->isNotEmpty()) {
            // Assuming there is only one Profile per user

            $Profile = $profiles->first();

            $galleries = Portfolio::where('Profile_id', $Profile->id)->get();
            $categories = $galleries->load('category');
        }

        return view('profile.myProfile', ['profiles' => $profiles, 'galleries' => $galleries, 'categories' => $categories]);
    }




    public function profileView(int $id)
    {
        $profiles = Profile::where('id', $id)->get();

        $galleries = [];
        $categories = [];

        if ($profiles->isNotEmpty()) {
            // Assuming there is only one Profile per user

            $Profile = $profiles->first();

            $galleries = Portfolio::where('Profile_id', $Profile->id)->get();
            $categories = $galleries->load('category');
        }

        return view('profile.myProfile', ['profiles' => $profiles, 'galleries' => $galleries, 'categories' => $categories]);
    }
}
