@extends('admin.master')
@section('AdminContent')

<div dir="rtl" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
    <!-- زر الرجوع -->
    <button onclick="history.back()" class="back_button">رجوع للوراء</button>

    <!-- مسار الصفحة -->
    <div class="breadcrumb" style="font-size: 16px; color: #666;">
      كوبونات / الرئيسية
    </div>
  </div>

  <!-- نموذج الفورم -->
  <form class="fancyModernForm_ahmad2025" method="post" action="{{ route('store.coupon') }}">
    @csrf
    <div class="form_group">
        <label for="coupon_name">اسم الكوبون</label>
        <input type="text" id="coupon_name" name="coupon_name" placeholder="اكتب اسم الكوبون" required />
        <input type="text" id="status" name="status" value="1" hidden placeholder="اكتب اسم الكوبون" required />
    </div>

    <div class="form_group">
        <label for="coupon_discount">خصم الكوبون (%)</label>
        <input type="text" id="coupon_discount" name="coupon_discount" placeholder="اكتب نسبة الخصم" required />
    </div>

    <div class="form_group">
        <label for="coupon_validity">تاريخ صلاحية الكوبون</label>
        <input type="date" id="coupon_validity" name="coupon_validity" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required />
    </div>

    <div class="form_group">
        <button type="submit">إرسال البيانات</button>
    </div>
</form>
</div>





<!-- زر الرجوع -->
<!-- زر الرجوع ومسار الصفحة -->
{{--  <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
  <!-- زر الرجوع -->
  <button onclick="history.back()" class="back_button">رجوع للوراء</button>

  <!-- مسار الصفحة -->
  <div class="breadcrumb" style="font-size: 16px; color: #666;">
    كوبونات / الرئيسية
  </div>
</div>

<!-- نموذج الفورم -->
<form class="fancyModernForm_ahmad2025">
  <div class="form_group">
    <label for="name">الاسم الكامل</label>
    <input type="text" id="name" name="name" placeholder="اكتب اسمك الكامل" required />
  </div>

  <div class="form_group">
    <label for="type">النوع</label>
    <select id="type" name="type">
      <option value="student">طالب</option>
      <option value="teacher">معلم</option>
      <option value="admin">مسؤول</option>
    </select>
  </div>

  <div class="form_group">
    <label>الجنس</label>
    <div class="radio_group">
      <label class="modern_radio">
        <input type="radio" name="gender" value="male" checked />
        <span class="custom_radio"></span> ذكر
      </label>
      <label class="modern_radio">
        <input type="radio" name="gender" value="female" />
        <span class="custom_radio"></span> أنثى
      </label>
    </div>
  </div>

  <div class="form_group">
    <label>الاهتمامات</label>
    <div class="checkbox_group">
      <label><input type="checkbox" name="interests" value="design" /> التصميم</label>
      <label><input type="checkbox" name="interests" value="coding" /> البرمجة</label>
      <label><input type="checkbox" name="interests" value="marketing" /> التسويق</label>
    </div>
  </div>

  <div class="form_group">
    <label for="phone">رقم الجوال</label>
    <input type="tel" id="phone" name="phone" placeholder="مثال: 0591234567" required />
  </div>

  <div class="form_group">
    <label for="photo">الصورة الشخصية</label>
    <div class="custom_file_input">
      <label for="photo">📁 اختر صورة</label>
      <input type="file" id="photo" name="photo" accept="image/*" />
    </div>
  </div>

  <div class="form_group">
    <button type="submit">إرسال البيانات</button>
  </div>
</form>  --}}

@endsection
