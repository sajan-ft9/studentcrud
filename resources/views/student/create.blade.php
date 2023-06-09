@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/multi-form.css?v2') }}">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ asset('js/multi-form.js?v2') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
			var val	=	{
			    // Specify validation rules
			    rules: {
			      name: "required",
			      email: {
					        required: true,
					        email: true
					      },
					phone: {
						required:true,
						minlength:10,
						maxlength:10,
						digits:true
					},
					// image_path:{
					// 	required:true,            
					// },
					dob:{
						required:true,
					},
					dob_bs:{
						required:true,
					},
					gender:"required",
					"level[]":{
						required:true
					},
					"college[]":{
						required:true
					},
					"university[]":{
						required:true
					},
					"start_date[]":{
						required:true
					},
					"end_date[]":{
						required:true
					},
			    },
			    // Specify validation error messages
			    messages: {
					name: "Name is required",
					address: "Address is required",
					email: {
						required:"Email is required",
						email:"Please enter a valid e-mail",
					},
					phone:{
						required: 	"Phone number is requied",
						minlength: 	"Please enter 10 digit mobile number",
						maxlength: 	"Please enter 10 digit mobile number",
						digits: 	"Only numbers are allowed in this field"
					},
					// image_path:{
					// 	required: "Please upload image.",
					// },
					dob:{
						required: "DOB is required",
					},
					dob_bs:{
						required: "DOB is required",
					},
					gender:{
						required: "Gender is required"
					},
			    },
			}
			$("#myForm").multiStepForm(
			{
				// defaultStep:0,
				beforeSubmit : function(form, submit){
					console.log("called before submiting the form");
					console.log(form);
					console.log(submit);
				},
				validations:val,
			}
			).navigateTo(0);
		});
</script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
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
				<form id="myForm" action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					{{-- @method("PATCH") --}}
					<div class="tab">
						<div class="card">
							<div class="card-header text-center">
								<h2>Create Student Profile</h2>
							</div>
							<!-- One "tab" for each step in the form: -->
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label">Name <span class="text-danger">*</span></label>
									<input type="text" name="name" id="name" class="form-control"
										value="{{ old('name') }}" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Address <span class="text-danger">*</span></label>
									<input type="text" name="address" id="address" class="form-control"
										value="{{ old('address') }}" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Phone <span class="text-danger">*</span></label>
									<input type="tel" name="phone" id="phone" class="form-control"
										value="{{ old('phone') }}" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Email address <span class="text-danger">*</span></label>
									<input type="email" id="email" name="email" class="form-control"
										value="{{ old('email') }}" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Photo</label>
									<input type="file" name="image_path" id="image" class="form-control"
										accept="image/*" onchange="loadFile(event)" id="imgInp" />
									<img class="mt-2" id="output" alt="">
								</div>
								<div class="mb-3">
									<label class="form-label">Gender: <span class="text-danger">*</span></label>
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
								<div class="row">
									<div class="mb-3 col">
										<label class="form-label">DOB (AD)<span class="text-danger">*</span></label>
										<input type="date" name="dob" class="form-control" id="dob"
											value="{{ old('dob') }}" required>

									</div>
									<div class="mb-3 col">
										<label class="form-label">DOB (BS)<span class="text-danger">*</span></label>

										<input required type="text" readonly name="dob_bs" class="form-control"
											id="nepali-datepicker" placeholder="Select Nepali Date" />
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab">
						<div class="card col-12">
							<div class="card-header text-center">
								<h2>Student Education Profile</h2>
							</div>
							<!-- One "tab" for each step in the form: -->
							<div class="card-body">
								<table class="table text-center ">
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
											<input type="text" id="level" name="level[0]" class="form-control" required>

										</td>
										<td>
											<input type="text" id="college" name="college[0]" class="form-control"
												required>

										</td>
										<td>
											<input type="text" id="university" name="university[0]" class="form-control"
												required>

										</td>
										<td>
											<input type="date" id="start_date" name="start_date[0]" class="form-control"
												required>

										</td>
										<td>
											<input type="date" id="end_date" name="end_date[0]" class="form-control"
												required>

										</td>
										<td>
											<button type="button" class=" delete-row btn btn-danger">
												<i class="bi bi-trash" aria-hidden="true"></i>
											</button>
										</td>
									</tr>
								</table>
								<button type="button" class="btn btn-warning" id="addField"><i
										class="bi bi-plus text-white fs-4"></i></button>

								<small id="max-error" class="text-danger"></small>
							</div>
						</div>
					</div>


					<div style="overflow:auto;">
						<div style="float:right; margin-top: 5px;">
							<button type="button" class="previous">Previous</button>
							<button type="button" class="next">Next</button>
							<button type="button" class="submit">Submit</button>
						</div>
					</div>
					<!-- Circles which indicates the steps of the form: -->
					<div style="text-align:center;margin-top:40px;">
						<span class="step">1</span>
						<span class="step">2</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	// add
	   $(document).ready(function(){
        var count = 0;
        $("#addField").click(function(){
               
                if(count < 4){
                    count++;
                console.log("Increased to: ", count)
                    $("table tr:last").after(`
                    <tr>
                                <td>
                                    <input type="text" name="level[${count}]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="text" name="college[${count}]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="text" name="university[${count}]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="date" name="start_date[${count}]" class="form-control" required>

                                </td>
                                <td>
                                    <input type="date" name="end_date[${count}]" class="form-control" required>

                                </td>
                                <td>
                                    <button type="button" class="delete-row btn btn-danger">
                                        <i class="bi bi-trash" aria-hidden="true" ></i>
                                    </button>
                                </td>
                            </tr>
                `);
                }else{
                    console.log("Max limit")
                    $("#max-error").html("Max limit is 5");
                }
                
        })

        $("table").on("click", ".delete-row", function(e){
            e.preventDefault();
            if(count >= 1){
                $(this).parents("tr").remove();
                count--;
                console.log("count after deletion: " , count)
            }else{
                console.log("Only one remaining")
            }   
        })
    })

</script>
<script>
	var loadFile = function(event) {
	  var output = document.getElementById('output');
	  output.height = "100"
	  output.width = "200"
	  output.src = URL.createObjectURL(event.target.files[0]);	
	  output.onload = function() {
		URL.revokeObjectURL(output.src) // free memory
	  }
	};

	// date picker
	
	/* Select your element */
	var mainInput = document.getElementById("nepali-datepicker");
	
	/* Initialize Datepicker with options */
	mainInput.nepaliDatePicker();
</script>
@endsection