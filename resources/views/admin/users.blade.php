  @extends('layouts.admin')
  @section('title','صراحة - إدارة المستخدمين')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/index.css')}}"/>
  <link rel="stylesheet" href="{{url('css/pages/admin/users.css')}}"/>
  @endsection
       
@section('main')
<!-- Main Content -->
<div class="main-content">
@php($users=\App\Models\User::all())

  <!-- Page Header -->
  <div class="page-header"><h2 class="page-title">إدارة المستخدمين</h2></div>

  <!-- Search -->
  <div class="search-section">
    <div class="search-container">
      <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
      </svg>
      <input id="searchInput" type="text" class="search-input" placeholder="ابحث عن المستخدمين">
    </div>
  </div>

  <!-- Filter -->
  <div class="filter-header"><h3 class="filter-title">تصفية المستخدمين</h3></div>
  <div class="filter-section">
    <div class="filter-dropdown" id="statusFilter">
      <div class="dropdown-container">
        <span class="dropdown-text">كل الحالات</span>
        <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="6,9 12,15 18,9"/>
        </svg>
      </div>
      <div class="filter-options" style="display:none">
        <button data-status="">كل الحالات</button>
        <button data-status="نشط">نشط</button>
        <button data-status="معطل">معطل</button>
      </div>
    </div>
  </div>

  <!-- Users Table -->
  <div class="table-section">
    <div class="table-container">
      <table class="table">
        <thead class="table-header">
          <tr><th>اسم المستخدم</th><th>البريد الإلكتروني</th><th>تاريخ التسجيل</th><th>الحالة</th><th>الإجراءات</th></tr>
        </thead>
        <tbody id="userTableBody">
          @foreach($users as $user)
          <tr class="table-row">
            <td>{{ $user->username }}</td>
            <td class="email">{{ $user->email }}</td>
            <td>{{ $user->created_at->format('Y‑m‑d') }}</td>
            <td>
              <span class="status-badge" data-status="{{ $user->is_active ? 'active' : 'inactive' }}">
                {{ $user->is_active ? 'نشط' : 'معطل' }}
              </span>
            </td>
            <td>
              <button class="btn-action toggle-status" data-id="{{ $user->id }}" data-active="{{ $user->is_active }}">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="{{ $user->is_active ? 'M18 6L6 18M6 6l12 12' : 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' }}"/>
                </svg>
              </button>
              <button class="btn-action delete-user" data-id="{{ $user->id }}">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                </svg>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal-overlay" id="confirmationModal" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">تأكيد العملية</h5>
          <button type="button" class="close-btn" id="modalCloseBtn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <div class="modal-body">
          <p id="modalMessage">هل أنت متأكد من أنك تريد تنفيذ هذا الإجراء؟</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-cancel" id="cancelAction">إلغاء</button>
          <button type="button" class="btn btn-confirm" id="confirmAction">تأكيد</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Error Message Container -->
  <div id="errorMessage" style="display: none;"></div>

  <!-- Pagination -->
  <div class="pagination-section">
    <button class="pagination-button active">1</button>
  </div>
</div>

<!-- ========== JavaScript ========== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  /* ==== Helper Functions ==== */
  const $ = s => document.querySelector(s);
  const $$ = s => [...document.querySelectorAll(s)];
  
  // Get CSRF Token from meta tag or form input
  const getCsrfToken = () => {
    return document.querySelector('meta[name="csrf-token"]')?.content || 
           document.querySelector('input[name="_token"]')?.value;
  };

  /* ==== Search and Filter Functionality ==== */
  const search = $('#searchInput');
  const dd = $('#statusFilter');
  const ddBox = dd?.querySelector('.dropdown-container');
  const ddList = dd?.querySelector('.filter-options');
  const ddText = dd?.querySelector('.dropdown-text');
  const rows = () => $$('#userTableBody tr');

  // Open/Close Dropdown
  if (ddBox && ddList) {
    ddBox.addEventListener('click', e => {
      e.stopPropagation();
      ddList.style.display = ddList.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', () => ddList.style.display = 'none');
  }

  // Filter by Status
  if (ddList) {
    ddList.querySelectorAll('button').forEach(btn => {
      btn.addEventListener('click', () => {
        const chosen = btn.dataset.status;
        if (ddText) ddText.textContent = btn.textContent;
        if (ddList) ddList.style.display = 'none';

        rows().forEach(r => {
          const statusBadge = r.querySelector('.status-badge');
          if (statusBadge) {
            const flag = statusBadge.dataset.status;
            const show =
              !chosen ||
              (chosen === 'نشط' && flag === 'active') ||
              (chosen === 'معطل' && flag === 'inactive');
            r.style.display = show ? '' : 'none';
          }
        });
        runSearch();
      });
    });
  }

  // Search Function
  const runSearch = () => {
    if (!search) return;
    
    const term = search.value.trim().toLowerCase();
    rows().forEach(r => {
      const user = r.children[0]?.textContent.toLowerCase() || '';
      const email = r.children[1]?.textContent.toLowerCase() || '';
      const matches = !term || user.includes(term) || email.includes(term);
      if (r.style.display !== 'none') r.style.display = matches ? '' : 'none';
    });
  };

  let searchTimer;
  if (search) {
    search.addEventListener('input', () => {
      clearTimeout(searchTimer);
      searchTimer = setTimeout(runSearch, 200);
    });
  }

  /* ==== Modal Functionality ==== */
  let currentAction = null;
  let currentUserId = null;
  const modal = $('#confirmationModal');
  const modalTitle = $('#modalTitle');
  const modalMessage = $('#modalMessage');
  const confirmBtn = $('#confirmAction');
  const cancelBtn = $('#cancelAction');
  const closeBtn = $('#modalCloseBtn');
  const errorMessage = $('#errorMessage');

  // Show modal with custom title and message
  function showModal(title, message, action, userId) {
    if (!modal || !modalTitle || !modalMessage) return;
    
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    currentAction = action;
    currentUserId = userId;
    modal.style.display = 'flex';
  }

  // Close modal
  function closeModal() {
    if (modal) modal.style.display = 'none';
    currentAction = null;
    currentUserId = null;
  }

  // Show error message
  function showError(message) {
    if (!errorMessage) {
      // Create error message element if it doesn't exist
      const errorDiv = document.createElement('div');
      errorDiv.id = 'errorMessage';
      errorDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        z-index: 9999;
        max-width: 300px;
        display: block;
        animation: fadeIn 0.3s;
      `;
      document.body.appendChild(errorDiv);
      errorDiv.textContent = message;
      
      setTimeout(() => {
        errorDiv.remove();
      }, 5000);
    } else {
      errorMessage.textContent = message;
      errorMessage.style.display = 'block';
      
      setTimeout(() => {
        errorMessage.style.display = 'none';
      }, 5000);
    }
  }

  // Execute the action (delete or toggle status)
  async function executeAction() {
    if (!currentAction || !currentUserId) return;

    const csrfToken = getCsrfToken();
    if (!csrfToken) {
      showError('تعذر الحصول على رمز الحماية. يرجى التأكد من تحميل الصفحة بشكل صحيح.');
      return;
    }

    const endpoint = currentAction === 'delete' ? 
      `/admin/users/${currentUserId}` : 
      `/admin/users/${currentUserId}/toggle`;

    try {
      const response = await fetch(endpoint, {
        method: currentAction === 'delete' ? 'DELETE' : 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ 
          _token: csrfToken,
          ...(currentAction === 'toggle' && { 
            is_active: !($(`.toggle-status[data-id="${currentUserId}"]`)?.dataset.active === '1')
          })
        })
      });

      // Check if response is JSON
      const contentType = response.headers.get('content-type');
      if (!contentType || !contentType.includes('application/json')) {
        const errorText = await response.text();
        throw new Error(errorText || 'الخادم لم يعد استجابة JSON صالحة');
      }

      const data = await response.json();
      
      if (!response.ok) {
        throw new Error(data.message || 'حدث خطأ في الخادم');
      }

      if (data.success) {
        location.reload();
      } else {
        showError(data.message || 'حدث خطأ أثناء تنفيذ العملية');
      }
    } catch (error) {
      console.error('Error:', error);
      
      // Handle 404 error specifically
      if (error.message.includes('404')) {
        showError('الصفحة المطلوبة غير موجودة. يرجى التحقق من الرابط.');
      } 
      // Handle JSON parse error
      else if (error.message.includes('JSON')) {
        showError('استجابة غير صالحة من الخادم');
      } 
      else {
        showError(error.message || 'حدث خطأ أثناء تنفيذ العملية');
      }
    } finally {
      closeModal();
    }
  }

  /* ==== Event Listeners ==== */
  // Modal buttons
  if (confirmBtn) confirmBtn.addEventListener('click', executeAction);
  if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
  if (closeBtn) closeBtn.addEventListener('click', closeModal);

  // Close modal when clicking outside
  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      closeModal();
    }
  });

  // Toggle User Status
  $$('.toggle-status').forEach(button => {
    button.addEventListener('click', function() {
      const userId = this.dataset.id;
      const isActive = this.dataset.active === '1';
      
      showModal(
        'تغيير حالة المستخدم',
        `هل أنت متأكد من أنك تريد ${isActive ? 'تعطيل' : 'تفعيل'} هذا المستخدم؟`,
        'toggle',
        userId
      );
    });
  });

  // Delete User
  $$('.delete-user').forEach(button => {
    button.addEventListener('click', function() {
      const userId = this.dataset.id;
      
      showModal(
        'حذف المستخدم',
        'هل أنت متأكد من أنك تريد حذف هذا المستخدم؟ لا يمكن التراجع عن هذا الإجراء.',
        'delete',
        userId
      );
    });
  });

  // Edit User
  $$('.edit-user').forEach(button => {
    button.addEventListener('click', function() {
      const userId = this.dataset.id;
      window.location.href = `/admin/users/${userId}/edit`;
    });
  });
});
</script>

<style>
/* Modal Styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-dialog {
  width: 100%;
  max-width: 400px;
  animation: modalFadeIn 0.3s ease-out;
}

.modal-content {
  background-color: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.modal-header {
  padding: 15px 20px;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-title {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  color: #333;
}

.close-btn {
  background: none;
  border: none;
  cursor: pointer;
  padding: 5px;
}

.close-btn svg {
  width: 20px;
  height: 20px;
  color: #777;
}

.modal-body {
  padding: 20px;
}

.modal-message {
  margin: 0;
  color: #555;
  line-height: 1.5;
}

.modal-footer {
  padding: 15px 20px;
  border-top: 1px solid #eee;
  display: flex;
  justify-content: flex-end;
}

.btn {
  padding: 8px 16px;
  border-radius: 4px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  margin-right: 10px;
}

.btn-cancel {
  background-color: #f8f9fa;
  border: 1px solid #ddd;
  color: #333;
}

.btn-cancel:hover {
  background-color: #e9ecef;
}

.btn-confirm {
  background-color: #dc3545;
  border: 1px solid #dc3545;
  color: #fff;
}

.btn-confirm:hover {
  background-color: #c82333;
  border-color: #bd2130;
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
@endsection