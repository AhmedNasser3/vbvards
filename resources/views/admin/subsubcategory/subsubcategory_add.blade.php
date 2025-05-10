@extends('admin.master')

@section('AdminContent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div dir="rtl" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;" data-aos="fade-down">
    <button onclick="history.back()" class="back_button">رجوع للوراء</button>
    <div class="breadcrumb" style="font-size: 16px; color: #666;">الفئات / الفرعية / الفرعية</div>
</div>

<form class="fancyModernForm_ahmad2025" method="post" action="{{ route('store.subsubcategory') }}" data-aos="fade-up">
    @csrf

    <div class="form_group animate__animated animate__fadeInUp">
        <label for="category_id">اسم الفئة الرئيسية</label>
        <select name="category_id" id="category" class="form-select mb-3" aria-label="Default select example">
            <option selected="" disabled="">اختر الفئة الرئيسية</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form_group">
        <label for="subcategory_id">اسم الفئة الفرعية</label>
        <select name="subcategory_id" id="subcategory" class="form-select mb-3">
            <option selected="" disabled="">اختر الفئة الفرعية</option>
        </select>
    </div>


    <div class="form_group">
        <label for="subsubcategory_name">اسم الفئة الفرعية الفرعية</label>
        <input type="text" name="subsubcategory_name" class="form-control" required />
    </div>

    <div class="form_group">
        <label for="subsubcategory_slug">رابط الفئة الفرعية الفرعية</label>
        <input type="text" name="subsubcategory_slug" class="form-control" required />
    </div>

    <div class="form_group">
        <button type="submit" class="btn btn-primary px-4">
            <span class="loader" id="loader"></span> <span id="submitText">إرسال البيانات</span>
        </button>
    </div>
</form>

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
    const submitBtn = document.querySelector('button[type="submit"]');
    const submitText = document.getElementById('submitText');
    const loader = document.getElementById('loader');

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

    // جلب الفئات الفرعية عند اختيار الفئة الرئيسية
    $('#category').on('change', function () {  // تأكد من استخدام الـ ID الصحيح
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                url: "{{ url('/admin/get-subcategories/') }}/" + category_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#subcategory').html('<option selected="" disabled="">اختر الفئة الفرعية</option>');
                    $.each(data, function (key, value) {
                        $('#subcategory').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                    });
                },
            });
        } else {
            $('#subcategory').html('<option selected="" disabled="">اختر الفئة الفرعية</option>');
        }
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
@endsection
