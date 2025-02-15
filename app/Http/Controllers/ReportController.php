<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Report;

class ReportController extends Controller
{
    public function courses()
    {
        $courses = Course::all();

        $i=0;
        foreach ($courses as $course) {
            $data[$i]['id'] = $course->id;
            $data[$i]['name'] = $course->name;
            $data[$i]['description'] = $course->description;
            $data[$i]['count_student'] = $course->enroll_students->count();
            $i++;
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil memuat',
            'data' => $data,
        ]);   
    }

}
