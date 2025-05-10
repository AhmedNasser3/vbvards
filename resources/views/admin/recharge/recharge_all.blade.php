@extends('admin.master')
@section('AdminContent')
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
    <div class="breadcrumb" style="font-size: 16px; color: #004956;">
        <i class="fa-solid fa-house"></i>  الرئيسية  /   <span style="color: #bbb;">بطاقات الشحن</span>
    </div>
    <button onclick="history.back()" class="help_button"><i class="fa-solid fa-circle-info"></i>مساعدة</button>
</div>

<div style="display: flex;justify-content:space-between;">
    <button onclick="history.back()" class="back_button"> <i class="fa-solid fa-plus"></i> رجوع للوراء </button>
    <form action="{{ route('recharge.storeExcel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="excel_file">رفع ملف Excel</label>
        <input type="file" name="excel_file" id="excel_file" required>
        <button type="submit" class="btn btn-primary">رفع الأكواد من Excel</button>
    </form>
        <div class="d_flex">
        <div class="d_flex_container"><h4><i class="fa-solid fa-calendar"></i> الحجوزات</h4></div>
        <div class="d_flex_container"><h4><i class="fa-solid fa-suitcase"></i> خدمات</h4></div>
        <div class="d_flex_container"><h4><i class="fa-solid fa-filter"></i> تصفية</h4></div>
    </div>
</div>

<div class="table-container" style="margin: 20px 0 0 0;">
    <div class="mt-4 card">
        <div class="card-body">
            <div class="mb-3 table-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <input type="checkbox" id="select-all" class="checkbox me-2">
                    <h3 class="mb-0">بطاقات الشحن</h3>
                </div>
                <button class="btn btn-secondary">
                    <a href="{{ route('add.recharge') }}">🛠️ انشاء</a>
                </button>
            </div>

            <div id="orders-container">
                @foreach($recharges as $item)
                <a href="#">
                    <div class="p-3 mb-2 border rounded d-flex row align-items-center justify-content-between order-item">
                        <div class="order d-flex align-items-center col-md-8">
                            <input type="checkbox" class="checkbox me-2">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="fw-bold"><h4 style="font-weight: 900; color:#00796b;">{{ $item->name }}</h4></div>
                                    <div class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }} 📍تاريخ الانشاء
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-center action_buttons d-flex flex-column text-start col-md-4">
                            <div class="action_btns">
                                <a href="{{ route('edit.recharge', $item->id) }}" class="btn btn-info"><button>تعديل</button></a>
                                <a href="{{ route('delete.recharge', $item->id) }}" class="btn btn-danger" id="delete"><button>ازالة</button></a>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-4 pagination d-flex justify-content-center" id="pagination"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const itemsPerPage = 10;
        const items = document.querySelectorAll('.order-item');
        const pagination = document.getElementById('pagination');

        function showPage(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            items.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? 'flex' : 'none';
            });

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

        showPage(1);

        document.getElementById('select-all').addEventListener('change', function() {
            document.querySelectorAll('.checkbox').forEach(cb => cb.checked = this.checked);
        });
    });
</script>
@endsection
