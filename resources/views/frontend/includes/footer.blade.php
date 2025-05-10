<!-- روابط لأيقونات Font Awesome و Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600&display=swap" rel="stylesheet">

<footer style="background-color: #0d1624; color: #fff; padding: 60px 0; font-family: 'Cairo', sans-serif; font-weight: 300;">
  <div class="container">
    <div class="row">
      <!-- شعار ووصف -->
      <div class="mb-4 col-md-4 animate__animated animate__fadeInUp">
        <img src="{{ asset('assets/imgs/شعار_2.png') }}" alt="VB CARD Logo" style="width: 120px;">
        <p style="margin-top: 15px; font-size: 15px; max-width: 200px;" >
          متجر "في بي كارد" لبيع البطاقات الرقمية بجميع أنواعها بأسهل الطرق الممكنة وأكثرها أمانًا وبأسعار منافسة.
        </p>
      </div>
      <!-- روابط تهمك -->
      <div class="mb-4 col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
        <h5 style="margin-bottom: 15px;">روابط تهمك</h5>
        <ul style="list-style: none; padding: 0; font-size: 15px;">
          <li><a href="{{ route('condition') }}" style="color: #fff; text-decoration: none;">اتفاقية المستخدم</a></li>
          <li><a href="{{ route('rules') }}" style="color: #fff; text-decoration: none;">سياسة الاستبدال والإرجاع</a></li>
        </ul>
      </div>
      <!-- تواصل معنا -->
      <div class="mb-4 col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
        <h5 style="margin-bottom: 15px;">تواصل معنا</h5>
        <ul style="list-style: none; padding: 0; font-size: 15px;display:flex">
          <li style="margin-bottom: 10px;">
            <a href="https://wa.me/966508209029" style="color: #fff; text-decoration: none;">
              <span style="display: inline-block; width: 36px; height: 36px; background: #fff; color: #25BA84; text-align: center; border-radius: 8px; margin-left: 10px;">
                <i class="fab fa-whatsapp" style="line-height: 36px; font-size: 18px;"></i>
              </span>
            </a>
          </li>
          <li style="margin-bottom: 10px;">
            <a href="tel:+966555987904" style="color: #fff; text-decoration: none;">
              <span style="display: inline-block; width: 36px; height: 36px; background: #fff; color: #25BA84; text-align: center; border-radius: 8px; margin-left: 10px;">
                <i class="fas fa-phone" style="line-height: 36px; font-size: 18px;"></i>
              </span>
            </a>
          </li>
          <li>
            <a href="mailto:info@stream-mix.net" style="color: #fff; text-decoration: none;">
              <span style="display: inline-block; width: 36px; height: 36px; background: #fff; color: #25BA84; text-align: center; border-radius: 8px; margin-left: 10px;">
                <i class="fas fa-envelope" style="line-height: 36px; font-size: 18px;"></i>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- حقوق النشر -->
    <div class="row">
      <div class="mt-4 text-center col-12">
        <p style="font-size: 14px;">© <span id="currentYear"></span>في بي كارد- جميع الحقوق محفوظة</p>
      </div>
    </div>
  </div>
</footer>

<!-- سكريبت لتحديث السنة تلقائيًا -->
<script>
  document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>
