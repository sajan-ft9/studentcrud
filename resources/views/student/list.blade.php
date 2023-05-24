@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="fs-3">Student Info</span>
                    <a class="btn btn-info text-white fs-5" style="float:right" href="{{ route('student.create') }}">Add Student</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (count($students) > 0)

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                            @php
                            $key++
                            @endphp
                            <tr>

                                <th scope="row">{{ $key }}</th>
                                <td>
                                    <a href="/student/profile/{{ $student->id }}">
                                        <img src="{{ asset($student->image_path) }}" alt=""
                                            style="height:50px;  width:50px; border-radius:100%;object-fit:cover">
                                    </a>
                                </td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-danger">
                        <small>No Students registered</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection