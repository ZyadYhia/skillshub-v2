<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $data['students'] = User::role(['student'])
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('admin.students.index')->with($data);
    }
    public function showScores($id)
    {
        $data['student'] = User::findOrFail($id);
        if ($data['student']->role->name !== "student") {
            return back();
        }
        $data['exams'] =  $data['student']->exams;
        return view('admin.students.show-score')->with($data);
    }
    public function openExam($studentId, $examId)
    {
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,[
            'status' => 'opened',
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    public function closeExam($studentId, $examId)
    {
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,[
            'status' => 'closed',
        ]);
        return back();
    }
}
