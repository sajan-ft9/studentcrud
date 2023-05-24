@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fs-3">
                    <span>Dashboard</span>
                </div>

                <div class="card-body">
                    <div class="card bg-danger text-center p-2 col-4">
                        <a class="text-decoration-none text-white" href="{{ route('student.list') }}">
                            <h5>Total Students</h5>
                            <div class="card-body">
                                <h4 class="card-text">{{ $total_students }}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection