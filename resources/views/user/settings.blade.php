@extends('layouts.user')
@section('title','الإعدادات')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/settings.css') }}">
@endsection

@section('main')

<div class="main-content">
  <div class="content-wrapper">

    <!-- Right Section - Password Change Form -->
    <div class="form-section">
      <div class="form-container">

        <!-- ✅ رسالة النجاح -->
        @if (session('success'))
          <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
        @endif

        <!-- ✅ رسالة الخطأ العامة -->
        @if (session('error'))
          <div style="color: red; font-weight: bold;">{{ session('error') }}</div>
        @endif

        <!-- ✅ النموذج -->
        <form method="POST" action="{{ route('user.update.password') }}">
          @csrf

          <!-- كلمة المرور الحالية -->
          <div class="form-field">
            <div class="field-container">
              <label for="current_password" class="field-label">كلمة المرور الحالية</label>
              <div class="field-input-group">
                <input type="password" id="current_password" name="current_password" class="field-input-flex" required>
              </div>
              @error('current_password')
                <div style="color:red;">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- كلمة المرور الجديدة -->
          <div class="form-field">
            <div class="field-container">
              <label for="new_password" class="field-label">كلمة المرور الجديدة</label>
              <div class="field-input-group">
                <input type="password" id="new_password" name="new_password" class="field-input-flex" required>
              </div>
              @error('new_password')
                <div style="color:red;">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- تأكيد كلمة المرور -->
          <div class="form-field">
            <div class="field-container">
              <label for="new_password_confirmation" class="field-label">تأكيد كلمة المرور الجديدة</label>
              <div class="field-input-group">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="field-input-flex" required>
              </div>
              @error('new_password_confirmation')
                <div style="color:red;">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- زر حفظ -->
          <div class="save-button-section">
            <button type="submit" class="pw-btn">💾 حفظ التغييرات</button>
          </div>
        </form>

      </div>
    </div>

<!-- Left Section - Account Actions -->
<div class="profile-section">
  <div class="action-buttons">

    <!-- زر تعطيل أو إعادة تنشيط الحساب -->
    <form method="POST" action="{{ route('user.toggle_active') }}">
      @csrf
      @if(auth()->user()->is_active)
        <button type="submit" class="action-button secondary">🚫 تعطيل الحساب</button>
      @else
        <button type="submit" class="action-button success">✅ إعادة تنشيط الحساب</button>
      @endif
    </form>

    <!-- زر حذف الحساب يفتح النافذة المنبثقة -->
    <button type="button" class="action-button danger" onclick="openDeleteModal()">🗑️ حذف الحساب</button>

  </div>
</div>

<!-- ✅ النافذة المنبثقة لتأكيد الحذف -->
<div id="deleteModal" class="modal-overlay">
  <div class="modal-box">
    <h3>⚠️ تأكيد حذف الحساب</h3>
    <p>هل أنت متأكد أنك تريد حذف حسابك؟ لا يمكن التراجع عن هذا الإجراء.</p>
    <form method="POST" action="{{ route('user.delete') }}">
      @csrf
      <div class="modal-buttons">
        <button type="submit" class="modal-confirm">نعم، احذف</button>
        <button type="button" class="modal-cancel" onclick="closeDeleteModal()">إلغاء</button>
      </div>
    </form>
  </div>
</div>

<script src="{{url('js/user/settings.js')}}">
    </script>

  </div>
</div>

@endsection