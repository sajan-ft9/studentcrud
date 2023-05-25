@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-profile.css') }}">
<div class="container mt-5">

    <div class="row d-flex justify-content-center">

        <div class="col-md-8">

            <div class="card p-3 py-4">
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white">{{ auth()->user()->name }}</span>
                    <h5 class="mt-2 mb-0"></h5>
                    <span>{{ auth()->user()->email }}</span>

                    <div class="px-4 mt-1">
                        <p class="fonts">Welcome to your profile.</p>

                    </div>

                    <div class="row">
                        <div class="text-center">
                            <h4>UPDATE PROFILE</h4>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="col">

                            <form action="/admin/update" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <input name="name" type="text" class="form-control" placeholder="Update Display Name" value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <input name="email" type="email" class="form-control" placeholder="Update email" value="{{ auth()->user()->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary px-4 ms-3 text-white">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="col">

                            <form action="/admin/update_password" method="post">
                                @csrf
                                @method('patch')
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="old_password" placeholder="Old Password" required>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="password" placeholder="New Password" required>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                                <button class="btn btn-outline-primary px-4">
                                    Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection