<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Question::all();

            return Datatables::of($data)
                ->addColumn('action', function ($question) {
                    $deleteRoute = route('questions.destroy', $question->id);
                    return "<a href='javascript:void(0)' data-id='$question->id' class='btn btn-sm btn-primary' id='editQuestionModal'>Edit</a>
                            <a href='javascript:void(0)'  data-id='$question->id' id='deleteQuestion' class='btn btn-sm btn-danger'>Delete</a>";
                })
                ->make(true);
        }
        return view('admin.question.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'question' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'time_limit' => 'required|string',
            'correct_option' => 'required|string',
        ];
        $messages = [
            'question.required' => 'Question field is required.',
            'option1.required' => 'Option1 field is required.',
            'option2.required' => 'Option2 field is required.',
            'option3.required' => 'Option3 field is required.',
            'Option4.required' => 'Option4 field is required.',
            'time_limit.required' => 'Time Limit field is required.',
            'correct_option.required' => 'Correct option field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $question = new Question();
            $question->question = $request->question;
            $question->time_limit = $request->time_limit;
            $question->correct_option = $request->correct_option;

            $options = [
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
            ];

            $question->options = json_encode($options);

            $question->save();
            return response()->json(['message' => 'Question and options saved successfully'], 200);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Question::where('id',$id)->first();
        return response()->json(['success' =>'Question fetch Successfully','data'=>$data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $rules = [
            'edit_question' => 'required|string',
            'edit_option1' => 'required|string',
            'edit_option2' => 'required|string',
            'edit_option3' => 'required|string',
            'edit_option4' => 'required|string',
            'edit_time_limit' => 'required|string',
            'edit_correct_option' => 'required|string',
        ];
        $messages = [
            'edit_question.required' => 'Question field is required.',
            'edit_option1.required' => 'Option1 field is required.',
            'edit_option2.required' => 'Option2 field is required.',
            'edit_option3.required' => 'Option3 field is required.',
            'edit_Option4.required' => 'Option4 field is required.',
            'edit_time_limit.required' => 'Time Limit field is required.',
            'edit_correct_option.required' => 'Correct option field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $options = [
                'option1' => $request->edit_option1,
                'option2' => $request->edit_option2,
                'option3' => $request->edit_option3,
                'option4' => $request->edit_option4,
            ];
            Question::where('id',$id)->update([
                'question' => $request->edit_question,
                'time_limit' => $request->edit_time_limit,
                'correct_option' => $request->edit_correct_option,
                'options' =>  json_encode($options)
            ]);
            return response()->json(['success' =>'Question Updated Successfully'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=Question::where('id',$id)->first();
        if (isset($user)) {
            Question::where('id',$id)->delete();
            return back()->with('success','Question deleted successfully!');
        }else{
            return back()->with('error','Question not found!');
        }
    }
}
