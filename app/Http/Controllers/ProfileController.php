<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Portfolio;

class ProfileController extends Controller
{
    public function profileView(int $id)
    {
        $profiles = Account::where('id', $id)->get();

        $galleries = [];
        $categories = [];

        if ($profiles->isNotEmpty()) {
            // Assuming there is only one account per user

            $account = $profiles->first();

            $galleries = Portfolio::where('account_id', $account->id)->get();
            $categories = $galleries->load('category');
        }

        return view('profile.myProfile', ['profiles' => $profiles, 'galleries' => $galleries, 'categories' => $categories]);
    }
}
