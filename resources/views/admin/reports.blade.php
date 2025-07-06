  @extends('layouts.admin')
  @section('title','التقارير')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/reports.css')}}"/>
  @endsection

@section('main')
<div class="main-content">

  <!-- ===== العنوان ===== -->
  <div class="page-header"><h2 class="page-title">الرسائل المبلَّغ عنها</h2></div>

  <!-- ===== شريط الأدوات ===== -->
  <div class="toolbar">
    <div class="toolbar-icons">
      <button id="selectAll" class="tbl-icon" title="تحديد الكل">
        <!-- قائمة -->
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 6h18M3 12h18M3 18h18"/>
        </svg>
      </button>

      <button id="invertSelect" class="tbl-icon" title="عكس التحديد">
        <!-- مربّع -->
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="4" y="4" width="16" height="16" rx="2" ry="2"/>
        </svg>
      </button>

      <button id="refreshBtn" class="tbl-icon" title="تحديث">
        <!-- سهم تدوير -->
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 4v6h6"/>
          <path d="M20 20v-6h-6"/>
          <path d="M9 20a9 9 0 0 1-5-16"/>
          <path d="M15 4a9 9 0 0 1 5 16"/>
        </svg>
      </button>
    </div>

    <button id="deleteBtn" class="delete-button" disabled>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="3 6 5 6 21 6"/>
        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
        <path d="M10 11v6M14 11v6"/>
        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
      </svg>
      <span>حذف المحدد</span>
    </button>
  </div>

  <!-- ===== جدول التقارير ===== -->
  <div class="table-section">
    <div class="table-container">
      <table class="table" id="reportsTable">
        <thead>
          <tr>
            <th></th>
            <th data-sort="text">المحتوى <span class="sort-icon">↕</span></th>
            <th data-sort="date">التاريخ <span class="sort-icon">↕</span></th>
            <th data-sort="text">السبب <span class="sort-icon">↕</span></th>
            <th data-sort="num">ID المستخدم <span class="sort-icon">↕</span></th>
            <th>إجراء</th>
          </tr>
        </thead>
        <tbody id="reportsBody">
          @foreach($reports as $rep)
            @php $msg = \App\Models\Message::find($rep->message_id); @endphp
            <tr data-id="{{ $rep->id }}">
              <td><input type="checkbox" class="row-check"></td>
              <td>{{ $msg?->content ?? 'غير موجود' }}</td>
              <td data-date="{{ $msg?->created_at }}">
                {{ $msg?->created_at?->format('Y-m-d H:i') ?? '—' }}
              </td>
              <td>{{ $rep->reason }}</td>
              <td>{{ $rep->user_id }}</td>
              <td><button class="row-delete">حذف</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
<div class="pagination-container" id="pagination"></div>

  <!-- ===== Popup ===== -->
  <div class="modal-overlay" id="modal">
    <div class="modal-box">
      <h3>تأكيد الحذف</h3>
      <p>هل تريد حذف العناصر المحددة؟</p>
      <div class="modal-buttons">
        <button class="btn confirm" id="yesBtn">نعم</button>
        <button class="btn cancel"  id="noBtn">إلغاء</button>
      </div>
    </div>
  </div>
</div>

{{-- ===============  JavaScript  =============== --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
  const $$ = s => [...document.querySelectorAll(s)];
  const modal   = document.getElementById('modal');
  const yesBtn  = document.getElementById('yesBtn');
  const noBtn   = document.getElementById('noBtn');
  const delBtn  = document.getElementById('deleteBtn');
  const csrf    = document.querySelector('meta[name="csrf-token"]').content || '';
  let pendingIds = [];

  /* ---- اختيار الصفوف ---- */
  function refreshMainDelete(){ delBtn.disabled = $$('.row-check:checked').length===0; }
  document.addEventListener('change',e=>{ if(e.target.classList.contains('row-check')) refreshMainDelete(); });

  document.getElementById('selectAll').onclick   = ()=>{$$('.row-check').forEach(c=>c.checked=true);refreshMainDelete();};
  document.getElementById('invertSelect').onclick= ()=>{$$('.row-check').forEach(c=>c.checked=!c.checked);refreshMainDelete();};
  document.getElementById('refreshBtn').onclick  = ()=>location.reload();

  /* ---- حذف ---- */
  const openModal = ids=>{pendingIds=ids;modal.classList.add('show');};
  delBtn.onclick = ()=>{const ids=$$('.row-check:checked').map(c=>c.closest('tr').dataset.id);if(ids.length)openModal(ids);};
  document.getElementById('reportsBody').addEventListener('click',e=>{
    if(e.target.classList.contains('row-delete')){
      openModal([e.target.closest('tr').dataset.id]);
    }
  });
  noBtn.onclick = ()=>modal.classList.remove('show');
  modal.onclick = e=>{if(e.target===modal) modal.classList.remove('show');};

  yesBtn.onclick = ()=>{
    fetch('/admin/reports/delete-bulk',{
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
      body:JSON.stringify({ids:pendingIds})
    })
    .then(r=>r.ok?r.json():Promise.reject())
    .then(()=>pendingIds.forEach(id=>document.querySelector(`tr[data-id="${id}"]`)?.remove()))
    .finally(()=>{modal.classList.remove('show');refreshMainDelete();});
  };

  /* ---- فرز الأعمدة ---- */
  let direction = {};
  document.querySelectorAll('thead th[data-sort]').forEach(th=>{
    th.addEventListener('click',()=>{
      const type = th.dataset.sort;
      const idx  = [...th.parentNode.children].indexOf(th);
      direction[idx] = !direction[idx];
      const rows = $$('#reportsBody tr');

      rows.sort((a,b)=>{
        let A = a.children[idx].innerText.trim();
        let B = b.children[idx].innerText.trim();
        if(type==='num'){A=+A;B=+B;}
        if(type==='date'){A=new Date(a.children[idx].dataset.date);B=new Date(b.children[idx].dataset.date);}
        return direction[idx] ? (A>B?1:-1) : (A>B?-1:1);
      });

      const tbody=document.getElementById('reportsBody');
      rows.forEach(r=>tbody.appendChild(r));
      $$('.sort-icon').forEach(i=>i.textContent='↕');
      th.querySelector('.sort-icon').textContent=direction[idx]?'↑':'↓';
    });
  });
});
/*------------------Pagination--------------------------*/
document.addEventListener('DOMContentLoaded', () => {
  const rowsPerPage = 5; // عدد الصفوف لكل صفحة
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