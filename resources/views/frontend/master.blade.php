<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>VB CARD</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.svg') }}" />
    <link href="https://fonts.cdnfonts.com/css/somar-sans" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

  <script src="https://js.stripe.com/v3/"></script>
    <title>Document</title>
</head>

<body>
    {{--  <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');
        *{
            font-family: "Tajawal", sans-serif !important;
            font-style: normal;
        }
    </style>  --}}

    @include('frontend.includes.quickview')
    @include('frontend.includes.header')
    <div class="mainer" >
        @yield('content')

        <div style="background:#0d1624">
            <div >
                @include('frontend.includes.footer')
            </div>
        </div>
    </div>
    <!-- مكتبات الجافا سكريبت -->
    <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/shop.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- إشعارات Laravel -->
    <script>
      @if(Session::has('message'))
        toastr["{{ Session::get('alert-type', 'info') }}"]("{{ Session::get('message') }}");
      @endif
    </script>

    <!-- كود الجافاسكريبت المختصر -->
    <script>
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        function updateOptions(type, items, area) {
          const select = $(`select[name="${type}"]`).empty();
          items.length
            ? (items.forEach(v => select.append(`<option value="${v}">${v}</option>`)), $(area).show())
            : $(area).hide();
        }

        function productView(id) {
          $.getJSON('/product/view/modal/' + id, data => {
            const p = data.product;
            $('#pname').text(p.product_name);
            $('#pprice').text(p.discount_price ?? p.selling_price);
            $('#oldprice').text(p.discount_price ? p.selling_price : '');
            $('#pcode').text(p.product_code);
            $('#pcategory').text(p.category.category_name);
            $('#pbrand').text(p.brand.brand_name);
            $('#pimage').attr('src','/' + p.product_thambnail);
            $('#pvendor_id').text(p.vendor_id);
            $('#product_id').val(id);
            $('#qty').val(1);
            $('#aviable').text(p.product_qty > 0 ? 'متوفر' : '');
            $('#stockout').text(p.product_qty > 0 ? '' : 'غير متوفر');
            updateOptions('size', data.size, '#sizeArea');
            updateOptions('color', data.color, '#colorArea');
          });
        }

        function wishlist() {
          $.getJSON('/get-wishlist-product/', res => {
            $('#wishQty').text(res.wishQty);
            let rows = '';
            res.wishlist.forEach(v => {
              const p = v.product;
              rows += `
              <tr class="pt-30">
                <td class="custome-checkbox pl-30"></td>
                <td class="pt-40 image product-thumbnail"><img src="/${p.product_thambnail}" alt="#" /></td>
                <td class="product-des product-name">
                  <h6><a class="mb-10 product-name" href="shop-product-right.html">${p.product_name}</a></h6>
                  <div class="product-rate-cover"><div class="product-rate d-inline-block"><div class="product-rating" style="width:90%"></div></div><span class="ml-5 text-white font-small">(4.0)</span></div>
                </td>
                <td class="price"><h3 class="text-brand">$${p.discount_price ?? p.selling_price}</h3></td>
                <td class="text-center detail-info"><span class="mb-0 stock-status ${p.product_qty > 0 ? 'in-stock' : 'out-stock'}">${p.product_qty > 0 ? 'متوفر في المخزون' : 'غير متوفر'}</span></td>
                <td class="text-center action"><a class="text-body" id="${v.id}" onclick="wishlistRemove(this.id)"><i class="fi-rs-trash"></i></a></td>
              </tr>`;
            });
            $('#wishlist').html(rows);
          });
        }

        function wishlistRemove(id) {
          $.getJSON('/wishlist-remove/' + id, data => {
            wishlist();
            Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 })
              .fire({ icon: $.isEmptyObject(data.error) ? 'success' : 'error', title: data.success || data.error });
          });
        }

        function cart() {
          $.getJSON('/get-cart-product', res => {
            let rows = res.carts.map(v => `
              <tr class="pt-30">
                <td class="custome-checkbox pl-30"></td>
                <td class="pt-40 image product-thumbnail"><img src="/${v.options.image}" alt="#"></td>
                <td class="product-des product-name"><h6 class="mb-5"><a class="mb-10 product-name text-heading" href="shop-product-right.html">${v.name}</a></h6></td>
                <td class="price"><h4 class="text-body">$${v.price}</h4></td>
                <td class="price">${v.options.color ? `<h6 class="text-body">${v.options.color}</h6>` : '<span>....</span>'}</td>
                <td class="price">${v.options.size ? `<h6 class="text-body">${v.options.size}</h6>` : '<span>....</span>'}</td>
                <td class="text-center detail-info"><div class="detail-extralink mr-15"><div class="border detail-qty radius"><a class="qty-down" id="${v.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a><input type="text" class="qty-val" value="${v.qty}" min="1"><a class="qty-up" id="${v.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a></div></div></td>
                <td class="price"><h4 class="text-brand">$${v.subtotal}</h4></td>
                <td class="text-center action"><a class="text-body" id="${v.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a></td>
              </tr>`).join('');
            $('#cartPage').html(rows);
            couponCalculation(); // إعادة حساب الكوبون عند تحديث السلة
          });
        }

        function cartRemove(id) {
          $.getJSON('/cart-remove/' + id, data => {
            cart();
            miniCart(); // إن وجد
            Swal.fire({ icon: 'success', title: data.success, toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
          });
        }

        function cartIncrement(rowId) {
          $.getJSON('/cart-increment/' + rowId, data => {
            cart();
          });
        }

        function cartDecrement(rowId) {
          $.getJSON('/cart-decrement/' + rowId, data => {
            cart();
          });
        }

        function addToCart() {
          const data = {
            product_name: $('#pname').text(),
            quantity: $('#qty').val(),
            color: $('#color').val(),
            size: $('#size').val()
          };

          $.post('/cart/data/store/' + $('#product_id').val(), data, res => {
            if (res.success) {
              cart();
              toastr.success(res.success);
              $('#closeModal').click(); // إغلاق المودال إن وجد
            } else {
              toastr.error(res.error);
            }
          }).fail(xhr => toastr.error('حدث خطأ أثناء الإضافة للسلة.'));
        }

        function addToWishList(id) {
          $.post('/add-to-wishlist/' + id, {}, res => {
            res.success ? (wishlist(), toastr.success(res.success)) : toastr.error(res.error);
          }).fail(xhr => {
            console.error(xhr.responseText);
            toastr.error('حدث خطأ أثناء الإضافة للمفضلة.');
          });
        }
        function applyCoupon() {
            const name = $('#coupon_name').val();
            $.post('/coupon-apply', { coupon_name: name }, data => {
              Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 })
                .fire({ icon: $.isEmptyObject(data.error) ? 'success' : 'error', title: data.success || data.error });
            }, 'json');
          }
        function couponCalculation() {
          $.getJSON('/coupon-calculation', res => {
            let html = '';
            if (res.total) {
              html = `
                <tr><td><h6 class="text-muted">المجموع:</h6></td><td class="text-end"><h6 class="text-muted">$${res.total}</h6></td></tr>
                <tr><td><h4>الإجمالي:</h4></td><td class="text-end"><h4 class="text-brand">$${res.total}</h4></td></tr>`;
            } else {
              html = `
                <tr><td><h6 class="text-muted">الإجمالي قبل الخصم:</h6></td><td class="text-end"><h6 class="text-muted">$${res.subtotal}</h6></td></tr>
                <tr><td><h6 class="text-muted">الخصم (${res.coupon_name}):</h6></td><td class="text-end"><h6 class="text-muted">- $${res.discount_amount}</h6></td></tr>
                <tr><td><h4>الإجمالي بعد الخصم:</h4></td><td class="text-end"><h4 class="text-brand">$${res.total_amount}</h4></td></tr>`;
            }
            $('#couponCalField').html(html);
          });
        }

        function couponRemove() {
          $.getJSON('/coupon-remove', data => {
            couponCalculation();
            $('#coupon_name').val('');
            Swal.fire({ icon: 'success', title: data.success, toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
          });
        }

        $(document).ready(() => {
          wishlist();
          cart();
          couponCalculation();
        });
      </script>
      <script>
        function addProductToCart(productId) {
            // تحقق إذا كان العنصر موجوداً في الصفحة
            const productNameElement = document.querySelector(`#product-name-${productId}`);

            // إذا لم يتم العثور على العنصر، أرسل رسالة في الكونسول
            if (!productNameElement) {
                console.error(`العنصر الذي يحمل ID "product-name-${productId}" غير موجود!`);
                return; // إذا لم يتم العثور على العنصر، توقف عن تنفيذ الدالة
            }

            // قم بالحصول على البيانات التي ستحتاجها لإرسالها إلى الخادم
            const product_name = productNameElement.textContent;
            const quantity = 1; // يمكنك تعديلها بناءً على مدخلات المستخدم
            const color = 'default'; // يمكنك تعديلها بناءً على المدخلات
            const size = 'default'; // يمكنك تعديلها بناءً على المدخلات
            const vendor = 'default'; // يمكنك تعديلها بناءً على المدخلات

            // إرسال البيانات إلى الخادم باستخدام fetch أو axios
            fetch(`/cart/product/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // تضمين رمز CSRF لحماية الطلب
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
                    alert('تم إضافة المنتج إلى السلة');
                } else {
                    alert('حدث خطأ يرجى المحاولة لاحقًا');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ يرجى المحاولة لاحقًا');
            });
        }

    </script>
