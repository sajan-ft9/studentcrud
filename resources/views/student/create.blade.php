@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
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

                    <form action="{{ route('student.create') }}" method="POST" enctype="multipart/form-data">
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
                        <div id="first-form">

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
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
                                <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" required>
                            </div>

                            <p class="btn btn-info w-25" id="nextButton">Next</p>
                        </div>
                        <div id="second-form" style="display:none">
                            <div id="fieldContainer">
                                <div class="form-field border-bottom mb-4">
                                    <div class="row">
                                        {{-- <div class="col4"> --}}
                                            {{-- <input type="text" name="field[]"> --}}
                                            {{-- <label class="form-label">Level</label>
                                            <input type="text" name="level" value="{{ old('level') }}"
                                                class="form-control" required>
                                        </div> --}}
                                        <div class="col-4">
                                            <label class="form-label">Level</label>
                                            <input type="text" name="level" value="{{ old('level') }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">College</label>
                                            <input type="text" name="college" class="form-control"
                                                value="{{ old('college') }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label class="form-label">University/Board</label>
                                            <input type="text" name="university" class="form-control"
                                                value="{{ old('university') }}" required>
                                        </div>
                                        <div class="mb-3 row">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" name="start_date" class="form-control"
                                                    value="{{ old('start_date') }}" required>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">End Date</label>
                                                <input type="date" name="end_date" class="form-control"
                                                    value="{{ old('end_date') }}" required>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label w-100">Delete</label>

                                                <button type="button"
                                                    class="removeField btn btn-danger w-100">Delete</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <button type="button" class="btn btn-warning" id="addField">+</button>

                        <button type="submit" class="btn btn-success w-25">Create</button>
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
  // Add new field when the "+" button is clicked
  $("#addField").click(function() {
    var field = $("#fieldContainer .form-field").first().clone();
    field.find("input").val("");
    $("#fieldContainer").append(field);
  });

  // Remove field when the "-" button is clicked
  $(document).on("click", ".removeField", function() {
    var field = $(this).closest(".form-field");
    if ($("#fieldContainer .form-field").length > 1) {
      field.remove();
    } else {
      field.find("input").val("");
    }
  });
});

</script>
@endsection