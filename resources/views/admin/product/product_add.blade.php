@extends('admin.master')
@section('AdminContent')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
 <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Tagify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

<div dir="rtl" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;" data-aos="fade-down">
    <button onclick="history.back()" class="back_button">رجوع للوراء</button>
    <div class="breadcrumb" style="font-size: 16px; color: #666;">التطبيقات / المنتجات </div>
</div>

<form id="myForm" class="fancyModernForm_ahmad2025" method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
    @csrf

    <div class="form_group">
        <label for="inputProductTitle" class="form-label">اسم المنتج</label>
        <input type="text" name="product_name" class="form-control" id="inputProductTitle" placeholder="أدخل اسم المنتج">
    </div>

    <div class="form_group">
        <label for="inputProductTags" class="form-label">وسوم المنتج</label>
        <input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="منتج جديد،منتج مميز">
    </div>

    <div hidden class="form_group">
        <label for="inputProductSize" class="form-label">حجم المنتج</label>
        <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="صغير،متوسط،كبير">
    </div>

    <div hidden class="form_group">
        <label for="inputProductColor" class="form-label">لون المنتج</label>
        <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="أحمر،أزرق،أسود">
    </div>

    <div class="form_group">
        <label for="inputShortDescription" class="form-label">وصف قصير</label>
        <textarea name="short_descp" class="form-control" id="inputShortDescription" rows="3"></textarea>
    </div>

    <div class="form_group">
        <label for="editor" class="form-label">الوصف الطويل</label>
        <textarea id="editor" name="long_descp">{{ old('long_descp') }}</textarea>
    </div>

    <div class="form_group">
        <label for="inputMainThumbnail" class="form-label">الصورة المصغرة الرئيسية</label>
        <input name="product_thambnail" class="form-control" type="file" id="formFile" onChange="mainThamUrl(this)">
        <img src="" id="mainThmb" />
    </div>

    <div class="form_group">
        <label for="inputMultipleImages" class="form-label">صور متعددة</label>
        <input class="form-control" name="multi_img[]" type="file" id="multiImg" multiple="">
        <div class="row" id="preview_img"></div>
    </div>

    <div class="form_group">
        <label for="inputPrice" class="form-label">سعر المنتج</label>
        <input type="text" name="selling_price" class="form-control" id="inputPrice" placeholder="00.00">
    </div>

    <div class="form_group">
        <label for="inputCompareatprice" class="form-label">السعر بعد الخصم</label>
        <input type="text" name="discount_price" class="form-control" id="inputCompareatprice" placeholder="00.00">
    </div>

    <div class="form_group">
        <label for="inputCostPerPrice" class="form-label">كود المنتج</label>
        <input type="text" name="product_code" class="form-control" id="inputCostPerPrice" placeholder="مثال: 12345">
    </div>

    <div class="form_group">
        <label for="inputStarPoints" class="form-label">كمية المنتج</label>
        <input type="text" name="product_qty" class="form-control" id="inputStarPoints" placeholder="مثال: 10">
    </div>

    <div class="form_group">
        <label for="inputProductType" class="form-label">ماركة المنتج</label>
        <select name="brand_id" class="form-select" id="inputProductType">
            <option>اختر الماركة</option>
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
             @endforeach
        </select>
    </div>
    <div class="form-group col-12">
        <label for="inputVendor" class="form-label">القسم</label>
        <select name="category_id" class="form-select" id="inputVendor">
            <option></option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
             @endforeach
          </select>
      </div>

      <div class="form-group col-12">
        <label for="inputCollection" class="form-label">القسم الفرعي </label>
        <select name="subcategory_id" class="form-select" id="inputCollection">
            <option></option>

          </select>
      </div>
      <div class="form-group col-12">
        <label for="inputCollection1" class="form-label">القسم الفرعي المتقجم</label>
        <select name="subsubcategory_id" class="form-select" id="inputCollection1">
            <option></option>

          </select>
      </div>
    <div class="form_group">
        <button type="submit" class="btn btn-primary px-4">
            <span class="loader" id="loader"></span>
            <span id="submitText">إرسال البيانات</span>
        </button>
    </div>
</form>




