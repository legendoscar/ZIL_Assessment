@extends('layouts.app')
@section('title')
Create User
@endsection

@section('custom_css')

<style type="text/css">
	body{margin-top:20px;
	color: #9b9ca1;
	}
	.bg-secondary-soft {
	    background-color: rgba(208, 212, 217, 0.1) !important;
	}
	.rounded {
	    border-radius: 5px !important;
	}
	.py-5 {
	    padding-top: 3rem !important;
	    padding-bottom: 3rem !important;
	}
	.px-4 {
	    padding-right: 1.5rem !important;
	    padding-left: 1.5rem !important;
	}
	.file-upload .square {
	    height: 250px;
	    width: 250px;
	    margin: auto;
	    vertical-align: middle;
	    border: 1px solid #e5dfe4;
	    background-color: #fff;
	    border-radius: 5px;
	}
	.text-secondary {
	    --bs-text-opacity: 1;
	    color: rgba(208, 212, 217, 0.5) !important;
	}
	.btn-success-soft {
	    color: #28a745;
	    background-color: rgba(40, 167, 69, 0.1);
	}
	.btn-danger-soft {
	    color: #dc3545;
	    background-color: rgba(220, 53, 69, 0.1);
	}
	.form-control {
	    display: block;
	    width: 100%;
	    padding: 0.5rem 1rem;
	    font-size: 0.9375rem;
	    font-weight: 400;
	    line-height: 1.6;
	    color: #29292e;
	    background-color: #fff;
	    background-clip: padding-box;
	    border: 1px solid #e5dfe4;
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    appearance: none;
	    border-radius: 5px;
	    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
	    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
	    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
	    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
	}

</style>


@endsection



@section('content')
	<!-- <div class="container"> -->
		<div class="row">
			<div class="col-12">
				<!-- Page title -->
				<div class="my-2">
					<h3>Register</h3>
					<hr>
				</div>
				<!-- Form START -->
				<form class="file-upload" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
					@csrf
					<div class="row mb-5 gx-5">
						<!-- Contact detail -->
						<div class="col-xxl-8 mb-2 mb-xxl-0">
							<!-- @if ($errors->any())
		    					<div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif -->

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
							<div class="bg-secondary-soft px-4 py-1 rounded">
								<div class="row g-3">
									<!-- <h4 class="mb-4 mt-0">Contact detail</h4> -->
									<!-- Prefix Name -->
									<div class="col-md-12">
										<label class="form-label">Prefix Name</label>
										<select name="prefixname" class="form-control form-select-lg" aria-label="Prefix name">
											<option selected>Select:</option>
											<option {{ old('prefixname') == 'Mr' ? 'selected="slected"' : ''}} value="Mr">Mr</option>
											<option {{ old('prefixname') == 'Mrs' ? 'selected="selected"' : ''}} value="Mrs">Mrs</option>
											<option {{ old('prefixname') == 'Ms' ? 'selected="selected"' : ''}} value="Ms">Ms</option>
										</select>
                                        @if($errors->has('prefixname'))
                                            <div class="alert alert-danger">{{ $errors->first('prefixname') }}</div>
                                        @endif
										<!-- <input type="text" name="firstname" class="form-control" placeholder="" aria-label="First name" value="Scaralet"> -->
									</div>
									<!-- First Name -->
									<div class="col-md-6">
										<label class="form-label">First Name *</label>
										<input type="text" name="firstname" class="form-control"  placeholder="First name" aria-label="First name" value="{{ old('firstname') }}" autocomplete="First name" autofocus>
										@if($errors->has('firstname'))
                                            <div class="alert alert-danger">{{ $errors->first('firstname') }}</div>
                                        @endif
									</div>
									<!-- Middle Name -->
									<div class="col-md-6">
										<label class="form-label">Middle Name</label>
										<input type="text" name="middlename" class="form-control" placeholder="Middle name" aria-label="Middle name" value="{{ old('middlename') }}" autocomplete="Middle name">
										@if($errors->has('middlename'))
                                            <div class="alert alert-danger">{{ $errors->first('middlename') }}</div>
                                        @endif
									</div>
									<!-- Last name -->
									<div class="col-md-6">
										<label class="form-label">Last Name *</label>
										<input type="text" name="lastname" class="form-control"  placeholder="Last name" aria-label="Last name" value="{{ old('lastname') }}" autocomplete="Last name">
										@if($errors->has('lastname'))
                                            <div class="alert alert-danger">{{ $errors->first('lastname') }}</div>
                                        @endif
									</div>
									<!-- Suffix name -->
									<div class="col-md-6">
										<label class="form-label">Suffix Name</label>
										<input type="text" name="suffixname" class="form-control" placeholder="Suffix name" aria-label="Suffix name" value="{{ old('suffixname') }}" autocomplete="Suffix name">
										@if($errors->has('lastname'))
                                            <div class="alert alert-danger">{{ $errors->first('lastname') }}</div>
                                        @endif
									</div>
									<!-- Suffix name -->
									<div class="col-md-6">
										<label class="form-label">User Name *</label>
										<input type="text" name="username" class="form-control"  placeholder="User name" aria-label="User name" value="{{ old('username') }}" autocomplete="User name">
										@if($errors->has('username'))
                                            <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                                        @endif
									</div>
									<!-- Email -->
									<div class="col-md-6">
										<label for="email" class="form-label">Email *</label>
										<input type="email" name="email" class="form-control" id="email"  placeholder="Email" ria-label="Email" value="{{ old('email') }}" autocomplete="Email">
										@if($errors->has('email'))
                                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                        @endif
									</div>
									<!-- Password -->
									<div class="col-md-6">
										<label for="password" class="form-label">Password *</label>
										<input type="password" name="password" class="form-control" id="password" >
										@if($errors->has('password'))
                                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                        @endif
									</div>
									<!-- Confirm password -->
									<div class="col-md-6">
										<label for="password_confirmation" class="form-label">Confirm Password *</label>
										<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" >
										@if($errors->has('password_confirmation'))
                                            <div class="alert alert-danger">{{ $errors->first('password_confirmation') }}</div>
                                        @endif
									</div>
								</div> <!-- Row END -->
							</div>
						</div>
						<!-- Upload profile -->
						<div class="col-xxl-4">
							<div class="bg-secondary-soft px-4 py-5 rounded">
								<div class="row g-3">
									<h4 class="mb-4 mt-0">Upload your profile photo</h4>
									<div class="text-center">
										<!-- Image upload -->
										<div class="square position-relative display-2 mb-3">
											<img id="output" class="fas fa-fw position-absolute top-50 start-50 translate-middle text-secondary"/>

											<i id="userBanner" class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
										</div>
										<!-- Button -->
										<input type="file" id="customFile" name="file" hidden="" accept=".png" onchange="loadFile(event)">
										
										@if($errors->has('file'))
                                            <div class="alert alert-danger">{{ $errors->first('file') }}</div>
                                        @endif
										<label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
										<!-- <button type="button" class="btn btn-danger-soft">Remove</button> -->
										<!-- Content -->
										<p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Only PNG files are accepted.</p>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Row END -->

					<!-- button -->
					<div class="gap-3 d-md-flex justify-content-md-end text-center">
						<button type="reset" class="btn btn-danger btn-lg">Clear</button>
						<button type="submit" class="btn btn-success btn-lg">Add user</button>
					</div>
				</form> <!-- Form END -->
			</div>
		</div>
	<!-- </div>	 -->

	<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);

    var userBanner = document.getElementById('userBanner');
    userBanner.style.display = 'none';

    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

@endsection