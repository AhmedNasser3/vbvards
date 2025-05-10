@php
use App\Models\Order;
    $orders = Order::all();
    $ordersP = Order::where('status', 'pending')->get();
    $ordersC = Order::where('status', 'confirm')->get();
    $ordersS = Order::where('status', 'processing')->get();
    $ordersD = Order::where('status', 'delivered')->get();
@endphp
@extends('admin.master')
@section('AdminContent')

<!-- زر الرجوع -->
<!-- زر الرجوع ومسار الصفحة -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
    <div class="breadcrumb" style="font-size: 16px; color: #004956;">
        <i class="fa-solid fa-house"></i>  الرئيسية  /   <span style="color: #bbb;">طلبات</span>
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
<style>
    .boxes_text h3 {
        color: #444
    }
</style>
<div class="boxes">
<div class="boxes_container">
    <div class="boxes_content">
        <a href="#">
            <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-box"></i></div>
                <div class="boxes_text"><h4>جميع الطلبات</h4><h3>{{ count($orders) }}</h3></div>
            </div>
        </a>
        <a href="{{ route('pending.order') }}">
            <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-box"></i></div>
                <div class="boxes_text"><h4>الطلبات المعلقة </h4><h3>{{ count($ordersP) }}</h3></div>
            </div>
        </a>
        <a href="{{ route('admin.confirmed.order') }}">
            <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-box"></i></div>
                <div class="boxes_text"><h4>الطلبات المأكدة </h4><h3>{{ count($ordersC) }}</h3></div>
            </div>
        </a>
        <a href="{{ route('admin.processing.order') }}">
            <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-box"></i></div>
                <div class="boxes_text"><h4>الطلبات قيد التنفيذ </h4><h3>{{ count($ordersS) }}</h3></div>
            </div>
        </a>
        <a href="{{ route('admin.delivered.order') }}">
            <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-box"></i></div>
                <div class="boxes_text"><h4>الطلبات تمت بالفعل </h4><h3>{{ count($ordersD) }}</h3></div>
            </div>
        </a>

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
                    <h3 class="mb-0">الطلبات</h3>
                </div>
                <button class="btn btn-secondary">🛠️ انشاء</button>
            </div>

            <!-- حاوية الطلبات -->
            <div id="orders-container">
                @foreach ($orders as $order)
                <a href="{{  route('admin.order.details',$order->id)  }}">
                    <div class="p-3 mb-2 border rounded d-flex row align-items-center justify-content-between order-item">
                        <div class="order d-flex align-items-center col-md-8">
                            <input type="checkbox" class="checkbox me-2">
                            <div class="d-flex align-items-center">
                                <img
                                src="{{ $order->user->profile_photo_path ? asset('storage/' . $order->user->profile_photo_path) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                                alt="avatar"
                                width="50"
                                height="50"
                                class="me-3 rounded-circle">
                                <div>
                                    <div class="fw-bold">{{ $order->user->name }}</div>
                                    <div class="text-muted">{{ $order->created_at }} 📍 | {{ $order->order_number }}</div>
                                    <div class="text-primary">{{ $order->product->product_name ?? 'تم ازالة المنتج من المخزون' }} 💻 - {{ $order->status  ?? ''}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-start col-md-4">
                            <div class="mb-1 price fw-bold">ر.س {{ $order->amount }}</div>
                            <div class="status text-muted">
                                <a href="{{ route('admin.invoice.download',$order->id) }}">
                                    تحميل الفاتورة
                                </a>
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
<style>
    .pagination .page-link {
        padding: 10px 15px;
        margin: 0 3px;
        border: 1px solid #00796b;
        color: #00796b;
        border-radius: 6px;
        background-color: white;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #00796b;
        color: white;
    }

    .pagination .page-link.active {
        background-color: #00796b;
        color: white;
        font-weight: bold;
    }
</style>

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
