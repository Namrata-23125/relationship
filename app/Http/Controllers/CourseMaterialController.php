<?php

namespace App\Http\Controllers;

use App\Models\AssignUser;
use Illuminate\Http\Request;
use App\Models\CousreMaterial;

class CourseMaterialController extends Controller
{
    public function index()
    {
        // Fetch course materials from the database
        $courseMaterials = CousreMaterial::all();

        return view('course_material.index', compact('courseMaterials'));

             // Extract data from the request
            $materialId = $request->input('materialId');

            // Save the data to the assign_users table
            $assignUser = new AssignUser;
            $assignUser->material_course_id = $materialId;
            $assignUser->save();
    }

}
