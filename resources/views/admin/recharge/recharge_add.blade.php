@extends('admin.master')
@section('AdminContent')

<div dir="rtl" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;" data-aos="fade-down">
    <a href="{{ route('all.recharge') }}" class="back_button">عرض جميع العلامات</a>
    <div class="breadcrumb" style="font-size: 16px; color: #666;">إضافة علامة تجارية جديدة</div>
</div>

<form class="fancyModernForm_ahmad2025" method="post" action="{{ route('store.recharge') }}" enctype="multipart/form-data" data-aos="fade-up">
    @csrf
    <div class="form_group animate__animated animate__fadeInUp">
        <label for="product_id">اسم الفئة الرئيسية</label>
        <select name="product_id" class="form-select mb-3" aria-label="Default select example">
            <option selected="">اختر الفئة</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form_group animate__animated animate__fadeInUp">
        <label for="name">رقم الكارت<span id="charCount">0</span>/50</label>
        <input type="text" id="name" name="name" maxlength="50" placeholder="اكتب رقم الكارت" required />
    </div>
    <div class="form_group">
        <button type="submit" id="submitBtn">
            <span class="loader" id="loader"></span> <span id="submitText">إرسال البيانات</span>
        </button>
    </div>
</form>

@if(Session::has('success'))
    <script> toastr.success("{{ Session::get('success') }}"); </script>
@endif
@if(Session::has('error'))
    <script> toastr.error("{{ Session::get('error') }}"); </script>
@endif

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const form = document.querySelector('form');
    const brandNameInput = document.getElementById('brand_name');
    const brandImageInput = document.getElementById('brand_image');
    const showImage = document.getElementById('showImage');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loader = document.getElementById('loader');
    const charCount = document.getElementById('charCount');
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadStatus = document.getElementById('uploadStatus');

    brandNameInput.addEventListener('input', function () {
        charCount.textContent = this.value.length;
        this.style.borderColor = this.value.length > 2 ? 'green' : 'red';
    });

    uploadBtn.addEventListener('click', function () {
        brandImageInput.click();
    });

    brandImageInput.addEventListener('change', function () {
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

    form.addEventListener('submit', function (e) {
        e.preventDefault();
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
