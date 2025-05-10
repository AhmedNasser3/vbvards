@extends('admin.master')
@section('AdminContent')
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
    <div class="breadcrumb" style="font-size: 16px; color: #004956;">
        <i class="fa-solid fa-house"></i>  الرئيسية  /   <span style="color: #bbb;">كوبونات</span>
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
<div class="boxes">
    <div class="boxes_container">
        <div class="boxes_content">
            <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-trash"></i></div>
                <div class="boxes_text"><h4>محذوف</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-credit-card"></i></div>
                <div class="boxes_text"><h4>بإنتظار الدفع</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-hourglass-half"></i></div>
                <div class="boxes_text"><h4>بإنتظار المراجعة</h4><h3>1</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-spinner"></i></div>
                <div class="boxes_text"><h4>قيد التنفيذ</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-check"></i></div>
                <div class="boxes_text"><h4>تم التنفيذ</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-truck"></i></div>
                <div class="boxes_text"><h4>جاري التوصيل</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-box"></i></div>
                <div class="boxes_text"><h4>تم التوصيل</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-plane"></i></div>
                <div class="boxes_text"><h4>تم الشحن</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-ban"></i></div>
                <div class="boxes_text"><h4>ملغي</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-rotate-left"></i></div>
                <div class="boxes_text"><h4>مسترجع</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <div class="boxes_text"><h4>قيد الإسترجاع</h4><h3>0</h3></div>
              </div>

              <div class="boxes_data">
                <div class="boxes_icons"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                <div class="boxes_text"><h4>طلب عرض سعر</h4><h3>0</h3></div>
              </div>
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
                    <h3 class="mb-0">الكوبونات</h3>
                </div>
                <button class="btn btn-secondary">🛠️ انشاء</button>
            </div>

            <!-- حاوية الطلبات -->
            <div id="orders-container">
                @foreach($products as $key => $item)
                <a href="">
                    <div class="p-3 mb-2 border rounded d-flex row align-items-center justify-content-between order-item">
                        <div class="order d-flex align-items-center col-md-8">
                            <input type="checkbox" class="checkbox me-2">
                            <div class="d-flex align-items-center">
                                <td> <img src="{{ asset($item->product_thambnail) }}" style="width: 70px; height:40px;" >  </td>

                                <div>
                                    <div class="fw-bold">{{ $item->product_name }}</div>
                                    <div class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }} - تاريخ النشر📍 |         @if($item->discount_price == NULL)
                                        <span class="badge rounded-pill bg-info">لا يوجد تخفيض</span>
                                        @else
                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        @endphp
                                        <span class="badge rounded-pill bg-danger">{{ $item->discount_price }}</span> السعر بعد الخصم
                                        @endif</div>
                                    <div class="text-primary">{{ $item->product_qty }} - الكمية</div>
                                    <div class="text-primary">{{ $item->id }} - ID</div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-center action_buttons d-flex flex-column text-start col-md-4">
                            <div class="mb-1 price fw-bold">ر.س {{ $item->selling_price }}</div>

                            <div class="action_btns">
                                <button>
                                    <a href="{{ route('edit.product',$item->id) }}" class="btn btn-info" title="تعديل البيانات">
                                        <i class="fa fa-pencil"></i> تعديل
                                    </a>
                                </button>
                                <button>
                                    <a href="{{ route('delete.product',$item->id) }}" class="btn btn-danger" id="delete" title="حذف البيانات">
                                        <i class="fa fa-trash"></i> حذف
                                    </a>
                                </button>
                                <button>
                                    <a href="{{ route('edit.category',$item->id) }}" class="btn btn-warning" title="صفحة التفاصيل">
                                        <i class="fa fa-eye"></i> التفاصيل
                                    </a>
                                </button>
                                <button>
                                    <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-primary" title="تعطيل المنتج">
                                        <i class="fa-solid fa-thumbs-down"></i> تعطيل
                                    </a>
                                </button>
                                <button>
                                    <a href="{{ route('product.active',$item->id) }}" class="btn btn-primary" title="تنشيط المنتج">
                                        <i class="fa-solid fa-thumbs-up"></i> تنشيط
                                    </a>
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
