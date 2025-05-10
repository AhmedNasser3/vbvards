
<!-- admin sidebar -->
<div class="admin_sidebar" id="sidebar">
    <div class="admin_sidebar_container">
      <!-- لوحة التحكم -->
      <a href="/admin">
          <div class="admin_sidebar_item"><span style="color: white"><i class="fa-solid fa-house"></i> لوحة التحكم</span></div>
      </a>

      <!-- براندات -->
      <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
        <span><i class="fa-solid fa-box"></i> المنتجات</span>
        <i class="fa-solid fa-chevron-down"></i>
      </div>
      <div class="admin_sidebar_submenu">
      <!-- اقسام -->
      <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
        <span><i class="fa-solid fa-chart-line"></i> براندات</span>
        <i class="fa-solid fa-chevron-down"></i>
      </div>
      <div class="admin_sidebar_submenu">
        <a href="{{ route('all.brand') }}">جميع البراندات</a>
        <a href="{{ route('add.brand') }}">انشاء البراندات</a>

      </div>
      <!-- اقسام -->
      <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
        <span><i class="fa-solid fa-chart-line"></i> اقسام</span>
        <i class="fa-solid fa-chevron-down"></i>
      </div>
      <div class="admin_sidebar_submenu">
        <a href="{{ route('all.category') }}">جميع الأقسام</a>
        <a href="{{ route('all.subcategory') }}">جميع الأقسام الفرعية</a>
        <a href="{{ route('all.subsubcategory') }}">جميع الأقسام الفرعية المتقدمة</a>

      </div>
      <!-- تطبيقات -->
      <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
        <span><i class="fa-solid fa-grid-2"></i> ادارة مخزون</span>
        <i class="fa-solid fa-chevron-down"></i>
      </div>
      <div class="admin_sidebar_submenu">
        <a href="{{ route('all.product') }}">جميع المنتجات</a>
        <a href="{{ route('add.product') }}">انشاء منتج</a>
        <a href="{{ route('all.recharge') }}">جميع الكروت</a>
        <a href="{{ route('add.recharge') }}">انشاء كروت</a>
      </div>
      </div>

      <!-- إدارة المستخدمين -->
      <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
        <span><i class="fa-solid fa-users"></i> ادارة طلبات</span>
        <i class="fa-solid fa-chevron-down"></i>
      </div>
      <div class="admin_sidebar_submenu">
        <a href="{{ route('pending.order') }}">الطلبات المعلقة </a>
        <a href="{{ route('admin.confirmed.order') }}">الطلبات مأكده </a>
        <a href="{{ route('admin.processing.order') }}">الطلبات قيد التنفيذ </a>
        <a href="{{ route('admin.delivered.order') }}">الطلبات تمت </a>
      </div>

      <!-- إدارة المستخدمين -->
      <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
        <span><i class="fa-solid fa-users"></i>الادوات التسويقية</span>
        <i class="fa-solid fa-chevron-down"></i>
      </div>
      <div class="admin_sidebar_submenu">
        <!-- كوبونات -->
        <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
          <span><i class="fa-solid fa-tag"></i> كوبونات</span>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="admin_sidebar_submenu">
          <a href="{{ route('all.coupon') }}">جميع الكوبونات</a>
          <a href="{{ route('add.coupon') }}">انشاء كوبون</a>
        </div>
        <!-- إعدادات الموقع -->
        <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
          <span><i class="fa-solid fa-cogs"></i> إعدادات الموقع</span>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="admin_sidebar_submenu">
          <a href="#">إعدادات الموقع</a>
          <a href="#">إعدادات SEO</a>
        </div>
      </div>

      <!-- إدارة الأدوار والصلاحيات -->
      <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
        <span><i class="fa-solid fa-user-shield"></i>الاعدادات</span>
        <i class="fa-solid fa-chevron-down"></i>
      </div>
      <div class="admin_sidebar_submenu">
        <!-- إدارة الأدمن -->
        <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
          <span><i class="fa-solid fa-user-cog"></i>الصلاحيات</span>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="admin_sidebar_submenu">
          <a href="#">صلاحيات الادمن</a>
        </div>
        <!-- إدارة الأدمن -->
        <div class="admin_sidebar_item" onclick="toggleSubmenu(this)">
          <span><i class="fa-solid fa-user-cog"></i> إدارة الأدمن</span>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="admin_sidebar_submenu">
          <a href="#">جميع الأدمن</a>
          <a href="#">إضافة أدمن</a>
        </div>
      </div>


    </div>
  </div>
