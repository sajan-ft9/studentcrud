@extends('layouts.app')

@section('content')
<style>
    tr th,
    td {
        padding: 10px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('student.create') }}" method="POST" enctype="multipart/form-data">
                <div id="first-form">
                    <div class="card">
                        <div class="card-header text-center">
                            <h2>Create Student Profile</h2>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            @csrf

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div>

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="image_path" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gender:</label>
                                    <span class="mx-4">
                                        Male<input class="mx-2" type="radio" name="gender" value="M" required>

                                    </span>
                                    <span class="mx-4">
                                        Female<input class="mx-2" type="radio" name="gender" value="F" required>
                                    </span>
                                    <span class="mx-4">
                                        Others<input class="mx-2" type="radio" name="gender" value="O" required>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">DOB</label>
                                    <input type="date" name="dob" class="form-control" value="{{ old('dob') }}"
                                        required>
                                </div>

                                <p class="btn btn-info w-25" id="nextButton">Next</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="second-form" style="display:none">
                    <div class="card">
                        <div class="card-header text-center">
                            <h2>Create Student Education</h2>
                        </div>
                        <div>
                            <div id="fieldContainer" class="card-body">
                                <table class="col-12 text-center">
                                    <tr>
                                        <th>
                                            <label class="form-label">Level</label>
                                        </th>
                                        <th>
                                            <label class="form-label">College</label>
                                        </th>
                                        <th>
                                            <label class="form-label">University/Board</label>
                                        </th>
                                        <th>
                                            <label class="form-label">Start Date</label>
                                        </th>
                                        <th>
                                            <label class="form-label">End Date</label>
                                        </th>
                                        <th>
                                            <label class="form-label w-100">Delete</label>


                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="level[]" class="form-control" required>

                                        </td>
                                        <td>
                                            <input type="text" name="college[]" class="form-control" required>

                                        </td>
                                        <td>
                                            <input type="text" name="university[]" class="form-control" required>

                                        </td>
                                        <td>
                                            <input type="date" name="start_date[]" class="form-control" required>

                                        </td>
                                        <td>
                                            <input type="date" name="end_date[]" class="form-control" required>

                                        </td>
                                        <td>
                                            <button type="button" class="removeField btn btn-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                                <small id="max-error" class="text-danger"></small>
                            </div>
                            <div class="p-4">
                                <button class="btn btn-info" id="prevButton">Previous</button>

                                <button type="button" class="btn btn-warning" id="addField">+</button>

                                <button type="submit" class="btn btn-success w-25">Create</button>

                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script>
    // show hide
    $(document).ready(function() {
    $("#nextButton").click(function() {
        // Hide the first form
        $("#first-form").hide();
        // Show the second form
        $("#second-form").show();
    });
    });
    $(document).ready(function() {
    $("#prevButton").click(function() {
        // Hide the first form
        $("#first-form").show();
        // Show the second form
        $("#second-form").hide();
    });
    });

    // add
    $(document).ready(function(){
        var count = 1;
        $("#addField").click(function(){
                count++;
                if(count <= 5){
                    $("table tr:last").after(`
                    <tr>
                                <td>
                                    <input type="text" name="level[]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="text" name="college[]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="text" name="university[]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="date" name="start_date[]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="date" name="end_date[]" class="form-control" required>

                                </td>
                                <td>
                                    <button type="button" class="removeField btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                `);
                }else{
                    console.log("Max limit")
                    $("#max-error").html("Max limit is 5");
                }
                
        })
    })

</script>
@endsection