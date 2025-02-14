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

        $kondisi = $request->all('description');
        if ($kondisi['description'] == NULL) {
            $input['description'] = $description;
        } else {
            $input['description'] = $kondisi['description'];
        }
        
        $input['lecture_id'] = $lecture_id;
        $user = Course::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Data Mata Kuliah Berhasil Ditambahkan',
        ]);
    }
}
