@php
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
// الحصول على أكثر 4 منتجات مبيعًا
// الحصول على أكثر 4 منتجات مبيعًا بناءً على عدد مرات الظهور في جدول orders

$topProducts = DB::table('order_items')
    ->select('product_id', DB::raw('COUNT(*) as total_sales'))
    ->groupBy('product_id')
    ->orderByDesc('total_sales')
    ->take(5)
    ->get();


// تحميل المنتجات باستخدام العلاقة
$products = Product::whereIn('id', $topProducts->pluck('product_id'))->get();
$categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp

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
                <!-- زر الإضافة للسلة -->
                <div class="add-to-cart">
                    @auth
                    <button onclick="addProductToCart({{ $product->id }})" class="add-to-cart-btn">
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const products = document.querySelectorAll('.product-item');

            // Create an IntersectionObserver to detect when elements are in the viewport
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Apply animation when the product comes into view
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                        entry.target.classList.add('animate__fadeIn'); // Add the fade-in animation class
                        observer.unobserve(entry.target); // Stop observing once the animation is applied
                    }
                });
            }, { threshold: 0.5 }); // Trigger when 50% of the element is visible

            // Observe each product item
            products.forEach(product => {
                observer.observe(product);
            });
        });
        </script>

        <style>
        /* Add the transition effect for sliding from bottom */
        .product-item {
            transition: transform 1s ease, opacity 1s ease;
        }
        </style>
