<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;





class PrivateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newProfile()
    {
        return view('forms.profile');
    }


    public function saveProfile(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'first_name' => 'required|min:3|max:200',
                    'last_name' => 'required|min:3|max:200',
                    'profile_image' => 'required|max:10000|mimes:jpg,png',
                    'skills' => 'required|min:3',
                    'about' => 'required|min:3',
                    'location' => 'required|min:3'

                ]
            );

            $validated['profile_image'] = $request->file('profile_image')->store('profilePhotos', 'public');
            $validated['user_id'] = auth()->user()->id;

            Account::create($validated);

            Log::info('Account created successfully: ', ['account_id' => auth()->user()->id]);

            return redirect()->route('profile.myProfile')->with('success', 'Profile uploaded successfully');
        } catch (\Exception $e) {
            return redirect()->route('newProfile')->with('error', 'Failed to upload the profile');
        }
    }

    public function editProfile(int $id)
    {
        $profile = Account::find($id);

        if (!$profile) {
            // No profile was found, create an empty Account object
            $profile = new Account;
        }
        Log::info($profile);
        return view('forms.profile', ['profile' => $profile]);
    }


    public function updateProfile(int $id, Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'first_name' => 'required|min:3|max:200',
                'last_name' => 'required|min:3|max:200',
                'profile_image' => 'required|file|image|max:10000',
                'skills' => 'required|min:3',
                'about' => 'required|min:3',
                'location' => 'required|min:3'
            ]);



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
            $profile->location = $request->input('location');
            // ... other fields
            $profile->save();

            // Redirect to the profile page with a success message
            return redirect()->route('profile.myProfile')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            // Handle the exception, for example log it or show an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function deleteProfile(int $id)
    {
        try {
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

            return redirect()->route('profile.myProfile')->with('success', 'Profile deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Failed to delete the profile');
        }
    }
}
