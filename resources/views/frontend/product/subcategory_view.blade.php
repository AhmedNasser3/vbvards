@extends('frontend.master')
@section('content')
@section('title')
    {{ $breadsubcat->category->category_name }} >  {{ $breadsubcat->subcategory_name }} الاقسام الفرعية
@endsection

 <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header" style="background: #0d1624">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h5 class="mb-15">{{ $breadsubcat->subcategory_name }}</h5>
                            <div class="breadcrumb">
                                <a href="index.html" rel="nofollow"><i class="mr-5 fi-rs-home"></i>رئيسية</a>
   <span></span>{{ $breadsubcat->category->category_name }} <span></span>  {{ $breadsubcat->subcategory_name }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="flex-row-reverse row">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
 <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="mr-10 sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid">


          @foreach($products as $product)
    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s" style="border: none">
            <div class="product-img-action-wrap" style="background: transparent">
                <div class="product-img product-img-zoom">
                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />

                    </a>
                </div>
                <div class="product-action-1">
                     <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  ><i class="fi-rs-heart"></i></a>

   <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

   <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>
                </div>

    @php
    $amount = $product->selling_price - $product->discount_price;
    $discount = ($amount/$product->selling_price) * 100;

    @endphp


                <div class="product-badges product-badges-position product-badges-mrg">

                    @if($product->discount_price == NULL)
                    <span class="new">New</span>
                    @else
                    <span class="hot"> {{ round($discount) }} %</span>
                    @endif


                </div>
            </div>
            <div style="color: #25BA84"  class="product-content-wrap">
                <div class="product-category">
                    <a  style="color: #58ddac" href="shop-grid-right.html">{{ $product['subcategory']['subcategory_name'] }}</a>
                </div>
                <h2><a  style="color: #25BA84"href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                <div class="product-rate-cover">
                    <div class="product-rate d-inline-block">
                        <div class="product-rating" style="width: 90%"></div>
                    </div>
                    <span class="ml-5 font-small text-muted"> (4.0)</span>
                </div>
                <div>
                    @if($product->vendor_id == NULL)
<span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                    @else

                    @endif



                </div>
                <div class="product-card-bottom">

                    @if($product->discount_price == NULL)
                     <div class="product-price">
                        <span><svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">{{ $product->selling_price }}</span>

                    </div>


                    @else
                    <div class="product-price">
                        <span><svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">
        <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b"></path>
        </svg>{{ $product->discount_price }}</span>
                        <span style="color: #f74b4b" class="old-price"><svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">
        <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b"></path>
        </svg>{{ $product->selling_price }}</span>
                    </div>
                    @endif



                    <div class="add-cart">
                        <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="mr-5 fi-rs-shopping-cart"></i>Details </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end product card-->
    @endforeach






                    </div>
                    <!--product grid-->
                    <div class="mt-20 mb-20 pagination-area">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!--End Deals-->


                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget widget-category-2 mb-30">
                        <h5 class="section-title style-1 mb-30">الاقسام</h5>
                        <ul>

    	@foreach($categories as $category)

@php

$products = App\Models\Product::where('category_id',$category->id)->get();

@endphp


        <li>
            <a style="color: #58ddac" href="shop-grid-right.html"> <img src=" {{ asset($category->category_image) }} " alt="" />{{ $category->category_name }}</a><span class="count">{{ count($products) }}</span>
        </li>
        @endforeach
                        </ul>
                    </div>
                    <!-- Fillter By Price -->

                    <!-- Product sidebar Widget -->
                    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                        <h5 class="text-white section-title style-1 mb-30" ></h5>المنتجات الجديدة

        @foreach($newProduct as $product)
        <div class="clearfix single-post">
            <div class="image">
                <img src="{{ asset( $product->product_thambnail ) }}" alt="#" />
            </div>
            <div class="pt-10 content">
                <p><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></p>

                   @if($product->discount_price == NULL)
                    <p class="mt-5 mb-0 price">        <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b"></path>{{ $product->selling_price }}</p>
                   @else
                   <p class="mt-5 mb-0 price">        </svg>{{ $product->discount_price }}</p>
                   @endif

                <div class="product-rate">
                    <div class="product-rating" style="width: 90%"></div>
                </div>
            </div>
        </div>
      @endforeach



                    </div>


                </div>
            </div>
        </div>
@endsection