<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>


<script>

  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });

  </script>



  <script type="text/javascript">

  		$(document).ready(function(){
  			$('select[name="category_id"]').on('change', function(){
  				var category_id = $(this).val();
  				if (category_id) {
  					$.ajax({
  						url: "{{ url('/subcategory/ajax') }}/"+category_id,
  						type: "GET",
  						dataType:"json",
  						success:function(data){
  							$('select[name="subcategory_id"]').html('');
  							var d =$('select[name="subcategory_id"]').empty();
  							$.each(data, function(key, value){
  								$('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
  							});
  						},

  					});
  				} else {
  					alert('danger');
  				}
  			});
  		});

  </script>
  <script>
    $(document).ready(function(){
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/subsubcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('الرجاء اختيار فئة فرعية');
            }
        });
    });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                language: 'ar'
            })
            .catch(error => {
                console.error(error);
            });
    </script>

{{-- إشعارات --}}
@if(Session::has('success'))
    <script> toastr.success("{{ Session::get('success') }}"); </script>
@endif
@if(Session::has('error'))
    <script> toastr.error("{{ Session::get('error') }}"); </script>
@endif

{{-- ستايل اللودر --}}
<style>
    .loader {
        display: none;
        margin-left: 8px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        animation: spin 0.8s linear infinite;
        vertical-align: middle;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .btnUpload {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btnUpload:hover {
        background-color: #2980b9;
    }
</style>

{{-- مكتبة SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const form = document.querySelector('form');
    const categoryNameInput = document.getElementById('category_name');
    const categoryImageInput = document.getElementById('category_image');
    const showImage = document.getElementById('showImage');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loader = document.getElementById('loader');
    const charCount = document.getElementById('charCount');
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadStatus = document.getElementById('uploadStatus');

    // عدد الأحرف
    categoryNameInput.addEventListener('input', function () {
        charCount.textContent = this.value.length;
        this.style.borderColor = this.value.length > 2 ? 'green' : 'red';
    });

    // التحقق من نوع وحجم الصورة + المعاينة + لون الخلفية
    uploadBtn.addEventListener('click', function () {
        categoryImageInput.click();
    });

    categoryImageInput.addEventListener('change', function () {
        const file = this.files[0];
        const allowedTypes = ['image/jpeg', 'image/png'];

        if (!allowedTypes.includes(file.type)) {
            toastr.error("فقط الصور بصيغة JPG أو PNG مسموح بها");
            this.value = "";
            showImage.src = "{{ url('upload/no_image.jpg') }}";
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            toastr.warning("حجم الصورة كبير، يُفضل ألا يتجاوز 2 ميغابايت");
            this.value = "";
            showImage.src = "{{ url('upload/no_image.jpg') }}";
            return;
        }

        // عرض حالة التحميل
        uploadStatus.style.display = 'inline-block';

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = new Image();
            img.src = e.target.result;
            img.onload = function () {
                showImage.src = img.src;
                showImage.style.backgroundColor = "#fff";
                uploadStatus.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    });

    // تأكيد الإرسال
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // منع الإرسال مؤقتاً
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم إرسال البيانات!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، أرسلها!',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                submitText.innerText = "جاري الإرسال...";
                loader.style.display = 'inline-block';
                submitBtn.disabled = true;
                form.submit();
            }
        });
    });
</script>


<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>


<script>

  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });

  </script>

  <script type="text/javascript">
    $(document).ready(function () {
        $('#category').on('change', function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#inputCollection').html('<option selected="">Select Subcategory</option>');
                        $.each(data, function (key, value) {
                            $('#inputCollection').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },
                });
            } else {
                $('#inputCollection').html('<option selected="">Select Subcategory</option>');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#inputCollection').on('change', function () {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/subsubcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#inputCollection1').html('<option selected="">اختر القسم المتقدم</option>');
                        $.each(data, function (key, value) {
                            $('#inputCollection1').append('<option value="' + value.id + '">' + value.subsubcategory_name + '</option>');
                        });
                    },
                });
            } else {
                $('#inputCollection1').html('<option selected="">اختر القسم المتقدم</option>');
            }
        });
    });
</script>

@endsection
