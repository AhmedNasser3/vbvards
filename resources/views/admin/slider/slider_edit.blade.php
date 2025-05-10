@extends('admin.master')
@section('AdminContent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="breadcrumb-title pe-3">Edit Slider </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="p-0 mb-0 breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Slider </li>
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

<div class="col-lg-10">
	<div class="card">
		<div class="card-body">

		<form id="myForm" method="post" action="{{ route('update.slider') }}" enctype="multipart/form-data" >
			@csrf

		 <input type="hidden" name="id" value="{{ $slider->id }}">
		 <input type="hidden" name="old_img" value="{{ $slider->slider_image }}">

			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Slider Title</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="slider_title" class="form-control" value="{{ $slider->slider_title }}"   />
				</div>
			</div>

			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Short Title</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="short_title" class="form-control" value="{{ $slider->short_title }}"   />
				</div>
			</div>


			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0">Slider Image  </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="slider_image" class="form-control"  id="image" value="{{ asset($slider->slider_image) }}"  />
				</div>
			</div>



			<div class="mb-3 row">
				<div class="col-sm-3">
					<h6 class="mb-0"> </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					 <img id="showImage" src="{{ asset('storage/' .$slider->slider_image) }}" alt="Admin" style="width:100px; height: 100px;"  >
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




<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                slider_title: {
                    required : true,
                },
                short_title: {
                    required : true,
                },
            },
            messages :{
                slider_title: {
                    required : 'Please Enter Slider Title',
                },
                short_title: {
                    required : 'Please Enter Short Title',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>




<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});


</script>
@endsection
