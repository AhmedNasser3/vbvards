@extends('admin.master')
@section('AdminContent')

<div dir="rtl" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;" data-aos="fade-down">
    <button onclick="history.back()" class="back_button">رجوع للوراء</button>
    <div class="breadcrumb" style="font-size: 16px; color: #666;">العلامات التجارية / تعديل</div>
</div>

<form class="fancyModernForm_ahmad2025" method="post" action="{{ route('update.brand', $brand->id) }}" enctype="multipart/form-data" data-aos="fade-up">
    @csrf
    @method('PUT')

    <div class="form_group animate__animated animate__fadeInUp">
        <label for="brand_name">اسم العلامة التجارية <span id="charCount">{{ strlen($brand->brand_name) }}</span>/50</label>
        <input type="text" id="brand_name" name="brand_name" maxlength="50" placeholder="اكتب اسم العلامة" value="{{ $brand->brand_name }}" required />
    </div>

    <div class="form_group" data-aos="zoom-in">
        <label for="brand_image">صورة العلامة التجارية
            <span title="يفضل أن تكون JPG أو PNG بحجم لا يتجاوز 2 ميغابايت" style="cursor: help; color: #999;">&#9432;</span>
        </label>
        <div id="uploadContainer">
            <button type="button" id="uploadBtn" class="btnUpload">
                اختر صورة
            </button>
            <input type="file" id="brand_image" name="brand_image" class="form-control" style="display: none;" />
            <span id="uploadStatus" style="display: none; font-size: 14px; color: #3498db;">جاري التحميل...</span>
        </div>
    </div>



    <div class="form_group" data-aos="zoom-in-up">
        <label>معاينة الصورة</label>
        <img id="showImage" src="{{ $brand->brand_image ? asset('upload/brands/' . $brand->brand_image) : url('upload/no_image.jpg') }}" alt="صورة المعاينة" style="width: 100px; height: 100px;" />
    </div>

    <div class="form_group">
        <button type="submit" id="submitBtn">
            <span class="loader" id="loader"></span> <span id="submitText">تحديث البيانات</span>
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

    .showImageMotion {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .showImageMotion:hover {
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.5);
    }
</style>

{{-- مكتبة SweetAlert --}}
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
    const imageSearch = document.getElementById('imageSearch');
    const googleImageSearchBtn = document.getElementById('googleImageSearchBtn');

    // عدد الأحرف
    brandNameInput.addEventListener('input', function () {
        charCount.textContent = this.value.length;
        this.style.borderColor = this.value.length > 2 ? 'green' : 'red';
    });

    // التحقق من نوع وحجم الصورة + المعاينة + لون الخلفية
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

    // وظيفة البحث في صور جوجل
    googleImageSearchBtn.addEventListener('click', function() {
        const query = imageSearch.value.trim();
        if (query) {
            // البحث عن الصور من خلال API جوجل
            fetch(`https://api.qrserver.com/v1/search/?query=${encodeURIComponent(query)}&count=6`)
                .then(response => response.json())
                .then(data => {
                    displayImageResults(data.images); // عرض الصور في القسم المخصص
                })
                .catch(error => {
                    toastr.error("حدث خطأ أثناء البحث");
                });
        } else {
            toastr.warning("يرجى إدخال نص للبحث");
        }
    });

    // عرض الصور المقترحة من نتائج البحث
    function displayImageResults(images) {
        const resultsContainer = document.getElementById('googleImageResults');
        resultsContainer.innerHTML = ''; // مسح النتائج القديمة

        images.forEach(image => {
            const img = document.createElement('img');
            img.src = image.url;
            img.alt = "صورة مقترحة";
            img.style = "width: 100px; height: 100px; margin: 5px; cursor: pointer;";

            img.addEventListener('click', function() {
                showImage.src = img.src; // تحميل الصورة عند النقر عليها
                showImage.style.backgroundColor = "#fff"; // تغيير الخلفية لعلامة واضحة
            });

            resultsContainer.appendChild(img);
        });
    }

    // تأكيد التحديث
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // منع الإرسال مؤقتاً
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم تحديث البيانات!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، حدثها!',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                submitText.innerText = "جاري التحديث...";
                loader.style.display = 'inline-block';
                submitBtn.disabled = true;
                form.submit();
            }
        });
    });
</script>

@endsection
