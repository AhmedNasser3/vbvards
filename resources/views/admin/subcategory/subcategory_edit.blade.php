@extends('admin.master')

@section('AdminContent')

<div dir="rtl" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;" data-aos="fade-down">
    <button onclick="history.back()" class="back_button">رجوع للوراء</button>
    <div class="breadcrumb" style="font-size: 16px; color: #666;">الفئات / الرئيسية</div>
</div>

<form class="fancyModernForm_ahmad2025" method="post" action="{{ route('store.subcategory') }}" data-aos="fade-up">
    @csrf

    <div class="form_group animate__animated animate__fadeInUp">
        <label for="category_id">اسم الفئة الرئيسية</label>
        <select name="category_id" class="form-select mb-3" aria-label="Default select example">
            <option selected="">اختر الفئة</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form_group">
        <label for="subcategory_name">اسم الفئة الفرعية</label>
        <input type="text" name="subcategory_name" class="form-control" required />
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

    /* تعديل على شكل الأزرار وحقول الإدخال */
    .form_group {
        margin-bottom: 15px;
        text-align: right;
    }

    .form-select, .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .form-select:focus, .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
    }

    .btn {
        background-color: #3498db;
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    .back_button {
        background-color: #f1f1f1;
        color: #333;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .back_button:hover {
        background-color: #ddd;
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
</script>

@endsection
