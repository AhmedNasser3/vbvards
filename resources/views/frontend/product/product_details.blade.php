@extends('frontend.master')
@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
            <span></span> <a style="color: #58ddac" href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a> <span></span> {{ $product['subcategory']['subcategory_name'] }} <span></span>{{ $product->product_name }}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="m-auto col-xl-10 col-lg-12">
<div class="product-detail accordion-detail">
<div class="row mb-50 mt-30">
<div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
    <div class="detail-gallery">
        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
        <!-- MAIN SLIDES -->
        <div class="product-image-slider">
            @foreach($multiImage as $img)
            <figure class="border-radius-10" style="display: flex;justify-content:center;">
                <img src="{{ asset($img->photo_name) }} " alt="product image" />
            </figure>
            @endforeach
        </div>
        <!-- THUMBNAILS -->
        <div class="slider-nav-thumbnails">
            @foreach($multiImage as $img)
            <div><img src="{{ asset($img->photo_name) }}" alt="product image" /></div>
             @endforeach

        </div>
    </div>
    <!-- End Gallery -->
</div>
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="detail-info pr-30 pl-30">
        @if($product->product_qty > 0)
         <span class="stock-status in-stock">متوفر في المخزون  </span>
        @else
        <span class="stock-status out-stock">Stock Out </span>
        @endif



        <h2 class="title-detail" id="dpname"> {{ $product->product_name }} </h2>
        <div class="product-detail-rating">
            <div class="product-rate-cover text-end">

@php

$reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();

$avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
@endphp


                <div class="product-rate d-inline-block">
@if($avarage == 0)

@elseif($avarage == 1 || $avarage < 2)
<div class="product-rating" style="width: 20%"></div>
@elseif($avarage == 2 || $avarage < 3)
<div class="product-rating" style="width: 40%"></div>
@elseif($avarage == 3 || $avarage < 4)
<div class="product-rating" style="width: 60%"></div>
@elseif($avarage == 4 || $avarage < 5)
<div class="product-rating" style="width: 80%"></div>
@elseif($avarage == 5 || $avarage < 5)
<div class="product-rating" style="width: 100%"></div>
@endif
                </div>



                <span class="ml-5 font-small text-muted"> ({{ count($reviewcount)}} المراجعات)</span>
            </div>
        </div>
        <div class="clearfix product-price-cover">
@php
$amount = $product->selling_price - $product->discount_price;
$discount = ($amount/$product->selling_price) * 100;
@endphp

@if($product->discount_price == NULL)
<div class="float-left product-price primary-color">
    <span class="current-price text-brand"><svg  xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">
        <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b; font-size: .3rem;"></path>
      </svg>{{ $product->selling_price }}</span>

</div>
@else

<div class="float-left product-price primary-color" style="display: flex">
    <span class="current-price text-brand">{{ $product->discount_price }}</span>
    <span>
        <span class="save-price font-md color3 ml-15">{{ round($discount) }}% Off</span>
        <span class="old-price font-md ml-15"><svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">
            <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b;font-size: .3rem;"></path>
          </svg>{{ $product->selling_price }}</span>
    </span>
</div>

@endif


        </div>
        <div class="short-desc mb-30">
            <p class="font-lg"> {{ $product->short_descp }}</p>
        </div>

@if($product->product_size == NULL)

@else

<div class="attr-detail attr-size mb-30" hidden>
<strong class="mr-10" style="width:50px;">Size : </strong>
 <select class="form-control unicase-form-control" id="dsize">
     <option selected="" disabled="">--Choose Size--</option>
     @foreach($product_size as $size)
     <option value="{{ $size }}">{{ ucwords($size)  }}</option>
     @endforeach
 </select>
</div>


@endif


@if($product->product_color == NULL)

@else

<div class="attr-detail attr-size mb-30" hidden>
<strong class="mr-10" style="width:50px;">Color : </strong>
 <select class="form-control unicase-form-control" id="dcolor">
     <option selected="" disabled="">--Choose Color--</option>
     @foreach($product_color as $color)
     <option value="{{ $color }}">{{ ucwords($color)  }}</option>
     @endforeach
 </select>
</div>


@endif



        <div class="detail-extralink mb-50">
            <div class="border detail-qty radius">
                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
<input type="text" name="quantity" id="dqty" class="qty-val" value="1" min="1">
                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
            </div>
            <div class="product-extra-link2">

<input type="hidden" id="dproduct_id" value="{{ $product->id }}">

