<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Location;


class ProfileController extends Controller
{

    public function myProfile()
    {
        $profiles = Profile::where('user_id', auth()->id())->get();
        $projects = [];
        $categories = [];

        if ($profiles->isNotEmpty()) {
            // Assuming there is only one Profile per user

            $profile = $profiles->first();

            $projects = Project::where('profile_id', $profile->id)->get();
            $categories = $projects->load('category');
        }

        return view('pages.myProfile', ['profiles' => $profiles, 'projects' => $projects, 'categories' => $categories]);
    }




    public function profileView(int $id)
    {
        $profiles = Profile::where('id', $id)->get();

        $projects = [];
        $categories = [];

        if ($profiles->isNotEmpty()) {
            // Assuming there is only one Profile per user

            $profile = $profiles->first();

            $profile->increment('views');

            $projects = Project::where('profile_id', $profile->id)->get();
            $categories = $projects->load('category');
        }

        return view('pages.myProfile', ['profiles' => $profiles, 'projects' => $projects, 'categories' => $categories]);
    }

    public function getProfiles()
    {
        $profiles = Profile::with('user')->orderBy('views', 'desc')->get();
        return view('pages.students', ['profiles' => $profiles]);
    }

    public function getStudentsFrom(int $location_id)
    {
        $profiles = Profile::where('location_id', $location_id)->get();
        return view('pages.students', ['profiles' => $profiles]);
    }

    public function getStudentsProfession(int $category_id)
    {
        $profiles = Profile::where('category_id', $category_id)->get();
        return view('pages.students', ['profiles' => $profiles]);
    }


    public function newProfile()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('forms.profileForm', ['categories' => $categories, 'locations' => $locations]);
    }


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

        Profile::create($validated);


        // Redirect to the profile page with a success message
        return redirect()->route('myProfile')->with('success', 'Profile uploaded successfully');
    }

    public function editProfile(int $id)
    {
        $profile = Profile::find($id);
        $categories = Category::all();
        $locations = Location::all();
        if (!$profile) {
            // No profile was found, create an empty Profile object
            $profile = new Profile;
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
                'category' => 'nullable',
                'location' => 'nullable',
            ],

        );

        // Find the profile
        $profile = Profile::findOrFail($id);

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
        $profile->category_id = $validated['category'];
        $profile->location_id = $validated['location'];



        // ... other fields
        $profile->save();

        // Redirect to the profile page with a success message
        return redirect()->route('myProfile')->with('success', 'Profile updated successfully');
    }


    public function deleteProfile(int $id)
    {

        $profile = Profile::find($id);

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
}
