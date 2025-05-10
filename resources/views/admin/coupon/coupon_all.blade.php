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
                <button class="btn btn-secondary">
                    <a href="{{ route('add.coupon') }}">
                    🛠️ انشاء
                    </a>
                </button>
            </div>

            <!-- حاوية الطلبات -->
            <div id="orders-container">
                @foreach($coupon as $key => $item)
                <a href="">
                    <div class="p-3 mb-2 border rounded d-flex row align-items-center justify-content-between order-item">
                        <div class="order d-flex align-items-center col-md-8">
                            <input type="checkbox" class="checkbox me-2">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="fw-bold"><h4 style="font-weight: 900; color:#00796b;">{{ $item->coupon_name }}</h4></div>
                                    <div class="text-muted">
                                        {{ $item->created_at }} 📍 |
                                        @if ($item->status == 1)
                                            <span style="color: #00414d; font-weight: bold;">مفعل</span>
                                        @else
                                            <span style="color: #4d0000; font-weight: bold;">منتهي</span>
                                        @endif
                                    </div>
                                    <div class="text-primary">⏰ {{ \Carbon\Carbon::parse($item->coupon_validity)->translatedFormat('l, d F Y') }} - ساري حتى</div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-center action_buttons d-flex flex-column text-start col-md-4">
                            <div class="coupon-box">
                                <div class="coupon-icon">🎁</div>
                                <div class="coupon-discount">{{ $item->coupon_discount }}%</div>
                                <div class="coupon-text">خصم حصري على هذا المنتج!</div>
                            </div>
                            <div class="action_btns">
                                <button>
                                    <a href="{{ route('edit.coupon',$item->id) }}" class="btn btn-info">تعديل</a>
                                </button>
                                <button>
                                    <a href="{{ route('delete.coupon',$item->id) }}" class="btn btn-danger" id="delete">ازالة</a>
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
