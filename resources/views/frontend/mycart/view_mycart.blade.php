@extends('frontend.master')
@section('content')

<div class="page-header breadcrumb-wrap" style="background-color: #0d1624;">
    <div class="container">
        <div class="text-white breadcrumb">
            <a href="index.html" rel="nofollow" class="text-white"><i class="mr-5 fi-rs-home"></i>رئيسية</a>
            <span class="text-white"> / العربة</span>
        </div>
    </div>
</div>

<div class="container mb-80 mt-50">
    <div class="row">
        <div class="mb-40 col-lg-8">
            <h4 class="mb-10 text-white heading-2">العربة الخاصة بك</h4>
            <div class="d-flex justify-content-between">
                <h6 class="text-white">هناك بعض المنتجات في عربتك</h6>
            </div>
        </div>
    </div>

    <div class="row" style="border: none; min-height:100vh">
        <div class="col-lg-12" style="border: none">
            <div class="table-responsive shopping-summery" style="border: none">
                <table class="table table-wishlist" style="border: none">
                    <thead style=" color: #25BA84;">
                        <tr class="main-heading">
                            <th style=" color: #25BA84;" class="custome-checkbox start pl-30"></th>
                            <th style=" color: #25BA84;" scope="col" colspan="2">المنتج</th>
                            <th style=" color: #25BA84;" scope="col">سعر القطعة</th>
                            <th style=" color: #25BA84;" scope="col">الكمية</th>
                            <th style=" color: #25BA84;" scope="col">الإجمالي</th>
                            <th style=" color: #25BA84;" scope="col" class="end">إزالة</th>
                        </tr>
                    </thead>
                    <tbody id="cartPage" class="text-white">
                        @php
                            $totalPrice = 0;
                            $totalDiscount = 0;
                        @endphp

                        @foreach($cartItems as $item)
                            <tr class="pt-30">
                                <td class="custome-checkbox pl-30"></td>
                                <td class="pt-40 image product-thumbnail">
                                    <img src="{{ asset($item->product->product_thambnail) }}" alt="{{ $item->product->product_name }}">
                                </td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5">
                                        <a class="mb-10 text-white product-name" href="#">
                                            {{ $item->product->product_name }}
                                        </a>
                                    </h6>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-white">
                                        ر.س{{ $item->product->discount_price ?? $item->product->selling_price }}
                                    </h4>
                                </td>
                                <td class="text-center text-white" data-title="Quantity">
                                    {{ $item->quantity }}
                                </td>
                                <td class="text-center text-white" data-title="Subtotal">
                                    ر.س{{ ($item->product->discount_price ?? $item->product->selling_price) * $item->quantity }}
                                </td>
                                <td class="text-center action" data-title="Remove">
                                    <a href="{{ route('cart.remove', $item->id) }}" class="text-danger">
                                        <i class="fi-rs-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            @php
                                $totalPrice += ($item->product->discount_price ?? $item->product->selling_price) * $item->quantity;
                                $totalDiscount += ($item->product->discount_price ? ($item->product->selling_price - $item->product->discount_price) * $item->quantity : 0);
                            @endphp
                        @endforeach
                        <input type="hidden" name="finalPrice" value="{{ $totalPrice }}">
                    </tbody>
                </table>
            </div>

            <div class="row mt-50">
                <div class="col-lg-5">
                    @if(!Session::has('coupon'))
                        <div class="p-40 rounded-3" id="couponField" style="background-color: #0d1624;">
                            <h4 class="mb-10 text-white">ادخل الكوبون</h4>
                            <p class="text-white mb-30"><span class="font-lg">لديك كود خصم ؟</span></p>
                            <form action="#">
                                <div class="d-flex justify-content-between">
                                    <input class="font-medium mr-15 coupon form-control" id="coupon_name" placeholder="Enter Your Coupon">
                                    <a type="submit" onclick="applyCoupon()" class="btn btn-success"><i class="mr-10 fi-rs-label"></i>تطبيق</a>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="col-lg-7">
                    <div class="p-4 shadow-sm card rounded-3" style="background: #0d1624;">
                        <h4 class="pb-2 mb-4 text-center text-white border-bottom-0">ملخص الطلب</h4>
                        <div class="table-responsive">
                            <table class="table mb-4 text-white table-borderless">
                                <tbody id="couponCalField">
                                    {{-- يتم تعبئته عبر JavaScript --}}
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('pay.page') }}" class="btn btn-primary w-100 d-flex justify-content-center align-items-center">
                            <span>إتمام عملية الشراء</span>
                            <i class="ml-2 fi-rs-sign-out"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function applyCoupon() {
        let coupon_name = document.getElementById("coupon_name").value;

        fetch("/coupon-apply", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ coupon_name: coupon_name })
        })
        .then(res => res.json())
        .then(data => {
            if (data.valid) {
                document.getElementById("couponField").style.display = "none";
                couponCalculation();
            } else {
                alert(data.message);
            }
        });
    }

    function couponCalculation() {
        fetch("/coupon-calculation")
        .then(res => res.json())
        .then(data => {
            let html = `
                <tr>
                    <td class="text-white cart_total_label">المجموع</td>
                    <td class="text-white cart_total_amount"><strong>ر.س${data.subtotal.toFixed(2)}</strong></td>
                </tr>
            `;

            if (data.coupon_name) {
                let total = parseFloat(data.total);
                let discountAmount = parseFloat(data.subtotal) - total;

                html += `
                <tr>
                    <td class="text-white cart_total_label">
                        كوبون <span class="text-warning">(${data.coupon_name})</span>
                        <a onclick="couponRemove()" class="ml-10 text-danger" style="cursor:pointer"><i class="fi-rs-cross-small"></i></a>
                    </td>
                    <td class="text-white cart_total_amount"><strong class="text-warning">${data.discount}%</strong></td>
                </tr>
                <tr>
                    <td class="text-white cart_total_label">قيمة الخصم</td>
                    <td class="text-white cart_total_amount"><strong>ر.س${discountAmount.toFixed(2)}</strong></td>
                </tr>
                <tr>
                    <td class="text-white cart_total_label">المجموع النهائي</td>
                    <td class="text-white cart_total_amount"><strong>ر.س${total.toFixed(2)}</strong></td>
                </tr>`;
            } else {
                html += `
                <tr>
                    <td class="text-white cart_total_label">المجموع النهائي</td>
                    <td class="text-white cart_total_amount"><strong>ر.س{{ $totalPrice }}</strong></td>
                </tr>`;
            }

            document.getElementById("couponCalField").innerHTML = html;
        });
    }

    function couponRemove() {
        fetch("/coupon-remove")
        .then(res => res.json())
        .then(data => {
            document.getElementById("couponField").style.display = "block";
            couponCalculation();
        });
    }

    window.onload = couponCalculation;
</script>

@endsection
