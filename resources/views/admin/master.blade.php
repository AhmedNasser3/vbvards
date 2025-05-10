<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />

	<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/css/Admincustom.css') }}">

<!-- DataTable -->
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- DataTable-->
	 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <title>فيبي كارد - ادمن</title>
</head>
<body>

        @include('admin.includes.sidebar')
        @include('admin.includes.header')
        <div class="admin_main" id="mainContent" dir="rtl">
            @yield('AdminContent')
        </div>
        @include('admin.includes.footer')



	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script src="{{ asset('assets/js/code.js') }}"></script>

 <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>

 	<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
	</script>

	<script>
		tinymce.init({
		  selector: '#mytextarea'
		});
	</script>

<script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const main = document.getElementById('mainContent');
      sidebar.classList.toggle('collapsed');
      main.classList.toggle('expanded');
    }

    function toggleSubmenu(element) {
      const submenu = element.nextElementSibling;
      submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }

    function toggleDropdown() {
      const menu = document.getElementById('userDropdown');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    // إغلاق القائمة عند النقر خارجها
    window.addEventListener('click', function (e) {
      const dropdown = document.getElementById('userDropdown');
      const userArea = document.querySelector('.header_admin_user');
      if (!userArea.contains(e.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>
  <script>
    function toggleSubmenu(element) {
      const submenu = element.nextElementSibling;
      submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    }

    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const main = document.querySelector(".admin_main");
      sidebar.classList.toggle("collapsed");
      main.classList.toggle("expanded");
    }
  </script>
  <!-- Toastr -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- AOS for motion on scroll -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

  <!-- Animate.css for field animations -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
<script>
    AOS.init();
</script>


</body>
</html>
