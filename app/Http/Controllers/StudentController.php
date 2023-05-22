<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create(){
        return view('student.create');
    }

    public function store(Request $request){
        $student_fields = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'image_path' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:4096'],
            'gender' => ['required'],
            'dob' => ['required', 'date'],
        ]);
        
        $education_fields = $request->validate([
            'level' => ['required'],
            'college' => ['required'],
            'university' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date']
        ]);
        // dd($request);
        $imageName = time() . '.' . $request->image_path->extension();
        $request->image_path->storeAs('students', $imageName, 'public');
        $student_fields['image_path'] = '/storage/students/' . $imageName;

        $student = Student::create($student_fields);
        

        
        
        $education_fields['student_id'] = $student->id;

        Education::create($education_fields);
        
        return redirect('/home')->with('success', "Student info added successfully");
        
    } 
}
