<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likes(Request $request, int $id)
    {
        // $userId = auth()->user()->id;

        // Get the authenticated user's ID
        $userId = $request->user()->id;

        $likes = Like::whereHas('user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
            ->whereHas('project', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();

        if ($likes->isEmpty()) {
            // Create a new like record
            Like::create([
                'user_id' => $userId,
                'project_id' => $id,
            ]);
            return response()->json(['message' => 'Project liked']);
        } else {
            $like = $likes->first();
            $like->delete();
            // Like::destroy([
            //     'user_id' => $userId,
            //     'project_id' => $id,
            // ]);

            return response()->json(['message' => 'Project unliked']);
        }
    }
}
