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
            'start_date' => ['required'],
            'end_date' => ['required']
        ]);
    

        $imageName = time() . '.' . $request->image_path->extension();
        $request->image_path->storeAs('students', $imageName, 'public');
        $student_fields['image_path'] = '/storage/students/' . $imageName;

        $student = Student::create($student_fields);
    
        foreach($education_fields['level'] as $key=>$item){
            $education = new Education();
            $education->student_id = $student->id;
            $education->level = $request->level[$key];      
            $education->college = $request->college[$key];      
            $education->university = $request->university[$key];      
            $education->start_date = $request->start_date[$key];      
            $education->end_date = $request->end_date[$key];      
            $education->save();
        }        

        return redirect(route('home'))->with('success', "Student info added successfully");
        
    } 
}
