@php
use App\Models\Cart;
use App\Models\Category;
use App\Models\Wishlist;

$cart = [];
$wish = [];

if (auth()->check()) {
    $cart = Cart::where('user_id', auth()->user()->id)->get();
    $wish = Wishlist::where('user_id', auth()->user()->id)->get();
}
@endphp

@php
$categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
@endphp
{{--  <div style="background: #19195f;border:none" class="header-bottom header-bottom-bg-color sticky-bar">
    <div class="container">
        <div class="header-wrap header-space-between position-relative">
            <div class="logo logo-width-1 d-block d-lg-none">
                <a href="/"><img src="{{ asset('assets/imgs/ةتل1Artboard 2.png') }}" alt="logo" /></a>
            </div>
            <div class="logo logo-width-1">
                <a href="/"><img src="{{ asset('assets/imgs/ةتل1Artboard 2.png') }}" alt="logo" /></a>
            </div>
            <div class="header-nav d-none d-lg-flex">
                <div class="main-categori-wrap d-none d-lg-block">
                    <a class="categories-button-active" href="#">
                        <span class="fi-rs-apps"></span> جميع الاقسام
                        <i class="fi-rs-angle-down"></i>
                    </a>
                    <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                    <div class="d-flex categori-dropdown-inner">
                        <ul>
                            @foreach($categories as $item)
                            @if($loop->index < 5)
                            <li>
                                <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img src="{{ asset( $item->category_image ) }}" alt="" /> {{ $item->category_name }} </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        <ul class="end">
                            @foreach($categories as $item)
                            @if($loop->index > 4)
                            <li>
                                <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img src="{{ asset( $item->category_image ) }}" alt="" /> {{ $item->category_name }} </a>
                            </li>
                            @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                <nav>
                    <ul>

                        <li>
                            <a class="active" href="{{ url('/') }}">Home  </a>

                        </li>

                        @php

                        $categories = App\Models\Category::orderBy('category_name','ASC')->limit(3)->get();
                        @endphp

                        @foreach($categories as $category)
                        <li>
                            <a style="color: white" href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }} <i class="fi-rs-angle-down"></i></a>

                            @php
                            $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                            @endphp

                            <ul class="sub-menu">
                                @foreach($subcategories as $subcategory)
                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach




                    </ul>
                </nav>
            </div>
        </div>


        <div class="hotline d-none d-lg-flex">
            <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="header-wrap">
                        <div class="header-right">
                            <div class="header-action-right">
                                <div class="header-action-2">
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('wishlist') }}">
                                            <img class="svgInject" alt="العش" src="{{ asset('assets/imgs/theme/icons/icon-heart.svg') }}" />
                                            <span class="pro-count blue" id="wishQty">{{ @arabicNumber(count($wish)) }} </span>
                                        </a>
                                        <a style="color: white" href="{{ route('wishlist') }}"><span class="lable">قائمة الأمنيات</span></a>
                                    </div>
                                    <div class="header-action-icon-2">
                                        <a class="mini-cart-icon" href="shop-cart.html">
                                            <img alt="العش" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}" />
                                            <span style="color: white" class="pro-count blue" id="cartQty">{{ count($cart) }}</span>
                                        </a>
                                        <a href="{{ route('mycart') }}"><span class="lable">السلة</span></a>

                                    </div>
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('dashboard') }}">
                                            <img class="svgInject" alt="Nest" src="{{ asset('assets/imgs/theme/icons/icon-user.svg') }}" />
                                        </a>
                                        @auth
                                        <a href="{{ route('dashboard') }}"><span class="ml-0 lable">الحساب</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul style="color: black">
                                                <li>
                                                    <a style="color: #131313" href="{{ route('dashboard') }}"><i class="mr-10 fi fi-rs-user"></i>حسابي</a>
                                                </li>
                                                <li>
                                                    <a style="color: #131313" href="{{ route('user.order.page') }}"><i class="mr-10 fi fi-rs-location-alt"></i>تتبع الطلب</a>
                                                </li>
                                                <li>
                                                    <a style="color: #131313" href="{{ route('wishlist') }}"><i class="mr-10 fi fi-rs-heart"></i>قائمة الأمنيات</a>
                                                </li>
                                                <li>
                                                    <a style="color: #131313" href="{{ route('profile.show') }}"><i class="mr-10 fi fi-rs-settings-sliders"></i>الإعدادات</a>
                                                </li>
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                                                        @csrf
                                                    </form>

                                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #131313">
                                                        <i class="mr-10 fi fi-rs-sign-out"></i> تسجيل الخروج
                                                    </a>
                                                                                                    </li>
                                            </ul>
                                        </div>

                                        @else
                                        <a href="{{ route('login') }}"><span class="ml-0 lable">تسجيل الدخول</span></a>

                                        <span class="lable" style="margin-left: 2px; margin-right: 2px;" > | </span>

                                        <a href="{{ route('register') }}"><span class="ml-0 lable">التسجيل</span></a>

                                        @endauth
            </div>
        <div class="header-action-icon-2 d-block d-lg-none">
            <div class="burger-icon burger-icon-white">
                <span class="burger-icon-top"></span>
                <span class="burger-icon-mid"></span>
                <span class="burger-icon-bottom"></span>
            </div>
        </div>
        <div class="header-action-right d-block d-lg-none">
            <div class="header-action-2">
                <div class="header-action-icon-2">
                    <a href="shop-wishlist.html">
                        <img alt="العش" src="{{ asset('assets/imgs/theme/icons/icon-heart.svg') }}" />
                        <span class="pro-count white">4</span>
                    </a>
                </div>
                <div class="header-action-icon-2">
                    <a class="mini-cart-icon" href="#">
                        <img alt="العش" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}" />
                        <span class="pro-count white">2</span>
                    </a>
            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                <ul>
                    <li>
                        <div class="shopping-cart-img">
                            <a href="shop-product-right.html"><img alt="العش" src="{{ asset('assets/imgs/shop/thumbnail-3.jpg') }}" /></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="shop-product-right.html">قميص ستيولا</a></h4>
                            <h3><span>1 × </span>$800.00</h3>
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                        </div>
                    </li>
                    <li>
                        <div class="shopping-cart-img">
                            <a href="shop-product-right.html"><img alt="العش" src="{{ asset('assets/imgs/shop/thumbnail-4.jpg') }}" /></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="shop-product-right.html">فستان 2023</a></h4>
                            <h3><span>1 × </span>$360.00</h3>
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                        </div>
                    </li>
                </ul>
                <div class="shopping-cart-footer">
                    <div class="shopping-cart-total">
                        <h4>المجموع <span>$1160.00</span></h4>
                    </div>
                    <div class="shopping-cart-button">
                        <a href="shop-cart.html">عرض السلة</a>
                        <a href="shop-checkout.html">الدفع</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</header>

