<div class="header_admin" dir="rtl">
    <div class="header_admin_container">
      <div class="toggle_sidebar_btn" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
      </div>

      <div class="header_admin_content">
          <div class="header_admin_user" onclick="toggleDropdown()">
            <span>أحمد ناصر</span>
            <i class="fa fa-chevron-down"></i>

            <div class="dropdown_menu" id="userDropdown">
              <a href="#">حسابي</a>
              <a href="#">الإعدادات</a>
              <a href="#">تسجيل خروج</a>
            </div>
          </div>
        <div class="header_admin_profile_photo">
            <img src="{{ auth()->check() && auth()->user()->profile_photo_path ? asset(auth()->user()->profile_photo_path) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" alt="User Profile">
        </div>

      </div>
    </div>
  </div>
