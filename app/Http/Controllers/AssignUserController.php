<?php

namespace App\Http\Controllers;

use App\Models\AssignUser;
use Illuminate\Http\Request;

class AssignUserController extends Controller
{
    public function store(Request $request)
    {
        $user = new AssignUser();
        $user->material_course_id = $request->material_course_id;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $materialId = $request->input('material_course_id');

        // Find and delete the assigned user based on the material ID
        AssignUser::where('material_course_id', $materialId)->delete();

        return response()->json(['success' => true]);
    }
}
