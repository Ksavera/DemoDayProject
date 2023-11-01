<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Location;
use App\Models\Portfolio;
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
        return view('forms.profileForm', ['categories' => $categories, 'locations' => $locations]);
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
            'views' => 'default:0',
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

        return view('forms.profileForm', ['profile' => $profile, 'categories' => $categories, 'locations' => $locations]);
    }


    public function updateProfile(int $id, Request $request)
    {
        $validated = $request->validate(

            [
                'first_name' => 'required|min:3|max:200',
                'last_name' => 'required|min:3|max:200',
                'profile_image' => 'nullable|file|image|max:10000',
                'skills' => 'required|min:3',
                'about' => 'required|min:3',
                'linkedin' => 'required|min:3',
                'github' => 'required|min:3',
                'phone' => 'required|min:3',
            ],

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


        $profile->first_name = $validated['first_name'];
        $profile->last_name = $validated['last_name'];
        $profile->skills = $validated['skills'];
        $profile->about = $validated['about'];
        $profile->linkedin = $validated['linkedin'];
        $profile->github = $validated['github'];
        $profile->phone = $validated['phone'];

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
        return view('forms.galleryForm');
    }


    public function saveGallery(Request $request)
    {
        logger($request->all());
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|min:3|max:200',
            'description' => 'required|min:3|max:200',
            'github' => 'required|min:3|max:300',
            'photo' => 'required|max:10000|mimes:jpg,png',
        ]);

        $account = Account::where('user_id', auth()->id())->first();

        // Handle file upload and save profile
        $validated['photo'] = $request->file('photo')->store('projectPhotos', 'public');
        $validated['account_id'] = $account->id;
        $validated['category_id'] = $account->category_id;

        Portfolio::create($validated);


        // Redirect to the profile page with a success message
        return redirect()->route('profile.myProfile')->with('success', 'Gallery uploaded successfully');
    }

    public function editGallery(int $id)
    {
        $gallery = Portfolio::find($id);
        $account = Account::where('user_id', auth()->id())->first();
        $category_id = $account->category_id;

        if (!$gallery) {
            // No profile was found, create an empty Account object
            $gallery = new Portfolio;
            $gallery->account_id = auth()->id();
        }

        return view('forms.galleryForm', ['gallery' => $gallery, 'category_id' => $category_id]);
    }




    public function updateGallery(int $id, Request $request)
    {
        $validated = $request->validate(

            [
                'name' => 'required|min:3|max:200',
                'description' => 'required|min:3|max:200',
                'github' => 'required|min:3|max:200',
                'photo' => 'nullable|file|image|max:10000',

            ],
            [
                'name.required' => 'Neuzpildytas gallery name',
                'account_id.required' => 'Account ID is required',
            ]
        );

        $gallery = Portfolio::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Delete the old image if it exists
            if ($gallery->photo) {
                Storage::delete('public/' . $gallery->photo);
            }

            // Store the new image and get the file path
            $filePath = $request->file('photo')->store('projectPhotos', 'public');

            // Update the photo field with the new file path
            $gallery->photo = $filePath;
        }

        // Update the gallery with the new data
        $gallery->name = $validated['name'];
        $gallery->description = $validated['description'];
        $gallery->github = $validated['github'];



        // ... other fields
        $gallery->save();

        // Redirect to the profile page with a success message
        return redirect()->route('profile.myProfile')->with('success', 'Gallery updated successfully');
    }





    public function deleteGallery(int $id)
    {

        $gallery = Portfolio::find($id);

        if (!$gallery) {
            return redirect()->route('profile.myGallery')->with('error', 'Gallery not found');
        }

        // Delete the profile image if it exists
        if ($gallery->photo) {
            Storage::delete('public/' . $gallery->photo);
        }

        // Delete the profile record
        $gallery->delete();

        return redirect()->route('profile.myProfile')->with('success', 'Gallery deleted successfully');
    }
}
