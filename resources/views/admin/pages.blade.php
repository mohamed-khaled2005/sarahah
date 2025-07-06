@extends('layouts.admin')
@section('title', 'إدارة الصفحات')
@section('page-css')
<link rel="stylesheet" href="{{ url('css/pages/admin/pages.css') }}" />

@endsection

@section('main')
<main class="main-content">
    <div class="content-header">
        <h2 class="page-title">إدارة الصفحات</h2>
        <button class="add-btn" onclick="openPageModal()">+ إضافة صفحة جديدة</button>
    </div>

    <div class="search-section">
        <div class="search-container">
            <div class="search-wrapper">
                <input type="text" class="search-input" id="searchInput" placeholder="ابحث عن صفحة">
            </div>
        </div>
    </div>

    <div class="filter-section">
        <button class="filter-dropdown">حسب الحالة</button>
        <button class="filter-dropdown">حسب التاريخ</button>
    </div>

    <div class="table-section">
        <div class="table-container">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>✅</th>
                        <th class="sortable"><span class="sort-icon">▲</span> 📝 العنوان</th>
                        <th>🔗 الـ Slug</th>
                        <th>📊 الحالة</th>
                        <th class="sortable"><span class="sort-icon">▲</span> 📅 التاريخ</th>
                        <th>⚙️ الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="pagesTable">
                    @foreach($pages as $page)
                    <tr data-id="{{ $page->id }}">
                        <td><input type="checkbox" class="checkbox"></td>
                        <td class="page-title-cell">{{ $page->title }}</td>
                        <td class="page-slug-cell">{{ $page->slug }}</td>
                        <td><span class="status-tag status-{{ $page->status }}">{{ $page->status }}</span></td>
                        <td>{{ $page->created_at ? $page->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td class="actions">
                            <span class="edit-btn" onclick="openPageModal({{ $page->id }})">✏️ تعديل</span> |
                            <span class="delete-btn" onclick="deletePage({{ $page->id }})">🗑️ حذف</span>
                            <a href="{{ route('page.show', ['slug' => $page->slug]) }}" target="_blank" class="view-btn">👁️ عرض</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <!-- Pagination -->
<div class="pagination-container" id="pagination"></div>
</main>

<div id="pageModalOverlay" class="modal-overlay hidden">
    <div class="modal">
        <button class="close-btn" onclick="closePageModal()">&times;</button>
        <h3 class="modal-title" id="pageModalTitle">إدارة الصفحة</h3>
        <form id="pageForm" class="page-form">
            @csrf
            <input type="hidden" id="pageId" name="id">

            <div class="form-group">
                <label for="pageTitle">العنوان:</label>
                <input type="text" id="pageTitle" name="title" required>
            </div>

            <div class="form-group">
                <label for="pageSlug">Slug (اختياري):</label>
                <input type="text" id="pageSlug" name="slug">
            </div>

            <div class="form-group">
                <label for="pageContent">المحتوى:</label>
                <textarea id="pageContent" name="content" rows="15" required></textarea>
            </div>

            <div class="form-group">
                <label for="pageStatus">الحالة:</label>
                <select id="pageStatus" name="status" required>
                    <option value="draft">مسودة (Draft)</option>
                    <option value="published">منشور (Published)</option>
                </select>
            </div>

            <button type="submit" class="save-btn" id="savePageButton">💾 حفظ الصفحة</button>
        </form>
    </div>

</div>




<script>
    const pageModalOverlay = document.getElementById('pageModalOverlay');
    const pageModalTitle = document.getElementById('pageModalTitle');
    const pageIdInput = document.getElementById('pageId');
    const pageTitleInput = document.getElementById('pageTitle');
    const pageSlugInput = document.getElementById('pageSlug');
    const pageContentInput = document.getElementById('pageContent');
    const pageStatusSelect = document.getElementById('pageStatus');
    const pageForm = document.getElementById('pageForm');

    function openPageModal(pageId = null) {
        pageForm.reset();
        pageIdInput.value = '';

        if (pageId) {
            pageModalTitle.innerText = 'تعديل صفحة';
            pageIdInput.value = pageId;
            fetch(`{{ route('admin.pages.edit_data', ['page' => '__pageId__']) }}`.replace('__pageId__', pageId))
                .then(response => response.ok ? response.json() : Promise.reject('خطأ في الاستجابة'))
                .then(data => {
                    pageTitleInput.value = data.title;
                    pageSlugInput.value = data.slug || '';
                    pageContentInput.value = data.content;
                    pageStatusSelect.value = data.status;
                })
                .catch(error => {
                    console.error('خطأ في جلب البيانات:', error);
                    alert('تعذر تحميل بيانات الصفحة.');
                });
        } else {
            pageModalTitle.innerText = 'إضافة صفحة جديدة';
            pageStatusSelect.value = 'draft';
        }
        pageModalOverlay.classList.remove('hidden');
    }

    function closePageModal() { pageModalOverlay.classList.add('hidden'); }

    pageForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const pageId = pageIdInput.value;
        let url, method = 'POST';
        if (pageId) {
            url = `{{ route('admin.pages.update', ['page' => '__pageId__']) }}`.replace('__pageId__', pageId);
            formData.append('_method', 'PUT');
        } else {
            url = '{{ route("admin.pages.store") }}';
        }
        fetch(url, {
            method, body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        })
        .then(async res => {
            if (!res.ok) {
                const data = await res.json().catch(() => ({}));
                throw new Error(data.message || Object.values(data.errors || {}).flat().join('\n') || 'خطأ غير معروف');
            }
            return res.json();
        })
        .then(data => { if (data.success) { closePageModal(); location.reload(); } })
        .catch(err => alert('حدث خطأ:\n' + err.message));
    });

    function deletePage(id) {
        if (!confirm('هل أنت متأكد من حذف هذه الصفحة؟')) return;
        fetch(`{{ route('admin.pages.destroy', ['page' => '__pageId__']) }}`.replace('__pageId__', id), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        })
        .then(res => res.ok ? res.json() : Promise.reject('فشل الحذف'))
        .then(data => { if (data.success) { document.querySelector(`tr[data-id="${id}"]`).remove(); alert(data.message); } })
        .catch(err => alert('حدث خطأ أثناء الحذف:\n' + err));
    }

    document.getElementById('searchInput').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#pagesTable tr').forEach(row => {
            const title = row.querySelector('.page-title-cell').innerText.toLowerCase();
            const slug = row.querySelector('.page-slug-cell').innerText.toLowerCase();
            row.style.display = (title.includes(q) || slug.includes(q)) ? '' : 'none';
        });
    });

    document.addEventListener('DOMContentLoaded', () => pageModalOverlay.classList.add('hidden'));

    /*-------------------------pagination--------------------------*/
    document.addEventListener('DOMContentLoaded', () => {
  const rowsPerPage = 10; // عدد الصفوف لكل صفحة
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

/*------------------SORTING MESSAGE----------------*/
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("th.sortable").forEach((th) => {
    th.addEventListener("click", function () {
      const table = th.closest("table");
      const tbody = table.querySelector("tbody");
      const index = Array.from(th.parentNode.children).indexOf(th);
      const ascending = !th.classList.contains("asc");

      // إزالة السورتينج من كل الأعمدة
      table.querySelectorAll("th").forEach((t) => {
        t.classList.remove("asc", "desc");
      });

      // أضف الكلاس للحالة الجديدة
      th.classList.add(ascending ? "asc" : "desc");

      // رتب الصفوف
      Array.from(tbody.querySelectorAll("tr"))
        .sort((a, b) => {
          const A = a.children[index].textContent.trim();
          const B = b.children[index].textContent.trim();
          return ascending ? A.localeCompare(B) : B.localeCompare(A);
        })
        .forEach((tr) => tbody.appendChild(tr));
    });
  });
});

// ---------------- FILTER BY STATUS -----------------
document.querySelector('.filter-section .filter-dropdown:nth-child(1)')
.addEventListener('click', function() {
    const tbody = document.querySelector('#pagesTable');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    let ascending = this.classList.toggle('asc'); // toggle حالة الفرز

    rows.sort((a, b) => {
        const statusA = a.querySelector('.status-tag').textContent.trim();
        const statusB = b.querySelector('.status-tag').textContent.trim();

        return ascending ? statusA.localeCompare(statusB) : statusB.localeCompare(statusA);
    });

    rows.forEach(row => tbody.appendChild(row));
});

// ---------------- FILTER BY DATE -----------------
document.querySelector('.filter-section .filter-dropdown:nth-child(2)')
.addEventListener('click', function() {
    const tbody = document.querySelector('#pagesTable');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    let ascending = this.classList.toggle('asc'); // toggle حالة الفرز

    rows.sort((a, b) => {
        const dateA = new Date(a.children[4].textContent.trim());
        const dateB = new Date(b.children[4].textContent.trim());
        return ascending ? dateA - dateB : dateB - dateA;
    });

    rows.forEach(row => tbody.appendChild(row));
});


</script>
@endsection
