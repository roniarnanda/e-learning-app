<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Course;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'course_id' => 'exists:App\Models\Course,id',
            'description' => 'required',
            'deadline' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'massage' => 'Ada kesalahan',
                'data' => $validatedData->errors()
            ]);
        }

        $input = $request->all();
        $assignment = Assignment::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Data tugas berhasil ditambahkan',
        ]);

    }
    
}
