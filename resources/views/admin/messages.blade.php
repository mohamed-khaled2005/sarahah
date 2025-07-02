  @extends('layouts.admin')
  @section('title','صراحة - إدارة الرسائل')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/messages.css')}}"/>
  @endsection

@section('main')
<div class="main-content">

  <!-- ===== Search ===== -->
  <div class="search-section">
    <div class="search-container">
      <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8" /><path d="M21 21l-4.35-4.35" />
      </svg>
      <input id="searchInput" type="text" class="search-input" placeholder="ابحث عن رسائل">
    </div>
  </div>

  <!-- ===== Messages Table ===== -->
  <div class="table-section">
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>المحتوى</th><th>المرسل</th><th>تاريخ الإرسال</th><th>ID المستخدم</th><th>الإجراء</th>
          </tr>
        </thead>
        <tbody id="msgBody">
          @foreach($messages as $msg)
          <tr data-id="{{ $msg->id }}">
            <td>{{ $msg->content }}</td>
            <td>مجهول</td>
            <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
            <td>{{ $msg->user_id }}</td>
            <td>
              <button class="btn-delete" data-id="{{ $msg->id }}">حذف</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- ===== Confirm Popup ===== -->
  <div class="modal-overlay" id="confirmModal">
    <div class="modal-box">
      <h3>تأكيد الحذف</h3>
      <p>هل تريد حذف هذه الرسالة نهائيًا؟</p>
      <div class="modal-buttons">
        <button class="btn confirm" id="yesBtn">نعم</button>
        <button class="btn cancel"  id="noBtn">إلغاء</button>
      </div>
    </div>
  </div>


<!-- Pagination -->
<div class="pagination-container" id="pagination"></div>

</div>

{{-- ====================  CSS  ==================== --}}
<style>
/* أساسيات */
body{font-family:"Tajawal",sans-serif;margin:0;direction:rtl}

/* بحث */
.search-container{display:flex;align-items:center;gap:.5rem;background:#fff;border:1px solid #ddd;border-radius:8px;padding:.45rem .9rem;box-shadow:0 2px 4px rgba(0,0,0,.05)}
.search-input{border:0;outline:0;background:transparent;width:100%}
.search-icon{width:18px;height:18px;stroke:#6b7280}

/* جدول */
.table-container{overflow-x:auto;background:#fff;border-radius:12px;box-shadow:0 4px 10px rgba(0,0,0,.06)}
table.table{width:100%;border-collapse:collapse;min-width:720px}
thead tr{background:#f9fafb}
thead th{padding:.8rem 1rem;font-size:14px;font-weight:600;border-bottom:2px solid #e5e7eb;text-align:right}
tbody td{padding:.75rem 1rem;border-bottom:1px solid #f1f2f4;font-size:14px}
tbody tr:hover{background:#fdfdfd}

/* زر الحذف */
.btn-delete{background:#e11d48;color:#fff;border:none;border-radius:6px;padding:6px 14px;font-size:13px;cursor:pointer;transition:.25s}
.btn-delete:hover{background:#c4103b}

/* Popup */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);display:none;align-items:center;justify-content:center;z-index:1000}
.modal-overlay.show{display:flex}
.modal-box{background:#fff;padding:24px 30px;border-radius:10px;text-align:center;width:320px;box-shadow:0 8px 24px rgba(0,0,0,.2)}
.modal-buttons{display:flex;gap:15px;margin-top:18px}
.modal-buttons .btn{flex:1;padding:8px;border:none;border-radius:8px;font-weight:bold;cursor:pointer;color:#fff}
.modal-buttons .confirm{background:#22c55e}
.modal-buttons .cancel {background:#9e9e9e}
</style>

{{-- ====================  JavaScript  ==================== --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
  const $ = s => document.querySelector(s);
  const $$= s => [...document.querySelectorAll(s)];
  const modal = $('#confirmModal');
  const yes   = $('#yesBtn');
  const no    = $('#noBtn');
  const csrf  = document.querySelector('meta[name="csrf-token"]').content;
  let targetRow = null;

  /* ====== بحث لحظي ====== */
  $('#searchInput').addEventListener('input', e=>{
    const term = e.target.value.toLowerCase();
    $$('#msgBody tr').forEach(r=>{
      r.style.display = r.textContent.toLowerCase().includes(term) ? '' : 'none';
    });
  });

  /* ====== فتح المودال ====== */
  $$('.btn-delete').forEach(btn=>{
    btn.addEventListener('click',()=>{
      targetRow = btn.closest('tr');
      modal.classList.add('show');
    });
  });

  /* ====== إلغاء ====== */
  no.addEventListener('click',()=> modal.classList.remove('show'));
  modal.addEventListener('click',e=>{
    if(e.target===modal) modal.classList.remove('show');
  });

  /* ====== تأكيد الحذف ====== */
  yes.addEventListener('click',()=>{
    if(!targetRow) return;
    const id = targetRow.dataset.id;
    fetch(`/admin/messages/${id}`,{
      method:'POST',
      headers:{
        'X-CSRF-TOKEN':csrf,
        'X-HTTP-Method-Override':'DELETE'
      }
    })
    .then(r=>r.ok? r.json():Promise.reject())
    .then(()=> targetRow.remove())
    .finally(()=> modal.classList.remove('show'));
  });
});

/*---------------Pagination-----------------------*/

document.addEventListener('DOMContentLoaded', () => {
  const rowsPerPage = 8; // عدد الصفوف لكل صفحة
  const tableBody = document.querySelector('tbody'); // يتعامل مع أول tbody في الصفحة
  const allRows = [...tableBody.querySelectorAll('tr')];
  const pagination = document.getElementById('pagination');

  let currentPage = 1;
  const totalPages = Math.ceil(allRows.length / rowsPerPage);

  function showPage(page) {
    currentPage = page;
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    allRows.forEach((row, i) => {
      row.style.display = (i >= start && i < end) ? '' : 'none';
    });

    renderPagination();
  }

  function renderPagination() {
    pagination.innerHTML = '';
    for (let i = 1; i <= totalPages; i++) {
      const btn = document.createElement('button');
      btn.className = 'pagination-btn' + (i === currentPage ? ' active' : '');
      btn.textContent = i;
      btn.addEventListener('click', () => showPage(i));
      pagination.appendChild(btn);
    }
  }

  if (totalPages > 1) {
    showPage(1);
  }
});


</script>
@endsection
