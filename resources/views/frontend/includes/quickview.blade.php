

<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
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
                                    <span class="current-price text-brand"> ر.س</span>
                                    <span class="current-price text-brand" id="pprice"> </span>
                                    <span class="old-price font-md ml-15"> ر.س </span>
                                    <span class="old-price font-md ml-15" id="oldprice">  </span>
                                </div>
                            </div>

                            <div class="detail-extralink mb-30">
                                <div class="border detail-qty radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <input type="hidden" id="product_id">
                                    <button type="submit" class="button button-add-to-cart" onclick="addToCart()">
                                        <i class="fi-rs-shopping-cart"></i>اضف  للسلة
                                    </button>
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
