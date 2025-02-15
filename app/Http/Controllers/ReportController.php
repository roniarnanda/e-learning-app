<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Assignment;
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
            'message' => 'Berhasil memuat statistik mata kuliah',
            'data' => $data,
        ], 200);   
    }

    public function assignments()
    {

        $assignments = Assignment::all();
        $i=0;
        foreach ($assignments as $assignment) {
            $submissions = $assignment->submission;
            $data[$i]['id'] = $assignment->id;
            $data[$i]['title'] = $assignment->title;
            $data[$i]['description'] = $assignment->description;
            $data[$i]['all_score'] = $submissions->count();
            $data[$i]['with_score'] = $submissions->where('score')->count();
            $data[$i]['no_score'] = $submissions->where('score', NULL)->count();
            $i++;
        }


        return response()->json([
            'success' => true,
            'message' => 'Berhasil memuat statistik penugasan',
            'data' => $data,
        ], 200);  
    }
}