<!-- End Header  -->
<style>
    #searchProducts{
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>  --}}
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CSS الخاص بالبادجات -->
<style>
    .icon {
        position: relative;
    }

    .icon-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #25ba84;
        color: white;
        border-radius: 50%;
        font-size: 12px;
        width: 18px;
        height: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        z-index: 10;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- الهيدر -->
<header style="background: #151558; border:none" class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>الافتتاح الكبير، خصم يصل إلى <strong>15%</strong> على جميع المنتجات. فقط <strong>3 أيام</strong> متبقية</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block" style="background: #25BA84; border:none">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a class="text-white" href="{{ route('mycart') }}">عربة التسوق</a></li>
                            <li><a class="text-white" href="{{ route('user.order.page') }}">تتبع الطلب</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>توصيل آمن 100% دون الاتصال بالموظف</li>
                                <li>عروض مذهلة - وفر أكثر مع القسائم</li>
                                <li>مجوهرات فضية عصرية، خصم يصل إلى 35% اليوم</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="header_c">
    <div class="header_c_container">
        <div class="header_c_content">
            <div class="header_c_data">
                <div class="header_c_icons">
                    <div class="icon icon-cart">
                        <a href="{{ route('mycart') }}">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <span class="icon-badge">{{ @arabicNumber(count($cart)) }}</span> <!-- عداد السلة -->
                        </a>
                    </div>
                    <div class="icon icon-fav">
                        {{--  <a href="{{ route('wishlist') }}">
                            <i class="fa-solid fa-heart"></i>
                            <span class="icon-badge">{{ @arabicNumber(count($wish)) }}</span> <!-- عداد المفضلة -->
                        </a>  --}}
                    </div>
                    <div class="icon icon-search">
                        @guest
                        <div style="display: flex; " >
                            <a href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a>
                        </div>
                        @endguest
                        @auth
                        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-user"></i></a>
                        @endauth
                    </div>
                </div>
                <div class="header_c_logo">
                    <img src="{{ asset('assets/imgs/شعار_2.png') }}" alt="الشعار">
                </div>
                <div class="header_c_menu">
                    <h3>القائمة</h3>
                    <div class="header_c_bars">
                        <a href="#" class="open-sidebar">
                            <i class="fa-solid fa-bars-staggered"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>التصنيفات</h3>
        <span class="close-sidebar">&times;</span>
    </div>
    <div class="sidebar-content">
        @php
            $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
        @endphp

        @foreach($categories as $category)
            <div class="category">
                <div class="category-header">
                    <span>{{ $category->category_name }}</span>
                    <span class="arrow">&#9656;</span>
                </div>
                <ul class="subcategory-list" style="display: none;">
                    @php
                        $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();
                    @endphp
                    @foreach($subcategories as $subcategory)
                        <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>

