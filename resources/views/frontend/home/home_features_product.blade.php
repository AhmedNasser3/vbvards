
@php
$featured = App\Models\Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
@endphp


<div class="text_title">
    <div class="text_title_main">
        <h5>اشتراكات الافلام والمسلسلات والمشاهدة</h5>
    </div>
    <div class="text_title_main_2">
        <div class="text_title_main_2_bg">
            <h6>استكشف المزيد</h6>
        </div>
    </div>
</div>
<section class="pb-5 section-padding" >
            <div class="container">
                <div class="section-title wow animate__animated animate__fadeIn">


                </div>
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                        <div class="banner-img style-2">
                            <div class="banner-text">
                                <h2 class="text-white mb-100">تصفح احدث المنتجات الان</h2>
                                <a style="color: #58ddac" href="shop-grid-right.html" class="btn btn-xs ">تسوق الان <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                        <div class="tab-content" id="myTabContent-1">
                            <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">



                                        @foreach($featured as $product)
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
                                                        <button onclick="addProductToCart({{ $product->id }})" class="btn btn-outline-primary w-100">
                                                            <i class="fa fa-cart-plus"></i> أضف للسلة
                                                        </button>
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
                            <!--End tab-pane-->


                        </div>
                        <!--End tab-content-->
                    </div>
                    <!--End Col-lg-9-->
                </div>
            </div>
        </section>
        <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true" hidden>
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <!-- MAIN SLIDES -->
                                    <img src=" " alt="product image" id="pimage" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <h5 class="title-detail"><a href=" " class="text-heading" id="pname"> </a></h5>
                                    <br>

                                    <div class="attr-detail attr-size mb-30" id="sizeArea" hidden>
                                        <strong class="mr-10" style="width:60px;">Size : </strong>
                                        <select class="form-control unicase-form-control" id="size" name="size">
                                            <!-- Options will be dynamically filled -->
                                        </select>
                                    </div>

                                    <div class="attr-detail attr-size mb-30" id="colorArea" hidden>
                                        <strong class="mr-10" style="width:60px;">Color : </strong>
                                        <select class="form-control unicase-form-control" id="color" name="color">
                                            <!-- Options will be dynamically filled -->
                                        </select>
                                    </div>

                                    <div class="clearfix product-price-cover">
                                        <div class="float-left product-price primary-color">
                                            <span class="current-price text-brand">$</span>
                                            <span class="current-price text-brand" id="pprice"> </span>
                                            <span class="old-price font-md ml-15">$ </span>
                                            <span class="old-price font-md ml-15" id="oldprice">  </span>
                                        </div>
                                    </div>

                                    <div class="detail-extralink mb-30">
                                        <div class="border detail-qty radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1">
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <!-- زر الإضافة للسلة -->
                                        <div class="add-to-cart">
                                            @auth
                                            <button onclick="addProductToCart({{ $product->id ?? '' }})" class="add-to-cart-btn">
                                                <i class="icon-cart"></i> أضف للسلة
                                            </button>
                                            @endauth
                                            @guest
                                            <a href="{{ route('login') }}">
                                                <button onclick="" class="add-to-cart-btn">
                                                    <i class="icon-cart"></i> أضف للسلة
                                                </button>
                                            </a>
                                            @endguest
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="font-xs">
                                                <ul>
                                                    <li class="mb-5">البراند: <span class="text-brand" id="pbrand"> </span></li>
                                                    <li class="mb-5">الاقسام:<span class="text-brand" id="pcategory"> </span></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="font-xs">
                                                <ul>
                                                    <li class="mb-5">كود المنتج : <span class="text-brand" id="pcode"> </span></li>
                                                    <li class="mb-5">Stock:<span class="badge badge-pill badge-success" id="aviable" style="background:green; color: white;"> </span>
                                                        <span class="badge badge-pill badge-danger" id="stockout" style="background:red; color: white;"> </span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- إضافة jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            // تعريف الدالة addToCart
            function addToCart() {
                var productId = document.getElementById('product_id').value;
                var quantity = document.getElementById('qty').value;
                var color = document.getElementById('color').value;
                var size = document.getElementById('size').value;

                // إرسال البيانات عبر Ajax
                $.ajax({
                    url: '/cart/data/store/' + productId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // إضافة الـ CSRF Token
                        product_name: document.getElementById('pname').innerText,
                        quantity: quantity,
                        color: color,
                        size: size,
                    },
                    success: function(response) {
                        alert(response.success); // عرض رسالة النجاح بعد إضافة المنتج
                    },
                    error: function(xhr, status, error) {
                        // عرض رسالة الخطأ بالتفاصيل
                        console.log("خطأ: " + xhr.status);  // عرض كود الحالة HTTP
                        console.log("نص الخطأ: " + xhr.responseText);  // عرض نص الخطأ

                        alert('حدث خطأ: ' + xhr.status + ' - ' + xhr.responseText); // عرض الخطأ في نافذة التنبيه
                    }
                });
            }


        </script>
