<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;


class UserManagementController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $users = User::with('userRole')->whereHas('userRole', function ($q) {
                $q->where('role_name', 'user');
            })->get();
            $users = $users->map(function ($user) {
                $attemptedQuestions = $user->answers->count();
                $user->attempted_questions = $attemptedQuestions;
                $user->attempted_answers = $user->answers->count();
                $correctAnswersCount = 0;
                foreach ($user->answers as $answer) {
                    $question = $answer->question;
                    if ($answer->answer == $question->correct_option) {
                        $correctAnswersCount++;
                    }
                }
                $user->correct_answers = $correctAnswersCount;
                return $user;
            });
            return Datatables::of($users)
                ->addColumn('action', function ($user) {
                    $deleteRoute = route('admin.destroy.user', $user->id);
                    return "<a href='javascript:void(0)' data-id='$user->id' class='btn btn-sm btn-primary' id='editModal'>Edit</a>
                            <a href='$deleteRoute' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>";
                })
                ->make(true);
        }
        return view('users.list');
    }
    public function addUser(Request $request){
        $rules = [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
        $messages = [
            'first_name.required' => 'The first name field is required.',
            'first_name.min' => 'The first name must be at least :min characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.min' => 'The last name must be at least :min characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);

        }else{
            $user = User::create([
                    'username'=>$request->first_name.$request->last_name,
                    'password'=>Hash::make($request->password),
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,

            ]);

            UserRole::create([
                'role_name'=>'user',
                'user_id'=>$user->id
            ]);
            return response()->json(['success' =>'User Add Successfully'], 200);
        }
    }
    public function editUser($userId){
        $data = User::where('id',$userId)->first();
        return response()->json(['success' =>'User fetch Successfully','data'=>$data], 200);
    }
    public function deleteUser($userId){
        $user=User::with('userRole')->where('id',$userId)->first();
        if (isset($user)) {
            UserRole::where('id',$userId)->delete();
            User::where('id',$userId)->delete();
            return back()->with('success','User deleted successfully!');
        }else{
            return back()->with('error','User not found!');
        }
    }
    public function updateUser(Request $request){
        $rules = [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2'
        ];
        $messages = [
            'first_name.required' => 'The first name field is required.',
            'first_name.min' => 'The first name must be at least :min characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.min' => 'The last name must be at least :min characters.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            if(isset($request->password)){
                User::where('id',$request->user_id)->update([
                    'username'=>$request->first_name.$request->last_name,
                    'password'=>Hash::make($request->password),
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);
            }else{
                User::where('id',$request->user_id)->update([
                    'username'=>$request->first_name.$request->last_name,
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);
            }
            return response()->json(['success' =>'User Updated Successfully'], 200);
        }
    }

}