<!-- Overlay -->
<div class="overlay"></div>

<!-- Bottom Bar for mobile view -->
<div class="bottom_bar">
    <div class="bottom_item">
        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-user"></i></a>
        <span>حسابي</span>
    </div>
    <div class="relative bottom_item">
        <div class="badge">{{ @arabicNumber(count($cart)) }}</div>
        <a href="{{ route('mycart') }}"><i class="fa-solid fa-bag-shopping"></i></a>
        <span>السلة</span>
    </div>
    <div class="bottom_item">
        <a href="#" class="open-sidebar"><i class="fa-solid fa-bars-staggered"></i></a>
        <span>القوائم</span>
    </div>
    <div class="bottom_item">
        <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i></a>
        <span>الرئيسية</span>
    </div>
</div>

<!-- CSS -->
<style>
    .bottom_bar {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 43, 0.58);
        padding: 12px 16px;
        box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.2);
        z-index: 999;
        justify-content: space-between;
        align-items: center;
    }

    @media screen and (max-width: 1024px) {
        .bottom_bar {
            display: flex;
        }
    }

    .bottom_item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #25BA84;
        font-size: 14px;
        position: relative;
    }

    .bottom_item a {
        color: #25BA84;
        font-size: 20px;
        text-decoration: none;
    }

    .bottom_item span {
        margin-top: 4px;
        font-size: 12px;
    }

    .badge {
        position: absolute;
        top: -4px;
        right: -6px;
        background-color: red;
        color: white;
        font-size: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .relative {
        position: relative;
    }
</style>

<!-- JavaScript -->
<script>
    function search_result_show() {
        $("#searchProducts").slideDown();
    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }

    $(document).ready(function () {
        // فتح السايد بار
        $(".open-sidebar").click(function () {
            $(".sidebar").addClass("active");
            $(".overlay").fadeIn();
        });

        // إغلاق السايد بار
        $(".close-sidebar, .overlay").click(function () {
            $(".sidebar").removeClass("active");
            $(".overlay").fadeOut();
        });

        // التحكم في فتح/إغلاق subcategories
        $(".category-header").click(function () {
            var $arrow = $(this).find(".arrow");
            var $list = $(this).next(".subcategory-list");

            // إغلاق كل القوائم الأخرى
            $(".subcategory-list").not($list).slideUp();
            $(".arrow").not($arrow).removeClass("rotate");

            // فتح/إغلاق القائمة الحالية
            $list.slideToggle();
            $arrow.toggleClass("rotate");
        });
    });
</script>
