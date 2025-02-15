<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Reply;
use App\Models\Course;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'course_id' => 'exists:App\Models\Course,id',
            'content' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'massage' => 'Ada kesalahan',
                'data' => $validatedData->errors()
            ]);
        }
        $user_id = request()->user()->currentAccessToken()->tokenable['id'];
        $input['course_id'] = $request->input('course_id');
        $input['user_id'] = $user_id;
        $input['content'] = $request->input('content');
        $discussion = Discussion::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan diskusi',
        ]);
    }

    public function reply(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'massage' => 'Ada kesalahan',
                'data' => $validatedData->errors()
            ]);
        }
        $user_id = request()->user()->currentAccessToken()->tokenable['id'];
        $input['discussion_id'] = $id;
        $input['user_id'] = $user_id;
        $input['content'] = $request->input('content');
        $reply = Reply::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan balasan diskusi',
        ]);
    }
}
