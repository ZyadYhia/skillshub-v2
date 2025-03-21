<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id)
    {
        $exam = Exam::findOrFail($id);
        return new ExamResource($exam);
    }
    public function showQuestions($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        return new ExamResource($exam);
    }
    public function start($examId, Request $request)
    {
        $user = $request->user();
        if (!$user->exams->contains($examId)) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
            ]);
        }
        return response()->json([
            'message' => 'exam begins',
            'token' => $request->bearerToken(),
        ]);
    }
    public function submit(Request $request, $examId)
    {
        $validator = Validator::make($request->all(), [
            'answers' => 'required| ',
            'answers.*' => 'required|in:1,2,3,4'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
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
        $user = $request->user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);
        $message = "exam finished";
        if ($timeMins > $pivotRow->duration_mins) { //update pivot row
            $score = 0;
            $message = "you broked the rules";
        }

        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);

        return response()->json([
            'message' => $message,
            'score' => $score,
        ]);
    }
}
