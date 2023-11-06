<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Like;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function getProjects()
    {
        $projects = Project::with(['profile', 'likes'])
            ->addSelect([
                'likes_count' => Like::selectRaw('count(*)')
                    ->whereColumn('project_id', 'projects.id')
            ])
            ->orderByDesc('likes_count')->get();
        return view('pages.projects', ['projects' => $projects]);
    }


    public function newProject()
    {
        return view('forms.projectForm');
    }


    public function saveProject(Request $request)
    {
        logger($request->all());
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|min:3|max:200',
            'description' => 'required|min:3|max:200',
            'github' => 'required|min:3|max:300',
            'photo' => 'required|max:10000|mimes:jpg,png',
        ]);

        $profile = Profile::where('user_id', auth()->id())->first();

        // Handle file upload and save profile
        $validated['photo'] = $request->file('photo')->store('projectPhotos', 'public');
        $validated['profile_id'] = $profile->id;
        $validated['category_id'] = $profile->category_id;

        Project::create($validated);


        // Redirect to the profile page with a success message
        return redirect()->route('myProfile')->with('success', 'Project uploaded successfully');
    }

    public function editProject(int $id)
    {
        $project = Project::find($id);
        $profile = Profile::where('user_id', auth()->id())->first();
        $category_id = $profile->category_id;

        if (!$project) {
            // No profile was found, create an empty Profile object
            $project = new Project;
            $project->profile_id = auth()->id();
        }

        return view('forms.projectForm', ['project' => $project, 'category_id' => $category_id]);
    }




    public function updateProject(int $id, Request $request)
    {
        $validated = $request->validate(

            [
                'name' => 'required|min:3|max:200',
                'description' => 'required|min:3|max:200',
                'github' => 'required|min:3|max:200',
                'photo' => 'nullable|file|image|max:10000',

            ],
            [
                'name.required' => 'Neuzpildytas project name',
                'Profile_id.required' => 'Profile ID is required',
            ]
        );

        $project = Project::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Delete the old image if it exists
            if ($project->photo) {
                Storage::delete('public/' . $project->photo);
            }

            // Store the new image and get the file path
            $filePath = $request->file('photo')->store('projectPhotos', 'public');

            // Update the photo field with the new file path
            $project->photo = $filePath;
        }

        // Update the project with the new data
        $project->name = $validated['name'];
        $project->description = $validated['description'];
        $project->github = $validated['github'];

        $project->save();

        // Redirect to the profile page with a success message
        return redirect()->route('myProfile')->with('success', 'Project updated successfully');
    }


    public function deleteProject(int $id)
    {

        $project = Project::find($id);

        if (!$project) {
            return redirect()->route('pages.myProject')->with('error', 'Project not found');
        }

        // Delete the profile image if it exists
        if ($project->photo) {
            Storage::delete('public/' . $project->photo);
        }

        // Delete the profile record
        $project->delete();

        return redirect()->route('myProfile')->with('success', 'Project deleted successfully');
    }
}
