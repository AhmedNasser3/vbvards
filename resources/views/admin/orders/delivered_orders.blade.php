@extends('admin.master')
@section('AdminContent')

<div class="page-content">
    <!--breadcrumb-->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
        <div class="breadcrumb" style="font-size: 16px; color: #004956;">
            <i class="fa-solid fa-house"></i> الرئيسية / <span style="color: #bbb;">الطلبات المؤكدة</span>
        </div>
        <button onclick="history.back()" class="help_button"><i class="fa-solid fa-circle-info"></i>مساعدة</button>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <button onclick="history.back()" class="back_button"> <i class="fa-solid fa-plus"></i> رجوع للوراء </button>
        <div class="d_flex">
            <div class="d_flex_container">
                <h4> <i class="fa-solid fa-calendar"></i> الطلبات المؤكدة </h4>
            </div>
            <div class="d_flex_container">
                <h4> <i class="fa-solid fa-suitcase"></i> الدفع </h4>
            </div>
            <div class="d_flex_container">
                <h4> <i class="fa-solid fa-filter"></i> تصفية </h4>
            </div>
        </div>
    </div>

    <div class="table-container" style="margin: 20px 0 0 0;">
        <div class="mt-4 card">
            <div class="card-body">
                <!-- رأس الجدول -->
                <div class="mb-3 table-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0">الطلبات المؤكدة</h3>
                    </div>
                </div>

                <!-- حاوية الطلبات -->
                <div id="orders-container">
                    @foreach($orders as $key => $item)
                    <div class="p-3 mb-2 border rounded d-flex row align-items-center justify-content-between order-item">
                        <div class="order d-flex align-items-center col-md-8">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="fw-bold"><h4 style="font-weight: 900; color:#00796b;">{{ $item->invoice_no }}</h4></div>
                                    <div class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->order_date)->translatedFormat('l, d F Y') }} 📍تاريخ الطلب
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-center action_buttons d-flex flex-column text-start col-md-4">
                            <div class="action_btns">
                                <a href="{{ route('admin.order.details', $item->id) }}" class="btn btn-info">
                                    <button>تفاصيل</button>
                                </a>
                                <a href="{{ route('admin.invoice.download', $item->id) }}" class="btn btn-danger" title="Invoice Pdf">
                                    <button>تحميل الفاتورة</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- شريط الترقيم -->
                <div class="mt-4 pagination d-flex justify-content-center" id="pagination"></div>
            </div>
        </div>
    </div>

</div>

@endsection
