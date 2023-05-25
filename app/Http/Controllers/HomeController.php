<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_students = Student::count();
        return view('home', compact('total_students'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'email'=>["required","email"],
        ]);
        $user = User::find(auth()->user()->id);
        $user->update(['name'=>$request->name,'email'=>$request->email]);
        return redirect()->back()->with("success", "Name updated successfully");
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password'=>["required"],
            'password'=>['required','min:8','confirmed'],
        ]);
        $user = auth()->user();
        $oldPassword = $request->old_password;

        if (Hash::check($oldPassword, $user->password)) {
            $user = User::find(auth()->user()->id);
            $user->update(['password'=>Hash::make($request->password)]);
            return redirect()->back()->with("success", "Password updated successfully");    
        } else {
            return redirect()->back()->withErrors("Old password is incorrect");
        }
        
    }
}