<input type="hidden" id="vproduct_id" value="{{ $product->vendor_id }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<span hidden id="product-name-{{ $product->id }}">{{ $product->name }}</span>

<!-- زر الإضافة للسلة -->
<div class="add-to-cart">
    @auth
    <div class="product-item">
        <div hidden>
            <img src="{{ asset($product->product_thambnail) }}" width="80" alt="صورة المنتج">
        </div>
        <div hidden>
            <!-- رابط لعرض تفاصيل المنتج مع ID مرتبط -->
            <a hidden href="{{ url('product/details/' . $product->id . '/' . urlencode($product->product_slug)) }}"
               id="product-name-{{ $product->id }}"
               class="product-name"
               target="_blank">
               <i class="fa-solid fa-link"></i> {{ $product->product_name }}
            </a>
        </div>
        <div hidden><strong>🔢 الكمية:</strong> {{ $product->qty }}</div>
        <div hidden><strong>💰 السعر:</strong> ${{ $product->price }}</div>

        <!-- زر "أضف للسلة" -->
        <div style="margin-top: 10px;">
            <button onclick="addProductToCart({{ $product->id }})" class="btn btn-outline-primary w-100">
                <i class="fa fa-cart-plus"></i> أضف للسلة
            </button>
        </div>
    </div>
    @endauth
    @guest
    <a href="{{ route('login') }}">
        <button onclick="" class="add-to-cart-btn">
            <i class="icon-cart"></i> أضف للسلة
        </button>
    </a>
    @endguest
</div>



                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
            </div>
        </div>



<hr>

<div class="font-xs">
<ul class="mr-50 float-start">
<li class="mb-5">براند: <span class="text-brand">{{ $product['brand']['brand_name'] }}</span></li>

<li class="mb-5">قسم:<span class="text-brand"> {{ $product['category']['category_name'] }}</span></li>

<li>قسم فرعي: <span class="text-brand">{{ $product['subcategory']['subcategory_name'] }}</span></li>
</ul>

<ul class="float-start">
<li class="mb-5">كود المنتج <a href="#">{{ $product->product_code }}</a></li>

<li class="mb-5">وسوم: <a href="#" rel="tag"> {{ $product->product_tags }}</a></li>

