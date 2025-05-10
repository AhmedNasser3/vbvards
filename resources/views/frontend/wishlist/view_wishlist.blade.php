@php
use App\Models\Wishlist;
$wishlist = Wishlist::where('user_id', auth()->id())->get();
@endphp

@extends('frontend.master')
@section('content')

<div class="page-header breadcrumb-wrap" style="background: #0d1624">
    <div class="container">
        <div class="breadcrumb" style="color: white">
            <a href="{{ url('/') }}" rel="nofollow"><i class="mr-5 fi-rs-home"></i>رئيسية</a>
            <span></span> المفضلة
        </div>
    </div>
</div>

<div class="container mb-30 mt-50" style="background: #0d1624;margin:0 0 100px 0;">
    <div class="row">
        <div class="m-auto col-xl-10 col-lg-12">
            <div class="mb-50">
                <h1 class="mb-10 heading-2" style="color: white">المفضلة</h1>
                <h6 class="text-body">شركة فيبي كارد للمنتجات</h6>
            </div>

            <div class="table-responsive shopping-summery">
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading" style="border: none">
                            <th style=" color: #674fbe;" class="custome-checkbox start pl-30"></th>
                            <th style=" color: #674fbe;" scope="col" colspan="2">المنتج</th>
                            <th style=" color: #674fbe;" scope="col">السعر</th>
                            <th style=" color: #674fbe;" scope="col">الحالة</th>
                            <th style=" color: #674fbe;" scope="col" class="end">ازالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wishlist as $item)
                            <tr>
                                <td class="custome-checkbox pl-30 start"></td>

                                <td class="image product-thumbnail" style="width: 80px">
                                    <img src="{{ asset($item->product->product_thambnail) }}" alt="{{ $item->product->product_name }}">
                                </td>

                                <td class="product-des product-name">
                                    <h6 class="mb-5">
                                        <a class="product-name text-heading" href="#">
                                            {{ $item->product->product_name }}
                                        </a>
                                    </h6>
                                </td>

                                <td class="price" data-title="السعر">
                                    <h4 class="text-brand">
                                        ر.س{{ $item->product->discount_price ?? $item->product->selling_price }}
                                    </h4>
                                </td>

                                <td class="text-center" data-title="الحالة">
                                    @if($item->product->product_qty > 0)
                                        <span class="badge rounded-pill alert-success">متوفر</span>
                                    @else
                                        <span class="badge rounded-pill alert-danger">غير متوفر</span>
                                    @endif
                                </td>

                                <td class="text-center action" data-title="ازالة">
                                    <a href="" class="text-danger">
                                        <i class="fi-rs-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-white">لا توجد منتجات في المفضلة حالياً</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
