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

    public function submit(Request $request) 
    {
        $validatedData = Validator::make($request->all(), [
            'assignment_id' => 'exists:App\Models\Assignment,id',
            'file' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'massage' => 'Ada kesalahan',
                'data' => $validatedData->errors()
            ]);
        }

        $student_id = request()->user()->currentAccessToken()->tokenable['id'];
        $input['assignment_id'] = $request->input('assignment_id');
        $input['student_id'] = $student_id;
        $input['file_path'] = $request->file(key: 'file')->store('assignments/submissions');

        $data = Submission::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Materi Berhasil Ditambahkan',
            'data' => $data,
        ]);

    }
}
