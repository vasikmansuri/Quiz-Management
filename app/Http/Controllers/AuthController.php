<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $user = User::with('userRole')->where('email', $request->email)->first();
        if (isset($user)) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->put('user_id', $user->id);
                if (Auth::user()->userRole->role_name == "admin") {
                    $request->session()->put('user_id', $user->id);
                    return redirect()->route('admin.dashboard')->with('success', 'Successfully Logged in!');
                } else {
                    $request->session()->put('user_id', $user->id);
                    return redirect()->route('dashboard.view')->with('success', 'Successfully Logged in!');
                }
            } else {
                return back()->with('error', 'Invalid Credentials.');
            }
        } else {
            return back()->with('error', 'User Not Found.');
        }
    }

    public function registerAction(Request $request){
        $rules = [
            'firstname' => 'required|string|min:2',
            'lastname' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
        $messages = [
            'firstname.required' => 'The first name field is required.',
            'firstname.min' => 'The first name must be at least :min characters.',
            'lastname.required' => 'The last name field is required.',
            'lastname.min' => 'The last name must be at least :min characters.',
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
                'username'=>$request->firstname.$request->lastname,
                'password'=>Hash::make($request->password),
                'email' => $request->email,
                'first_name' => $request->firstname,
                'last_name' => $request->firstname,

            ]);

            UserRole::create([
                'role_name'=>'user',
                'user_id'=>$user->id
            ]);
            return redirect()->route('login.view')->with('success', 'Registration successfully!');
        }
        return back()->with('error', 'Something went wrong.');
    }

    public function dashboardView()
    {
        return view('dashboard');
    }

    public function adminDashboardView()
    {
        return view('admin-dashboard');
    }

    public function logout()
    {
       Auth::logout();
        return redirect()->route('login.view');
    }
}
