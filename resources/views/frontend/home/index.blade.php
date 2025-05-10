@extends('frontend.master')
@section('content')

@include('frontend.home.home_slider')
<script src="https://cdn.lordicon.com/lordicon.js"></script>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>سلايدر صور</title>
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        />
        <style>
            body {
                margin: 0;
                padding: 0;
                direction: ltr;
                font-family: sans-serif;
            }

            .swiper {
                background: #0d1624;
                width: 80%; /* تعيين العرض ليأخذ 80% من عرض الشاشة */
                margin: 0 auto; /* لضمان توسيط السلايدر في الصفحة */
                padding: 20px 10%; /* إضافة padding للجانبين */
            }

            .swiper-slide {
                display: flex;
                flex-direction: column; /* لتكديس الصورة والنص فوق بعض */
                justify-content: center;
                align-items: center;
                border-radius: 10px;
                overflow: hidden;
                position: relative;
            }

            .swiper-slide img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }

            .swiper-slide p {
                font-size:1.3rem;
                font-weight: 800;
                color: #25BA84;
            }

            /* تنسيق النص تحت الصور */
            .image-caption {
                margin-top: 10px; /* إضافة مسافة بين الصورة والنص */
                color: white; /* اللون الأبيض للنص */
                font-size: 14px; /* حجم النص */
                text-align: center;
            }

        </style>
    </head>
    <body>

        <div class="text_title">
            <div class="text_title_main">
                <h5>تصنيفات رائجة</h5>
            </div>
            <div class="text_title_main_2">
                <div class="text_title_main_2_bg">
                    <h6>استكشف المزيد</h6>
                </div>
            </div>
        </div>

        <div style="background:#0d1624">
            <!-- سلايدر الصور -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/NfVBQlSRYR5EsFfoliEHIhEnJXkHzKbUTx4viHh6.png" alt="img2" />
                        <p class="image-caption">التطبيقات</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/jJh3PXpLiWSDKuDlVKDn0Vue0GAsGoH3fFZHzP2B.png" alt="img2" />
                        <p class="image-caption">العاب</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/KBz8gwigY6huv4MN4V3DO2WK62oIFph6J7NhK0yg.png" alt="img2" />
                        <p class="image-caption">شحن رصيد</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/gAsj4RIJohOrb1ECsOTNrOoy17fADEs41Ucu5Ddg.png" alt="img2" />
                        <p class="image-caption">استرداد نقدي</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/azyb0ZMHIayRW2YNOD8jHeY8OLj7ZaMpTPiRryIC.png" alt="img2" />
                        <p class="image-caption">تخفيضات</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/2RMD3JRsCodGw8flNhV5ZZ2Ypp1CBqOuZI0V8ke3.png" alt="img2" />
                        <p class="image-caption">سوشيال ميديا</p>
                    </div>

                    <!-- تكرار الصور علشان الاستمرارية تكون ناعمة -->
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/PVykJfk3ZNs8RMcHDDBv1SEUfeJ1gwMsIjaX5NI5.png" alt="img2" />
                        <p class="image-caption">التصميم</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://cdn.salla.sa/form-builder/C6v0r7nf6SQ5bYVnkjIMyf6R34i1UYhxFAQAFRYB.png" alt="img2" />
                        <p class="image-caption">المشاهدة</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- سكريبت مكتبة Swiper -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper(".swiper", {
                slidesPerView: 5,
                spaceBetween: 20,
                loop: true,
                speed: 3000, // سرعة الحركة
                autoplay: {
                    delay: 0, // مفيش وقت انتظار
                    disableOnInteraction: false,
                },
                grabCursor: true,
                breakpoints: {
                    20: {
                        slidesPerView: 2, // عرض 4 صور عند حجم الشاشة أقل من 1024px
                        spaceBetween: 10, // المسافة بين الصور
                    },
                    600:{
                        slidesPerView: 5, // عرض 4 صور عند حجم الشاشة أقل من 1024px
                        spaceBetween: 10, // المسافة بين الصور
                    }
                },
            });
        </script>
    </body>
