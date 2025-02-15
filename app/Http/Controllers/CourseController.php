<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::all();
        foreach ($data as $dt) {
            $dt->lecture->name;
        }
        return response()->json([
            'success' => true,
            'massage' => 'Berhasil memuat data',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {

        $lecture_id = request()->user()->currentAccessToken()->tokenable['id'];

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
        ]);


        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'massage' => 'Ada kesalahan',
                'data' => $validatedData->errors()
            ]);
        }

        $description = ' ';
        $input = $request->all();

        $check_desc = $request->input('description');
        if ($check_desc == NULL) {
            $input['description'] = $description;
        } else {
            $input['description'] = $check['description'];
        }
        
        $input['lecture_id'] = $lecture_id;
        $user = Course::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Data Mata Kuliah Berhasil Ditambahkan',
        ]);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        
        $check_name = $request->input('name');
        if ($check_name != NULL) {
            $course->name = $request->input('name');
        }
        $check_desc = $request->input('description');
        if ($check_desc != NULL) {
            $course->description = $request->input('description');
        }
        $course->save();

        return response()->json([
            'success' => true,
            'massage' => 'Berhasil mengubah data mata kuliah',
            'data' => $course,
        ]);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return response()->json([
            'success' => true,
            'massage' => 'Berhasil menghapus mata kuliah',
        ]);
    }

    public function enroll($id)
    {
        $student_id = request()->user()->currentAccessToken()->tokenable['id'];
        $user = User::find($student_id);
        $course_id = DB::table('student_courses')->where('course_id', $id)->first('course_id');
        if ($course_id == NULL) {
            $user->enroll_courses()->attach($id);
        }

        return response()->json([
            'success' => true,
            'massage' => 'Mahasiswa berhasil mendaftar mata kuliah',
        ]);
    }
}
