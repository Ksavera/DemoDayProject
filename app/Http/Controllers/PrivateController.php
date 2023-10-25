<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;




class PrivateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function newProfile(Request $request)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('forms.profile', ['categories' => $categories, 'locations' => $locations]);
    }

    // Profile
    public function saveProfile(Request $request)
    {
        logger($request->all());
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|min:3|max:200',
            'last_name' => 'required|min:3|max:200',
            'profile_image' => 'required|max:10000|mimes:jpg,png',
            'skills' => 'required|min:3',
            'about' => 'required|min:3',
            'linkedin' => 'required|min:3',
            'github' => 'required|min:3',
            'phone' => 'required|min:3',
            'category' => 'required',
            'location' => 'required',
        ]);

        // Handle file upload and save profile
        $validated['profile_image'] = $request->file('profile_image')->store('profilePhotos', 'public');
        $validated['category_id'] = $request->input('category');
        $validated['location_id'] = $request->input('location');
        $validated['user_id'] = auth()->user()->id;

        Account::create($validated);


        // Redirect to the profile page with a success message
        return redirect()->route('profile.myProfile')->with('success', 'Profile uploaded successfully');
    }

    public function editProfile(int $id)
    {
        $profile = Account::find($id);
        $categories = Category::all();
        $locations = Location::all();
        if (!$profile) {
            // No profile was found, create an empty Account object
            $profile = new Account;
        }

        return view('forms.profile', ['profile' => $profile, 'categories' => $categories, 'locations' => $locations]);
    }


    public function updateProfile(int $id, Request $request)
    {
        $validated = $request->validate(
            [
                'first_name' => 'required|min:3|max:200',
                'last_name' => 'required|min:3|max:200',
                'profile_image' => 'required|file|image|max:10000',
                'skills' => 'required|min:3',
                'about' => 'required|min:3',
                'category' => 'required',
                'location' => 'required'
            ],
            [
                'first_name.required' => 'Neuzpildytas vardas'
            ]
        );

        // Find the profile
        $profile = Account::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('profile_image')) {
            // Delete the old image if it exists
            if ($profile->profile_image) {
                Storage::delete('public/' . $profile->profile_image);
            }

            // Store the new image and get the file path
            $filePath = $request->file('profile_image')->store('profilePhotos', 'public');

            // Update the profile_image field with the new file path
            $profile->profile_image = $filePath;
        }

        // Update the profile with the new data
        $profile->first_name = $request->input('first_name');
        $profile->last_name = $request->input('last_name');
        $profile->skills = $request->input('skills');
        $profile->about = $request->input('about');
        $profile->category_id = $request->input('category');
        $profile->location_id = $request->input('location');
        // ... other fields
        $profile->save();

        // Redirect to the profile page with a success message
        return redirect()->route('profile.myProfile')->with('success', 'Profile updated successfully');
    }

    public function deleteProfile(int $id)
    {

        $profile = Account::find($id);

        if (!$profile) {
            return redirect()->route('profile.myProfile')->with('error', 'Profile not found');
        }

        // Delete the profile image if it exists
        if ($profile->profile_image) {
            Storage::delete('public/' . $profile->profile_image);
        }

        // Delete the profile record
        $profile->delete();

        return redirect()->route('home')->with('success', 'Profile deleted successfully');
    }

    // Gallery

    public function newGallery()
    {
        return view('forms.gallery');
    }


    // public function saveGallery(Request $request)
    // {
    //     // Validate the request
    //     $validated = $request->validate([
    //         'first_name' => 'required|min:3|max:200',
    //         'last_name' => 'required|min:3|max:200',
    //         'profile_image' => 'required|max:10000|mimes:jpg,png',
    //         'skills' => 'required|min:3',
    //         'about' => 'required|min:3',
    //         'location' => 'required|min:3'
    //     ]);

    //     // Handle file upload and save profile
    //     $validated['profile_image'] = $request->file('profile_image')->store('profilePhotos', 'public');
    //     $validated['user_id'] = auth()->user()->id;
    //     Account::create($validated);

    //     Log::info('Account created successfully: ', ['account_id' => auth()->user()->id]);

    //     // Redirect to the profile page with a success message
    //     return redirect()->route('profile.myProfile')->with('success', 'Profile uploaded successfully');
    // }
}
