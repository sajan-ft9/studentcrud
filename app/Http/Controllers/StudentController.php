<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function create()
    {
        return view('student.create');
    }
    public function list()
    {
        $students = Student::all();

        return view('student.list',compact('students'));
    }

    public function edit(Student $student)
    {
        return view("student.edit", compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student_fields = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email'],
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

        if ($request->image_path) {

            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('students', $imageName, 'public');
            $student_fields['image_path'] = '/storage/students/' . $imageName;

            $trimmedPath = trim(str_replace("/storage/", "", $student->image_path));

            if (Storage::disk('public')->exists($trimmedPath)) {
    
                Storage::disk('public')->delete($trimmedPath);
         
            }    
        }

        $student->update($student_fields);

        $del_student = Student::find($student->id);

        if ($del_student) {
            // Delete education records where student_id matches student->id
            Education::where('student_id', $student->id)->delete();
        }

        foreach ($education_fields['level'] as $key => $item) {
            $education = new Education();
            $education->student_id = $student->id;
            $education->level = $request->level[$key];
            $education->college = $request->college[$key];
            $education->university = $request->university[$key];
            $education->start_date = $request->start_date[$key];
            $education->end_date = $request->end_date[$key];
            $education->save();
        }

        return redirect("/student/profile/" . $student->id)->with('success', "Student profile updated successfully");
    }

    public function profile(Student $student)
    {
        return view('student.profile', compact('student'));
    }


    public function store(Request $request)
    {

        $student_fields = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
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

        foreach ($education_fields['level'] as $key => $item) {
            $education = new Education();
            $education->student_id = $student->id;
            $education->level = $request->level[$key];
            $education->college = $request->college[$key];
            $education->university = $request->university[$key];
            $education->start_date = $request->start_date[$key];
            $education->end_date = $request->end_date[$key];
            $education->save();
        }

        return redirect(route('student.list'))->with('success', "Student info added successfully");
    }

    public function destroy(Student $student)
    {
        $trimmedPath = trim(str_replace("/storage/", "", $student->image_path));

        if (Storage::disk('public')->exists($trimmedPath)) {

            Storage::disk('public')->delete($trimmedPath);
     
        }
        $student->delete();

        return redirect(route('student.list'))->with('success', "Student data deleted successfully");
    }
}
