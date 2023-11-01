<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function myGallery($id)
    {
        // Find the gallery entry by its ID
        $gallery = Portfolio::find($id);


        // Retrieve the associated account
        $account = Account::find($gallery->account_id);

        return view('profile.myProfile', ['account' => $account, 'gallery' => $gallery]);
    }
}
