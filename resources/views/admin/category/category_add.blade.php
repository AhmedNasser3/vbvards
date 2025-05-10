@extends('admin.master')
@section('AdminContent')

<div dir="rtl" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;" data-aos="fade-down">
    <button onclick="history.back()" class="back_button">رجوع للوراء</button>
    <div class="breadcrumb" style="font-size: 16px; color: #666;">الفئات / الرئيسية</div>
</div>

<form class="fancyModernForm_ahmad2025" method="post" action="{{ route('store.category') }}" enctype="multipart/form-data" data-aos="fade-up">
    @csrf

    <div class="form_group animate__animated animate__fadeInUp">
        <label for="category_name">اسم الفئة <span id="charCount">0</span>/50</label>
        <input type="text" id="category_name" name="category_name" maxlength="50" placeholder="اكتب اسم الفئة" required />
    </div>

    <div class="form_group" data-aos="zoom-in">
        <label for="category_image">صورة الفئة
            <span title="يفضل أن تكون JPG أو PNG بحجم لا يتجاوز 2 ميغابايت" style="cursor: help; color: #999;">&#9432;</span>
        </label>
        <div id="uploadContainer">
            <button type="button" id="uploadBtn" class="btnUpload">
                اختر صورة
            </button>
            <input type="file" id="category_image" name="category_image" class="form-control" style="display: none;" required />
            <span id="uploadStatus" style="display: none; font-size: 14px; color: #3498db;">جاري التحميل...</span>
        </div>
    </div>

    <div class="form_group" data-aos="zoom-in-up">
        <label>معاينة الصورة</label>
        <img id="showImage" src="{{ isset($category->category_image) ? asset('upload/categories/'.$category->category_image) : url('upload/no_image.jpg') }}" alt="صورة المعاينة" style="width: 100px; height: 100px;" />
    </div>

    <!-- إضافة عنوان الصورة إذا كانت موجودة -->
    @if(isset($category->category_image))
        <div class="form_group">
            <label for="current_image">العنوان: </label>
            <p>{{ $category->category_image }}</p>
        </div>
    @endif

    <div class="form_group">
        <button type="submit" id="submitBtn">
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

@endsection
