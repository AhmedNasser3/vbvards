@extends('frontend.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #0d1624;
        color: #ffffff;
    }
    .dashboard-container {
        background: #0d1624;
        border: 1px solid #25BA84;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        padding: 30px;
        margin-bottom: 50px;
    }
    .dashboard-menu ul {
        background: #0d1624;
        border: 1px solid #25BA84;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        padding: 20px;
    }
    .dashboard-menu .nav-link {
        padding: 15px 20px;
        border-radius: 10px;
        transition: all 0.3s;
        margin-bottom: 10px;
        color: #ffffff;
        font-weight: 600;
        border: 1px solid transparent;
    }
    .dashboard-menu .nav-link.active, .dashboard-menu .nav-link:hover {
        background-color: #25BA84;
        color: #ffffff;
        border-color: #25BA84;
    }
    .card {
        background-color: #0d1624;
        border: 1px solid #25BA84;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    .card-header {
        background: linear-gradient(135deg, #25BA84, #1e8c66);
        color: #ffffff;
        padding: 20px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    #showImage {
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        transition: transform 0.3s;
    }
    #showImage:hover {
        transform: scale(1.05);
    }
    @media(max-width: 768px) {
        .dashboard-container, .dashboard-menu ul {
            padding: 15px;
        }
        .card-header h3 {
            font-size: 20px;
        }
    }
</style>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}" rel="nofollow" style="color:#25BA84;">
                <i class="mr-5 fi-rs-home"></i>الرئيسية
            </a>
            <span style="color:#fff;"> / </span> <span style="color:#fff;">حسابي</span>
        </div>
    </div>
</div>

<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="m-auto col-lg-12">
                <div class="row">
                    @php $route = Route::current()->getName(); @endphp
                    <div class="col-md-3">
                        <div class="dashboard-menu animate__animated animate__fadeInLeft">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'dashboard')? 'active':  '' }}" href="{{ route('dashboard') }}">
                                        <i class="mr-10 fi-rs-settings-sliders"></i>لوحة التحكم
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'user.order.page')? 'active':  '' }}" href="{{ route('user.order.page') }}">
                                        <i class="mr-10 fi-rs-shopping-bag"></i>طلباتي
                                    </a>
                                </li>
                                {{--  <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'return.order.page')? 'active':  '' }}" href="{{ route('return.order.page') }}">
                                        <i class="mr-10 fi-rs-shopping-bag"></i>الطلبات المرتجعة
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'user.track.order')? 'active':  '' }}" href="{{ route('user.track.order') }}">
                                        <i class="mr-10 fi-rs-shopping-cart-check"></i>تتبع الطلب
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#address">
                                        <i class="mr-10 fi-rs-marker"></i>عناويني
                                    </a>
                                </li>  --}}
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'profile.show')? 'active':  '' }}" href="{{ route('profile.show') }}">
                                        <i class="mr-10 fi-rs-user"></i>تفاصيل الحساب
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'wishlist')? 'active':  '' }}" href="{{ route('wishlist') }}">
                                        <i class="fa-solid fa-heart"></i> المفضلة
                                    </a>
                                </li>
                                {{--  <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'user.change.password')? 'active':  '' }}" href="{{ route('user.change.password') }}">
                                        <i class="mr-10 fi-rs-user"></i>تغيير كلمة المرور
                                    </a>
                                </li>  --}}
                                <li class="nav-item" style="background:#132030;">
                                    <a class="nav-link" href="{{ route('logout') }}">
                                        <i class="mr-10 fi-rs-sign-out"></i>تسجيل الخروج
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="dashboard-container animate__animated animate__fadeInUp">
                            <div class="tab-content account dashboard-content pl-30">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>مرحباً {{ Auth::user()->name }}</h3>
                                            <br>
                                            <img id="showImage" src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo):url('upload/no_image.jpg') }}" alt="المستخدم" class="p-1 bg-white rounded-circle" width="110">
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                مرحبًا بك في لوحة التحكم الخاصة بك. من هنا يمكنك عرض <a href="#" style="color:#25BA84;">الطلبات</a>، تحديث <a href="#" style="color:#25BA84;">العناوين</a>، تعديل <a href="#" style="color:#25BA84;">بيانات الحساب</a>، والمزيد.
                                            </p>
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
</div>


<script>
    $(document).ready(function() {
        $('#showImage').attr('title', 'اضغط لتغيير الصورة');

        $('.nav-link').hover(function() {
            gsap.to($(this), { duration: 0.3, x: 5 });
        }, function() {
            gsap.to($(this), { duration: 0.3, x: 0 });
        });

        $("a[href^='#']").on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 800);
        });

        gsap.from(".card-header h3", { duration: 1, y: -50, opacity: 0, ease: "bounce" });
        gsap.to("#showImage", { duration: 2, scale: 1.05, repeat: -1, yoyo: true });
    });
</script>
@endsection
