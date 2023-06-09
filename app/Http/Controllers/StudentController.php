<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Education;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function create()
    {
        return view('student.create');
    }
    public function list()
    {
        $students = Student::get();

        return view('student.list', compact('students'));
    }

    public function edit(Student $student)
    {
        return view("student.edit", compact('student'));
    }

    public function store(StudentRequest $request)
    {
        $student_fields = $request->only(['name', 'address', 'phone', 'email', 'image_path', 'gender', 'dob', 'dob_bs']);

        if(isset($request->image_path)){
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('students', $imageName, 'public');
            $student_fields['image_path'] = '/storage/students/' . $imageName;    
        };
        
        $student = Student::create($student_fields);

        foreach ($request->level as $key => $item) {
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

    public function update(StudentRequest $request, Student $student)
    {
        $student_fields = $request->only(['name', 'address', 'phone', 'email', 'image_path', 'gender', 'dob', 'dob_bs']);

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

        foreach ($request->level as $key => $item) {
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
