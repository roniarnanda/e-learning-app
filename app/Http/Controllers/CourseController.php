<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    public function index()
    {
        // $token = request()->user()->currentAccessToken()->tokenable['id'];
        // return $token;

        $data = Course::all();
        $data['lecture'] = Course::all()->lecture->name;

        return response()->json([
            'success' => false,
            'massage' => 'Berhasil memuat data',
            'data' => $data,
        ]);

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
        $course = Course::findOrFail($id);
        
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
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json([
            'success' => true,
            'massage' => 'Berhasil menghapus mata kuliah',
        ]);
    }
}
