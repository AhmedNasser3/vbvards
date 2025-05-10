@extends('admin.master')
@section('AdminContent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="breadcrumb-title pe-3">Add Admin User </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="p-0 mb-0 breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Admin User</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">

					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

<div class="col-lg-8">
	<div class="card">
		<div class="card-body">

		<form method="post" action="{{ route('admin.user.store') }}"  >
			@csrf

			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">User Name</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="username" class="form-control" placeholder="Add User Name" />
				</div>
			</div>
			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Full Name</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="name" class="form-control" placeholder="Add Full Name" />
				</div>
			</div>
			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Email</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="email" name="email" class="form-control" placeholder="Add Email" />
				</div>
			</div>
			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Phone </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="phone" class="form-control" placeholder="Add Your Phone Number" />
				</div>
			</div>


			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Address</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="address" class="form-control" placeholder="Add Address" />
				</div>
			</div>

			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">password</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="password" name="password" class="form-control" placeholder="Add password" />
				</div>
			</div>


			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Asign Roles </h6>
				</div>
				<div class="col-sm-9 text-secondary">
		<select name="roles" class="mb-3 form-select" aria-label="Default select example">
						<option selected="">Open this select menu</option>
						@foreach($roles as $role)
						<option value="{{ $role->id }}">{{ $role->name }}</option>
						 @endforeach
					</select>
				</div>
			</div>







			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="px-4 btn btn-primary" value="Save Changes" />
				</div>
			</div>
		</div>

		</form>



	</div>




							</div>
						</div>
					</div>
				</div>
			</div>







@endsection