</html>


    <!--End category slider-->
    @include('frontend.home.home_banner')

    <!--End banners-->
    <div class="text_title">
        <div class="text_title_main">
            <lord-icon
            src="https://cdn.lordicon.com/islwbrad.json"
            trigger="loop"
            delay="2000"
            colors="primary:#25BA84,secondary:#25BA84"
            style="width: 130px; height: 130px;"
            data-wow-delay="0.5s">
        </lord-icon>

            <h2 style="color: #25BA84;">خدماتنا الأكثر مبيعًا</h2>
        </div>
        <div class="text_title_main_2">
            <div class="text_title_main_2_bg">
                <h6>استكشف المزيد</h6>
            </div>
        </div>
    </div>
    @include('frontend.home.most_buying')

    <div class="relative my-10 overflow-hidden h-[1050px] min-h-[1050px] rounded-xl" style="display: flex;justify-content:center">
        <!-- صورة الخلفية -->
        <img src="https://cdn.salla.sa/form-builder/WuhqoZIHi13MKiRpeH6VXEApjZpa3TUBijUhvYY0.webp"
             alt="صورة البانر"
             class="absolute inset-0 object-cover w-full h-full rounded-xl" />


      </div>

    <!--End hero slider-->
    <div class="text_title">
        <div class="text_title_main">
            <h5>الاقسام الجديدة</h5>
        </div>
        <div class="text_title_main_2">
            <div class="text_title_main_2_bg">
                <h6>استكشف المزيد</h6>
            </div>
        </div>
    </div>
    @include('frontend.home.home_features_category')



    @include('frontend.home.home_new_product')
    <div class="ch_banner" style="padding: 1% 0 0 0; display: grid;">
        <div class="ch_banner_container">
            <div class="ch_banner_content">
                <div class="ch_banner_data">
                    <div class="ch_banner_img"  style="padding: 5% 0 0 0; ">
                        <img src="https://cdn.salla.sa/form-builder/gvxKqRWAvLXGsjeHWyZsKdvBFw7jmn1c5PfZla0d.webp" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .ch_banner {
            display: flex;
            justify-content: center;
            background: #0d1624;
        }
        .ch_banner_container {
            background: #0d1624;
            padding: 0 10%;
        }
    </style>


    <!--Products Tabs-->



    @include('frontend.home.home_features_product')


    <!--End Best Sales-->


    <!-- Fashion Category -->

    @php
    $products = App\Models\Product::where('status',1)->orderBy('id','ASC')->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
    @endphp
    <div class="text_title">
        <div class="text_title_main">
            <h5>منتجات جميع</h5>
        </div>
        <div class="text_title_main_2">
            <div class="text_title_main_2_bg">
                <h6>استكشف المزيد</h6>
            </div>
        </div>
    </div>
    <section  class="product-tabs section-padding position-relative" style="            display: flex;justify-content:center;
    background: #0d1624;">
            <div class="container">

                <div style="product_bg">

                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="products row product-grid-4" style="display: flex; justify-content: center; align-items: center; text-align: center;">




                            <div class="products-wrapper">
                                @foreach($products as $index => $product)
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
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one-->



            @foreach($categories as $category)
                    <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4">

    @php
    $catwiseProduct = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get();
    @endphp

        @forelse($catwiseProduct as $product)
        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s" style="border: none">
            <div class="product-img-action-wrap">
                <div class="product-img product-img-zoom">
                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />

                    </a>
                </div>
                <div class="product-action-1">
                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>

    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                </div>

    @php
    $amount = $product->selling_price - $product->discount_price;

    @endphp


                <div class="product-badges product-badges-position product-badges-mrg">

                    @if($product->discount_price == NULL)
                    <span class="new">New</span>
                    @else
                    <span class="hot"></span>
                    @endif


                </div>
            </div>
            <div style="color: #25BA84"  class="product-content-wrap">
                <div class="product-category">
                    <a style="color: #58ddac" href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                </div>
                <h2><a style="color: #25BA84" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
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
                        <span><svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500">
      <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#f74b4b"></path>
    </svg>{{ $product->selling_price }}</span>

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



                    @if ($product->product_qty == 0 )
                    <div class="add-cart">
                        <a class="block w-full py-2 text-center text-white rounded add" href="#" style="background: #313131;">
                            نفذت الكمية
                        </a>
                    </div>
                    @else
                    <div class="add-cart">
                        <a onclick="addToCart({{ $product->id }})" class="block w-full py-2 text-center text-white rounded add" style="background: transparent;">
                            <i class="mr-5 fi-rs-shopping-cart"></i>اضف  للسلة
                        </a>

                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!--end product card-->

        @empty

        <h5 class="text-danger"> No Product Found </h5>
        @endforelse
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two-->
                    @endforeach


                </div>
            </div>

                <!--End tab-content-->
            </div>
        </section>
        <div class="text_title">
            <div class="text_title_main">
                <h5>الأسئلة الشائعة</h5>
            </div>
            <div class="text_title_main_2">
                <div class="text_title_main_2_bg">
                    <h6>إجابات على أهم الأسئلة</h6>
                </div>
            </div>
        </div>

        <!DOCTYPE html>
        <html lang="ar" dir="rtl">
        <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          <title>الأسئلة الشائعة</title>
          <style>
            .faq-container {
                padding: 2rem 0;
                max-width: 1200px;
                margin: auto;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
              }
            @media screen and (max-width:1024px){
                .faq-container {
                    width: 300px;
                    margin: auto;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1rem;
                  }
            }


            .faq-item {
              background-color: #0e0e1b;
              border-radius: 12px;
              overflow: hidden;
              transition: all 0.3s ease;
              border: 1px solid transparent;
            }

            .faq-header {
              padding: 20px;
              cursor: pointer;
              display: flex;
              align-items: center;
              gap: 10px;
              font-weight: bold;
              font-size: 16px;
              position: relative;
            }

            .faq-header .toggle-btn {
              background-color: #25BA84;
              border-radius: 50%;
              width: 28px;
              height: 28px;
              display: inline-flex;
              align-items: center;
              justify-content: center;
              font-size: 22px;
              color: white;
              transition: background 0.3s ease;
            }

            .faq-header.active .toggle-btn {
              background-color: #59f3bb;
            }

            .faq-body {
              padding: 0 20px;
              max-height: 0;
              overflow: hidden;
              color: white;
              font-size: 15px;
              transition: max-height 0.4s ease, padding 0.3s ease;
            }

            .faq-body.show {
              padding: 20px;
              max-height: 200px;
            }

            .faq-header.active {
              border: 1px solid #4f4fff;
              border-radius: 12px;
            }
          </style>
        </head>
        <body>

          <div class="faq-container">
           <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">هل VB CARD موثوق؟</span>
              </div>
              <div class="faq-body">يثق في في بي كارد 50,000 عميل قاموا بتنفيذ أكثر من 90،000 طلب كما أن في بي كارد موثق لدى المركز السعودي للأعمال برقم (0000160644).</div>
            </div>

            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">متى يتم تنفيذ طلبي؟</span>
              </div>
              <div class="faq-body">يختلف بحسب كل وصف المنتج، فبعض المنتجات يتم تسليمها فوريًا، وأخرى تحتاج لتأكيد أحد ممثلينا ويتم تنفيذها خلال 1-3 ساعات.</div>
            </div>

            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">متى أوقات العمل؟</span>
              </div>
              <div class="faq-body">يبدأ عمل فريق خدمة العملاء الساعة 8:00ص وينتهي في الساعة 8:00م، كما أن فريق تسليم الطلبات يعمل طوال الـ 24 ساعة.</div>
            </div>

            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">كيف استطيع استلام طلبي؟</span>
              </div>
              <div class="faq-body">يتم إرسال بيانات الطلب عبر الرسائل القصيرة SMS وكذلك البريدية وأيضًا عبر الواتساب.</div>
            </div>

            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">ماهي طرق الدفع المتوفرة؟</span>
              </div>
              <div class="faq-body">يمكنك الدفع من خلال الطرق الممكنة الآتية: آبل بي، استيسي بي، مدى، فيزا، ماستركارد، بايبال، الدولار الرقمي.</div>
            </div>
            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">هل يمكن الدفع من خلال العملات المشفرة؟</span>
              </div>
              <div class="faq-body">نعم يمكنك ذلك بالتواصل معنا عبر الواتساب.</div>
            </div>
            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">هل يمكن الدفع من خلال بطائق الشحن؟</span>
              </div>
              <div class="faq-body">نعم يمكنك ذلك بالتواصل معنا عبر الواتساب.</div>
            </div>
            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">أواجه مشكلة لمن أشكو؟</span>
              </div>
              <div class="faq-body">فريقنا على استعداد لمعالجة شكواك عبر الواتساب، فإن لم يتم الرد لمدة 72 ساعة بإمكانك تصعيد الشكوى لبريد الإدارة عبر البريد الآتي: Shakwa@stream-mix.net ، كما نود أن نشير ان ستتعامل الادارة مع شكواك ومحاسبة المقصر فقط ان لم يتم الرد لمدة 72 ساعة متتالية.</div>
            </div>
            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">أرغب بالإنضمام كتاجر</span>
              </div>
              <div class="faq-body">أرغب بالإنضمام كتاجر
                يسعدنا ان تكون من ضمن موزعي منتجاتنا، يمكنك مراسلة البريد الآتي لإستيراد أحد منتجاتنا: partner@stream-mix.net</div>
            </div>
            <div class="faq-item">
              <div class="faq-header">
                <span class="toggle-btn">+</span>
                <span class="question">ماهو القانون الواجب تطبيقه في حال حدوث نزاع؟</span>
              </div>
              <div class="faq-body">حسب اتفاقية المستخدم فإن القانون المتفق على تطبيقه هو القانون المعمول به في المملكة العربية السعودية، وحيث أن حسب اتفاقية المستخدم فإن الجهة المسؤولة عن فض النزاع هي هيئة تحكيم يتفق عليها الطرفين.</div>
            </div>
          </div>

          <script>
            document.querySelectorAll('.faq-header').forEach(header => {
              header.addEventListener('click', () => {
                const isActive = header.classList.contains('active');

                // إغلاق جميع العناصر الأخرى
                document.querySelectorAll('.faq-header').forEach(h => {
                  h.classList.remove('active');
                  h.querySelector('.toggle-btn').textContent = '+';
                });

                document.querySelectorAll('.faq-body').forEach(body => {
                  body.classList.remove('show');
                });

                // فتح العنصر الحالي فقط
                if (!isActive) {
                  header.classList.add('active');
                  header.querySelector('.toggle-btn').textContent = '−';
                  header.nextElementSibling.classList.add('show');
                }
              });
            });
          </script>

        </body>
        </html>

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

<!--End Mobile Category -->




</div>
</div>
</div>
</div>
</section>
<!--End 4 columns-->



<!--Vendor List -->

{{--  @include('frontend.home.home_vendor_list')  --}}

<!--End Vendor List -->

<style>

    .row{
        --bs-gutter-x: 0.1rem;
    }
</style>
@endsection