<li>المخزون:<span class="ml-5 in-stock text-brand">({{ $product->product_qty }}) قطعة متوفر في المخزون </span></li>
</ul>
</div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
<li class="nav-item">
<a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">التفاصيل</a>
</li>
<li class="nav-item">
{{--  <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">معلومات اضافية</a>  --}}
</li>
<li class="nav-item">
</li>
<li class="nav-item">
<a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">المراجعات ({{ count($reviewcount) }})</a>
</li>
</ul>
<div class="tab-content shop_info_tab entry-main-content">
<div class="tab-pane fade show active" id="Description">
<div class="">
<p> {!! $product->long_descp !!} </p>

</div>
</div>
<div class="tab-pane fade" id="Additional-info">
<table class="font-md">
<tbody>
    <tr class="stand-up">
        <th>Stand Up</th>
        <td>
            <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
        </td>
    </tr>
    <tr class="folded-wo-wheels">
        <th>Folded (w/o wheels)</th>
        <td>
            <p>32.5″L x 18.5″W x 16.5″H</p>
        </td>
    </tr>
    <tr class="folded-w-wheels">
        <th>Folded (w/ wheels)</th>
        <td>
            <p>32.5″L x 24″W x 18.5″H</p>
        </td>
    </tr>
    <tr class="door-pass-through">
        <th>Door Pass Through</th>
        <td>
            <p>24</p>
        </td>
    </tr>
    <tr class="frame">
        <th>Frame</th>
        <td>
            <p>Aluminum</p>
        </td>
    </tr>
    <tr class="weight-wo-wheels">
        <th>Weight (w/o wheels)</th>
        <td>
            <p>20 LBS</p>
        </td>
    </tr>
    <tr class="weight-capacity">
        <th>Weight Capacity</th>
        <td>
            <p>60 LBS</p>
        </td>
    </tr>
    <tr class="width">
        <th>Width</th>
        <td>
            <p>24″</p>
        </td>
    </tr>
    <tr class="handle-height-ground-to-handle">
        <th>Handle height (ground to handle)</th>
        <td>
            <p>37-45″</p>
        </td>
    </tr>
    <tr class="wheels">
        <th>Wheels</th>
        <td>
            <p>12″ air / wide track slick tread</p>
        </td>
    </tr>
    <tr class="seat-back-height">
        <th>Seat back height</th>
        <td>
            <p>21.5″</p>
        </td>
    </tr>
    <tr class="head-room-inside-canopy">
        <th>Head room (inside canopy)</th>
        <td>
            <p>25″</p>
        </td>
    </tr>
    <tr class="pa_color">
        <th>Color</th>
        <td>
            <p>Black, Blue, Red, White</p>
        </td>
    </tr>
    <tr class="pa_size">
        <th>Size</th>
        <td>
            <p>M, S</p>
        </td>
    </tr>
</tbody>
</table>
</div>


<div class="tab-pane fade" id="Vendor-info">
<div class="vendor-logo d-flex mb-30">
<img src="{{ (!empty($product->vendor->photo)) ? url('upload/vendor_images/'.$product->vendor->photo):url('upload/no_image.jpg') }}" alt="" />
<div class="vendor-name ml-15">


    <div class="product-rate-cover text-end">
        <div class="product-rate d-inline-block">
            <div class="product-rating" style="width: 90%"></div>
        </div>
        <span class="ml-5 font-small text-muted"> (32 reviews)</span>
    </div>
</div>
</div>



</div>


<div class="tab-pane fade" id="Reviews">
<!--Comments-->
<div class="comments-area">
<div class="row">
    <div class="col-lg-8">
        <h4 class="mb-30">Customer questions & answers</h4>
        <div class="comment-list">
@php
$reviews = App\Models\Review::where('product_id',$product->id)->latest()->limit(5)->get();
@endphp

@foreach($reviews as $item)

@if($item->status == 0)

@else

<div class="single-comment justify-content-between d-flex mb-30">
<div class="user justify-content-between d-flex">
    <div class="text-center thumb">
        <img src="{{ (!empty($item->user->photo)) ? url('upload/user_images/'.$item->user->photo):url('upload/no_image.jpg') }}" alt="" />
        <a href="#" class="font-heading text-brand">{{ $item->user->name }}</a>
    </div>
    <div class="desc">
        <div class="mb-10 d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <span class="font-xs text-muted"> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
            </div>
            <div class="product-rate d-inline-block">

@if($item->rating == NULL)
@elseif($item->rating == 1)
<div class="product-rating" style="width: 20%"></div>
@elseif($item->rating == 2)
<div class="product-rating" style="width: 40%"></div>
@elseif($item->rating == 3)
<div class="product-rating" style="width: 60%"></div>
@elseif($item->rating == 4)
<div class="product-rating" style="width: 80%"></div>
@elseif($item->rating == 5)
<div class="product-rating" style="width: 100%"></div>
@endif
            </div>
        </div>
        <p class="mb-10">{{ $item->comment }} <a href="#" class="reply">Reply</a></p>
    </div>
</div>
</div>

@endif


@endforeach


        </div>
    </div>

    <div class="col-lg-4">
        <h4 class="mb-30">اقييم العملاء</h4>
        <div class="d-flex mb-30">
            <div class="product-rate d-inline-block mr-15">
                <div class="product-rating" style="width: 90%"></div>
            </div>
            <h6>4.8 out of 5</h6>
        </div>
        <div class="progress">
            <span>5 star</span>
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
        </div>
        <div class="progress">
            <span>4 star</span>
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>
        <div class="progress">
            <span>3 star</span>
            <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
        </div>
        <div class="progress">
            <span>2 star</span>
            <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
        </div>
        <div class="progress mb-30">
            <span>1 star</span>
            <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
        </div>
        <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
    </div>
</div>
</div>





<!--comment form-->
<div class="comment-form">
<h4 class="mb-15">Add a review</h4>

@guest
<p> <b>For Add Product Review. You Need To Login First <a href="{{ route('login')}}">Login Here </a> </b></p>

@else


<div class="row">
    <div class="col-lg-8 col-md-12">
<form class="form-contact comment_form" action="{{ route('store.review') }}" method="post" id="commentForm">
@csrf


            <div class="row">

<input type="hidden" name="product_id" value="{{ $product->id }}">

@if($product->vendor_id == NULL)
<input type="hidden" name="hvendor_id" value="">
@else
<input type="hidden" name="hvendor_id" value="{{ $product->vendor_id }}">
@endif

<table class="table" style=" width: 60%;">
<thead>
    <tr>
        <th class="cell-level">&nbsp;</th>
        <th>1 star</th>
        <th>2 star</th>
        <th>3 star</th>
        <th>4 star</th>
        <th>5 star</th>
    </tr>
</thead>

<tbody>
    <tr>
<td class="cell-level">Quality</td>
<td><input type="radio" name="quality" class="radio-sm" value="1"></td>
<td><input type="radio" name="quality" class="radio-sm" value="2"></td>
<td><input type="radio" name="quality" class="radio-sm" value="3"></td>
<td><input type="radio" name="quality" class="radio-sm" value="4"></td>
<td><input type="radio" name="quality" class="radio-sm" value="5"></td>
    </tr>
</tbody>
</table>






<div class="col-12">
<div class="form-group">
    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
</div>
</div>


            </div>
            <div class="form-group">
                <button type="submit" class="button button-contactForm">Submit Review</button>
            </div>
        </form>
    </div>
</div>

@endguest


</div>
</div>
</div>
</div>
</div>



<div class="row mt-60">
<div class="col-12">
<h2 class="section-title style-1 mb-30">منتجات مشابهة</h2>
</div>
<div class="col-12">
<div class="row related-products">

    <div class="products-wrapper">
        @foreach($relatedProduct as $product)
            <div class="product-card">

                {{-- زر المفضلة --}}
                <button class="wishlist-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)">
                    <i class="fa-solid fa-heart"></i>
                </button>



                {{-- صورة المنتج --}}
                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                    <img src="{{ asset($product->product_thambnail) }}" alt="{{ $product->product_name }}">
                </a>

                {{-- عنوان المنتج --}}
                <a style="color:#25BA84" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="title  text-decoration-none">
                    {{ Str::limit($product->product_name, 40) }}
                </a>
                {{-- الخصم --}}
                @if($product->discount_price == NULL)
                <div class="product-price">
                   <span><svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">
 <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b"></path>
</svg>{{ $product->selling_price }}</span>

               </div>

               @else
               <div class="product-price">
                   <span style="color: #f74b4b" class="old-price"><svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">
                    <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b"></path>
                </svg>{{ $product->selling_price }}</span>
                <span>{{ $product->discount_price }}</span>
               </div>
               @endif
                {{-- زر السلة --}}
                <div class="mt-auto w-100">
                    @if($product->product_qty == 0)
                        <button class="btn btn-secondary w-100" disabled>نفذت الكمية</button>
                    @else
                        @auth
                        <div class="product-item">
                            <div hidden>
                                <img src="{{ asset($product->product_thambnail) }}" width="80" alt="صورة المنتج">
                            </div>
                            <div hidden>
                                <!-- رابط لعرض تفاصيل المنتج مع ID مرتبط -->
                                <a hidden href="{{ url('product/details/' . $product->id . '/' . urlencode($product->product_slug)) }}"
                                   id="product-name-{{ $product->id }}"
                                   class="product-name"
                                   target="_blank">
                                   <i class="fa-solid fa-link"></i> {{ $product->product_name }}
                                </a>
                            </div>
                            <div hidden><strong>🔢 الكمية:</strong> {{ $product->qty }}</div>
                            <div hidden><strong>💰 السعر:</strong> ${{ $product->price }}</div>

                            <!-- زر "أضف للسلة" -->
                            <div style="margin-top: 10px;">
                                <button onclick="addProductToCart({{ $product->id }})" class="btn btn-outline-primary w-100">
                                    <i class="fa fa-cart-plus"></i> أضف للسلة
                                </button>
                            </div>
                        </div>

                        @endauth
                        @guest
                            <a href="{{ route('login') }}">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="fa fa-cart-plus"></i> أضف للسلة
                                </button>
                            </a>
                        @endguest
                    @endif
                </div>

            </div>
        @endforeach
    </div>




</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function addProductToCart(productId) {
        const productNameElement = document.querySelector(`#product-name-${productId}`);

        if (!productNameElement) {
            console.error(`العنصر الذي يحمل ID "product-name-${productId}" غير موجود!`);
            return;
        }

        const product_name = productNameElement.textContent;
        const quantity = 1;
        const color = 'default';
        const size = 'default';
        const vendor = 'default';

        fetch(`/cart/product/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                product_name: product_name,
                quantity: quantity,
                color: color,
                size: size,
                vendor: vendor
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ تم إضافة المنتج إلى السلة');
            } else {
                alert('❌ حدث خطأ يرجى المحاولة لاحقًا');
                console.error(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('⚠️ خطأ في الاتصال بالخادم');
        });
    }
</script>
