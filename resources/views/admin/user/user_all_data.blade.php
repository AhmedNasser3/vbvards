@extends('admin.master')
@section('AdminContent')


<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
    <div class="breadcrumb" style="font-size: 16px; color: #004956;">
        <i class="fa-solid fa-house"></i>  الرئيسية  /   <span style="color: #bbb;">جميع بيانات المستخدمين</span>
    </div>
  <!-- زر الرجوع -->

  <!-- مسار الصفحة -->
  <button onclick="history.back()" class="help_button"><i class="fa-solid fa-circle-info"></i>مساعدة</button>

</div>
<div style="display: flex;justify-content:space-between;">
    <button onclick="history.back()" class="back_button"> <i class="fa-solid fa-plus"></i> رجوع للوراء </button>
    <div class="d_flex">
        <div class="d_flex_container">
            <h4> <i class="fa-solid fa-calendar"></i> الحجوزات  </h4>
        </div>
        <div class="d_flex_container">
            <h4> <i class="fa-solid fa-suitcase"></i> خدمات  </h4>
        </div>
        <div class="d_flex_container">
            <h4> <i class="fa-solid fa-filter"></i> تصفية  </h4>
        </div>
    </div>

</div>
<div class="table-container" style="margin: 20px 0 0 0;">
    <!-- قسم الطلبات -->
    <div class="mt-4 card">
        <div class="card-body">

            <!-- رأس الجدول -->
            <div class="mb-3 table-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <input type="checkbox" class="checkbox me-2">
                    <h3 class="mb-0">جميع بيانات المستخدمين</h3>
                </div>
                <button class="btn btn-secondary">
                    <a href="{{ route('add.subsubcategory') }}">
                    🛠️ انشاء
                    </a>
                </button>
            </div>

            <!-- حاوية الطلبات -->
            <div id="orders-container">
                @foreach($users as $key => $item)
                <a href="">
                    <div class="p-3 mb-2 border rounded d-flex row align-items-center justify-content-between order-item">
                        <div class="order d-flex align-items-center col-md-8">
                            <input type="checkbox" class="checkbox me-2">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="fw-bold"><h4 style="font-weight: 900; color:#00796b;">{{ $item->name }}</h4></div>
                                    <div class="fw-bold">{{ $item->email }}</div>
                                    <div class="fw-bold">{{ $item->phone }}</div>
                                    <div class="text-muted">
                                        {{ $item->created_at }} 📍
                                    </div>
                                    <div class="text-primary">⏰ {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-center action_buttons d-flex flex-column text-start col-md-4">
                            <div class="action_btns">
                                <button>
                                    <a href="{{ route('edit.subsubcategory',$item->id) }}" class="btn btn-info">تعديل</a>
                                </button>
                                <button>
                                    <a href="{{ route('delete.subsubcategory',$item->id) }}" class="btn btn-danger" id="delete">ازالة</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- شريط الترقيم -->
            <div class="mt-4 pagination d-flex justify-content-center" id="pagination"></div>

        </div>
    </div>
</div>

<!-- تصميم أزرار الترقيم -->

<!-- JavaScript لتقسيم الصفحات -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const itemsPerPage = 10;
        const items = document.querySelectorAll('.order-item');
        const pagination = document.getElementById('pagination');

        function showPage(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            items.forEach((item, index) => {
                if (index >= start && index < end) {
                    item.style.display = 'flex';
                    item.style.alignItems = 'center';
                    item.style.justifyContent = 'space-between';
                } else {
                    item.style.display = 'none';
                }
            });

            // تلوين زر الصفحة الحالية
            const pageButtons = document.querySelectorAll('.page-link');
            pageButtons.forEach((btn, idx) => {
                btn.classList.toggle('active', (idx + 1) === page);
            });
        }


        function createPagination() {
            const pageCount = Math.ceil(items.length / itemsPerPage);
            for (let i = 1; i <= pageCount; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.className = 'btn btn-sm page-link';
                btn.addEventListener('click', () => showPage(i));
                pagination.appendChild(btn);
            }
        }

        if (items.length > itemsPerPage) {
            createPagination();
        }

        showPage(1); // عرض الصفحة الأولى افتراضياً
    });
</script>

@endsection
