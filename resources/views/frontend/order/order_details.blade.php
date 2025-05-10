@extends('frontend.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<style>

    tr,th {
        color: white;
    }
</style>

<div class="page-header breadcrumb-wrap">
          <div class="container">
              <div class="breadcrumb">
                  <a href="index.html" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
                  <span></span> My Account
              </div>
          </div>
      </div>
      <div class="page-content pt-50 pb-50">
          <div class="container">
              <div class="row">
                  <div class="m-auto col-lg-12">
<div class="row">

<!-- // Start Col md 3 menu -->

@include('frontend.includes.dashboard_sidebar_menu')
<!-- // End Col md 3 menu -->



<!-- // Start Col md 9  -->
<div class="col-md-9">
  <div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>تفاصيل الطلب</h4></div>
            <hr>
            <div class="card-body">
                <table class="table" style="background:#0d1624;color:#ffffff;font-weight: 600;">
                    <tr>
                        <th style="color:#25BA84;">اسم المستلم:</th>
                        <th>{{ $order->name ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">رقم هاتف المستلم:</th>
                        <th>{{ $order->phone ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">البريد الإلكتروني:</th>
                        <th>{{ $order->email ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">عنوان الشحن:</th>
                        <th>{{ $order->adress ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">المنطقة:</th>
                        <th>{{ $order->division->division_name ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">الحي / المحافظة:</th>
                        <th>{{ $order->district->district_name ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">الولاية:</th>
                        <th>{{ $order->state->state_name ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">الرمز البريدي:</th>
                        <th>{{ $order->post_code ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">تاريخ الطلب:</th>
                        <th>{{ $order->order_date ?? '' }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<!-- // End col-md-6  -->


      <div class="col-md-6">
          <div class="card">
             <div class="card-header"><h4>رقم الفاتورة
<span class="text-danger">Invoice : {{ $order->invoice_no }} </span></h4>
              </div>
             <hr>
             <div class="card-body">
                <table class="table" style="background:#0d1624;color:#ffffff;font-weight:600;">
                    <tr>
                        <th style="color:#25BA84;">الاسم:</th>
                        <th>{{ $order->user->name ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">رقم الهاتف:</th>
                        <th>{{ $order->user->phone ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">طريقة الدفع:</th>
                        <th>{{ $order->payment_method ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">رقم المعاملة:</th>
                        <th>{{ $order->transaction_id ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">رقم الفاتورة:</th>
                        <th style="color:#dc3545;">{{ $order->invoice_no ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">المبلغ الإجمالي:</th>
                        <th>${{ $order->amount ?? '' }}</th>
                    </tr>

                    <tr>
                        <th style="color:#25BA84;">حالة الطلب:</th>
                        <th><span class="badge rounded-pill bg-warning text-dark">{{ $order->status }}</span></th>
                    </tr>
                </table>


             </div>

          </div>
      </div>
<!-- // End col-md-6  -->

  </div><!-- // End Row  -->




 </div>
<!-- // End Col md 9  -->


                      </div>
                  </div>
              </div>
          </div>
      </div>


      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" style="font-weight: 600;">
                        <tbody>
                            <tr style="background:#0d1624;color:#25BA84;">
                                <td class="col-md-1">
                                    <label>الصورة</label>
                                </td>
                                <td class="col-md-2">
                                    <label>اسم المنتج</label>
                                </td>
                                <td class="col-md-2">
                                    <label>اسم البائع</label>
                                </td>
                                <td class="col-md-2">
                                    <label>كود المنتج</label>
                                </td>
                                <td class="col-md-1">
                                    <label>اللون</label>
                                </td>
                                <td class="col-md-1">
                                    <label>المقاس</label>
                                </td>
                                <td class="col-md-1">
                                    <label>الكمية</label>
                                </td>
                                <td class="col-md-3">
                                    <label>السعر</label>
                                </td>
                            </tr>

                            @foreach($orderItem as $item)
                            <tr style="border:none">
                                <td class="col-md-1">
                                    <label><img src="{{ asset($item->product->product_thambnail) }}" style="width:50px; height:50px;"></label>
                                </td>
                                <td class="col-md-2">
                                    <label>{{ $item->product->product_name }}</label>
                                </td>
                                @if($item->vendor_id == NULL)
                                <td class="col-md-2">
                                    <label>المالك</label>
                                </td>
                                @else
                                <td class="col-md-2">
                                    <label>{{ $item->product->vendor->name ?? '' }}</label>
                                </td>
                                @endif

                                <td class="col-md-2">
                                    <label>{{ $item->product->product_code ?? '' }}</label>
                                </td>

                                <td class="col-md-1">
                                    <label>{{ $item->color ?? '---' }}</label>
                                </td>

                                <td class="col-md-1">
                                    <label>{{ $item->size ?? '---' }}</label>
                                </td>

                                <td class="col-md-1">
                                    <label>{{ $item->qty ?? '' }}</label>
                                </td>

                                <td class="col-md-3">
                                    <label>${{ $item->price }} <br> الإجمالي = ${{ $item->price * $item->qty }}</label>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


                  </div>

              </div>

<!--  // Start Return Order Option  -->

@if($order->status !== 'deliverd')

@else

@php
$order = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
@endphp

@if($order)
<form action="{{ route('return.order',$order->id) }}" method="post">
  @csrf

<div class="form-group" style=" font-weight: 600; font-size: initial; color: #000000; ">
                  <label>Order Return Reason</label>
           <textarea name="return_reason" class="form-control"  style="width:40%;"></textarea>
              </div>
  <button type="submit" class="btn-sm btn-danger" style="width:40%;">Order Return</button>
</form>

@else

<h5><span class="" style="color:red;">You have send return request for this product</span></h5><br><br>
@endif

@endif
<!--  // End Return Order Option  -->






          </div>
      </div>






@endsection
<style>
    label{
        color: rgb(255, 255, 255);
    }
</style>
