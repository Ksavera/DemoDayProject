<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Portfolio;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function myProfile()
    {
        $profiles = Account::where('user_id', auth()->id())->get();
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





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
