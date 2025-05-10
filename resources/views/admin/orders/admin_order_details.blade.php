@extends('admin.master')
@section('AdminContent')
@php
use App\Models\OrderItem;
$orderItems = OrderItem::with('product')->where('order_id', $order->id)->get();

@endphp
<style>
    .page-header {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .breadcrumb-custom {
        font-size: 18px;
        color: #555;
    }
    .btn-help, .btn-back, .btn-status {
        background-color: #007bff;
        color: #fff;
        padding: 8px 15px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-help:hover, .btn-back:hover, .btn-status:hover {
        background-color: #0056b3;
    }
    .filters {
        display: flex;
        gap: 10px;
    }
    .filter-box {
        background: #f1f1f1;
        padding: 8px 12px;
        border-radius: 6px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        transition: 0.3s;
    }
    .filter-box:hover {
        background: #e0e0e0;
    }

    .custom-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin: 30px 0;
    }

    .info-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px #e0e0e0;
        padding: 25px;
    }
    .info-card h3 {
        margin-bottom: 20px;
        color: #444;
        font-size: 22px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    .info-card ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .info-card li {
        margin-bottom: 12px;
        font-size: 16px;
        color: #333;
    }
    .price {
        font-weight: bold;
        color: #28a745;
    }
    .status {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }
    .status-warning { background: #ffc107; color: #fff; }
    .status-completed { background: #28a745; color: #fff; }
    .status-other { background: #6c757d; color: #fff; }

    .status-action {
        margin-top: 20px;
    }
    .btn-status.green { background: #28a745; }
    .btn-status.blue { background: #007bff; }
    .btn-status.purple { background: #6f42c1; }

    .product-section {
        margin-top: 50px;
    }
    .product-box {
        background: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 5px #ccc;
    }
    .product-box h4 {
        margin-bottom: 15px;
        font-size: 20px;
        color: #333;
    }
    .product-box .item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 16px;
    }
</style>

<div class="page-header">
    <div class="breadcrumb-custom">
        <i class="fa-solid fa-house"></i> الرئيسية / <span>الطلبات</span>
    </div>
    <button onclick="history.back()" class="btn-help"><i class="fa-solid fa-circle-info"></i> مساعدة</button>
</div>

<div class="action-buttons" style="margin: 20px 0;">
    <button onclick="history.back()" class="btn-back"><i class="fa-solid fa-arrow-right"></i> رجوع</button>
</div>

<div class="custom-container">
    <!-- قسم الشحن -->
    <div class="info-card shipping">
        <h3><i class="fa-solid fa-truck-fast"></i> تفاصيل الشحن</h3>
        <ul>
            <li><strong>📛 الاسم:</strong> {{ $order->name }}</li>
<li>
    <strong>📞 هاتف العميل:</strong>
    <a href="https://wa.me/{{ $order->user->phone ?? '' }}" target="_blank">
        <i class="fa-brands fa-whatsapp fa-2x"></i> <!-- أيقونة واتساب بحجم أكبر -->
    </a>
</li>

<li>
    <strong>✉️ البريد:</strong>
    <a href="mailto:{{ $order->email }}" target="_blank">
        <i class="fa-solid fa-envelope fa-2x"></i> <!-- أيقونة البريد الإلكتروني بحجم أكبر -->
    </a>
</li>
            <li><strong>📍 العنوان:</strong> {{ $order->address }}</li>
            <li><strong>🏙️ القسم:</strong> {{ $order->division->division_name ?? '-' }}</li>
            <li><strong>🗺️ المنطقة:</strong> {{ $order->district->district_name ?? '-' }}</li>
            <li><strong>🌍 الحالة:</strong> {{ $order->state->state_name ?? '-' }}</li>
            <li><strong>📬 الرمز البريدي:</strong> {{ $order->post_code ?? '-' }}</li>
            <li><strong>🗓️ تاريخ الطلب:</strong> {{ $order->order_date ?? '-' }}</li>
        </ul>
    </div>

    <!-- قسم الطلب -->
    <div class="info-card order">
        <h3><i class="fa-solid fa-file-invoice"></i> تفاصيل الطلب</h3>
        <ul>
            <li><strong>👤 العميل:</strong> {{ $o->name ?? '-' }}</li>
<li>
    <strong>📞 هاتف العميل:</strong>
    <a href="https://wa.me/{{ $order->user->phone ?? '' }}" target="_blank">
        <i class="fa-brands fa-whatsapp fa-2x"></i> <!-- أيقونة واتساب بحجم أكبر -->
    </a>
</li>

            <li><strong>💳 طريقة الدفع:</strong> {{ $order->payment_method ?? '-' }}</li>
            <li><strong>🔐 رقم المعاملة:</strong> {{ $order->transaction_id ?? '-' }}</li>
            <li><strong>💵 المبلغ:</strong> <span class="price">${{ $order->amount }}</span></li>
            <li>
                <strong>📌 حالة الطلب:</strong>
                @if($order->status == 'pending')
                    <span class="status status-warning">قيد الانتظار</span>
                @elseif($order->status == 'completed')
                    <span class="status status-completed">تم الاكتمال</span>
                @else
                    <span class="status status-other">{{ $order->status }}</span>
                @endif
            </li>
        </ul>

        <div class="status-action">
            @if($order->status == 'pending')
                <a href="{{ route('pending-confirm', $order->id) }}" class="btn-status green">تأكيد الطلب</a>
            @elseif($order->status == 'confirm')
                <a href="{{ route('confirm-processing', $order->id) }}" class="btn-status blue">معالجة الطلب</a>
            @elseif($order->status == 'processing')
                <a href="{{ route('processing-delivered', $order->id) }}" class="btn-status purple">تم التوصيل</a>
            @endif
        </div>
    </div>
</div>
<!-- تفاصيل المنتج -->
<div class="product-section">
    <div class="product-box">
        <h4><i class="fa-solid fa-box"></i> المنتجات في هذا الطلب</h4>
        <div class="product-list">
            @foreach($orderItems as $item)
                @php
                    $product = $item->product;
                    $productName = $product->product_name ?? '—';
                    $productUrl = url('product/details/' . $product->id . '/' . urlencode($productName));
                @endphp

                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset($product->product_thumbnail ?? 'upload/no_image.jpg') }}" alt="صورة المنتج">
                    </div>
                    <div class="product-info">
                        <a href="{{ $productUrl }}" class="product-name" target="_blank">
                            <i class="fa-solid fa-link"></i> {{ $productName }}
                        </a>
                        <div><strong>🔢 الكمية:</strong> {{ $item->qty }}</div>
                        <div><strong>💰 السعر:</strong> ${{ $item->price }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
<style>
    a[href^="https://wa.me/"] {
        color: #25D366; /* اللون الأخضر المميز للواتساب */
        transition: color 0.3s ease, transform 0.3s ease;
    }

    /* عند مرور الماوس على أيقونة الواتساب */
    a[href^="https://wa.me/"]:hover {
        color: #128C7E; /* اللون الأخضر الداكن عند التمرير */
        transform: scale(1.1); /* تكبير الأيقونة قليلاً */
    }

    /* تنسيق أيقونة البريد الإلكتروني */
    a[href^="mailto:"] {
        color: #007BFF; /* اللون الأزرق المميز للبريد */
        transition: color 0.3s ease, transform 0.3s ease;
    }

    /* عند مرور الماوس على أيقونة البريد */
    a[href^="mailto:"]:hover {
        color: #0056b3; /* اللون الأزرق الداكن عند التمرير */
        transform: scale(1.1); /* تكبير الأيقونة قليلاً */
    }

    /* تنسيق أيقونات النص */
    a i {
        margin-right: 8px; /* مسافة بين الأيقونة والنص */
    }

    /* تحسين عرض الأيقونات */
    a i.fa-2x {
        font-size: 1.5em; /* زيادة حجم الأيقونة */
</style>
