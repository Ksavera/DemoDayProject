<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Like;

class HomeController extends Controller
{


    public function home()
    {
        $profiles = Profile::with('user')->orderBy('views', 'desc')->limit(5)->get();

        $projects = Project::with(['profile', 'likes'])
            ->addSelect([
                'likes_count' => Like::selectRaw('count(*)')
                    ->whereColumn('project_id', 'projects.id')
            ])
            ->orderByDesc('likes_count')
            ->having('likes_count', '>', 0)
            ->limit(5)
            ->get();

        return view('pages.home', ['profiles' => $profiles, 'projects' => $projects]);
    }
}
