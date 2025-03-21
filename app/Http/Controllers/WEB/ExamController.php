<?php

namespace App\Http\Controllers\web;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id)
    {
        $data['exam'] = Exam::active()->findOrFail($id);
        $data['canEnterExam'] = true;
        $user = Auth::user();
        if ($user !== null) {
            $pivotRow = $user->exams()->where('exam_id', $id)->first();
            if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
                $data['canEnterExam'] = false;
            }
        }

        return view('web.exams.show')->with($data);
    }
    public function questions($examId, Request $request)
    {
        if (session('prev') !== "start/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        $request->session()->flash('prev', "questions/$examId");
        $data['exam'] = Exam::findOrFail($examId);
        return view('web.exams.questions')->with($data);
    }
    public function start($examId, Request $request)
    {
        $user = Auth::user();
        if (!$user->exams->contains($examId)) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
            ]);
        }

        $request->session()->flash('prev', "start/$examId");
        return redirect(url("exams/questions/$examId"));
    }

    public function submit(Request $request, $examId)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4'
        ]);
        if (session('prev') !== "questions/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        //calculating score
        $exam = Exam::findOrFail($examId);
        $points = 0;
        $totalQuesNum = $exam->questions->count();
        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                $userAns = $request->answers[$question->id];
                $rightAns = $question->right_ans;
                if ($userAns == $rightAns) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $totalQuesNum) * 100;

        //calculating time
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();
        $timeMins = $submitTime->diffInMinutes($startTime);

        if ($timeMins > $pivotRow->duration_mins) { //update pivot row
            $score = 0;
        }
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);
        $request->session()->flash('success', "you finished exam successfuly with score: $score %");
        return redirect(url("exams/show/$examId"));
    }
}
