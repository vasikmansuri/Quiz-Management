<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserQuestionController extends Controller
{
        public function questionList(Request $request){
            $user = auth()->user();
            $userHasStartedTest = $user->started_test;
            if ($userHasStartedTest) {
                $answeredQuestionIds = $user->answers()->pluck('question_id')->toArray();
                $remainingQuestions = Question::whereNotIn('id', $answeredQuestionIds)->get();
            } else {
                $remainingQuestions = [];
            }
            return view('question-answer',compact('userHasStartedTest','remainingQuestions'));
        }
        public function startTest(Request $request){
            $user = auth()->user();
            $user->started_test = true;
            $user->save();
            $answeredQuestionIds = $user->answers()->pluck('question_id')->toArray();

            if(empty($answeredQuestionIds)){
                $question = Question::first();
            }else{
                $question = Question::whereNotIn('id', $answeredQuestionIds)->first();
            }
            if(is_null($question)){
                return back()->with('success','Test Submitted successfully.');
            }else{
                return view('test',compact('question'));
            }
        }
    public function submitAnswer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            //'answer' => 'required|string',
        ]);
        UserAnswer::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
            'answer' => isset($request->answer) ? $request->answer : NULL,
        ]);

        $nextQuestion = Question::whereNotIn('id', Auth::user()->answers()->pluck('question_id'))->first();
        if(!is_null($nextQuestion)){
            return response()->json($nextQuestion);
        }else{
            User::where('id',AUth::user()->id)->update(['started_test' => 2]);
            return response()->json('');
        }
    }

}
