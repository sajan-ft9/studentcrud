@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-10">
            <div class="row g-0">
                <div class="col-md-4 p-2">
                    <img src="{{ asset($student->image_path == "" ? "images/default.png" : $student->image_path) }}" class="img-fluid  rounded h-100" style="object-fit: cover" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">{{ $student->name }}</h3>
                        <p class="card-text">Email:{{ $student->email }}</p>
                        <p class="card-text">Gender: {{ $student->gender }}</p>
                        <p class="card-text">Phone:{{ $student->phone }}</p>
                        <p class="card-text"><small class="text-body-secondary">DOB:{{ $student->dob }}</small></p>
                        <h3>Educations</h3>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>College</th>
                                    <th>University</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            @foreach ($student->education as $key=>$item)
                            <tr>
                                <td>{{ $item->level }}</td>
                                <td>{{ $item->college }}</td>
                                <td>{{ $item->university }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->end_date }}</td>
                            </tr>
                            @endforeach
                        </table>

                        <div class="my-3">
                            <a style="display:inline-block" href="/student/edit/{{ $student->id }}" class="btn btn-warning text-white">Edit</a>
                            <form style="display:inline-block" action="/student/delete/{{ $student->id }}" method="POST">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection