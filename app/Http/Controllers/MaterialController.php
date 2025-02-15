<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class MaterialController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'course_id' => 'exists:App\Models\Course,id',
            'file' => 'required',
        ]);
        
        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'massage' => 'Ada kesalahan',
                'data' => $validatedData->errors()
            ]);
        }

        $input['title'] = $request->input('title');
        $input['course_id'] = $request->input('course_id');
        $input['file_path'] = $request->file(key: 'file')->store('materials');
        
        $data = Material::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Materi Berhasil Ditambahkan',
        ]);
    }

    public function download($id)
    {
        $material = Material::find($id);
        $path = Storage::path($material->file_path);

        return response()->download($path);
    }
}
