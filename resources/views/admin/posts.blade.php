@extends('layouts.admin')
@section('title', 'صراحة - إدارة المقالات')
@section('page-css')
<link rel="stylesheet" href="{{ url('css/pages/admin/posts.css') }}" />
@endsection

@section('main')
<main class="main-content">
    <div class="content-header">
        <h2 class="page-title">إدارة المقالات</h2>
        <button class="add-btn" onclick="openPostModal()">+ إضافة مقال جديد</button>
    </div>

    <div class="search-section">
        <div class="search-container">
            <div class="search-wrapper">
                <input type="text" class="search-input" id="searchInput" placeholder="ابحث عن مقال">
            </div>
        </div>
    </div>

    <div class="filter-section">
        <button class="filter-dropdown">حسب الحالة</button>
        <button class="filter-dropdown">حسب التاريخ</button>
        {{-- يمكن إضافة فلاتر هنا للمؤلف والقسم إذا أردت --}}
    </div>

    <div class="table-section">
        <div class="table-container">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>✅</th>
                        <th class="sortable"><span class="sort-icon">▲</span> 📝 العنوان</th>
                        <th>🔗 الرابط (Slug)</th>
                        <th>🏞️ الصورة المصغرة</th>
                        <th>✍️ المؤلف</th> {{-- حقل جديد --}}
                        <th class="sortable"><span class="sort-icon">▲</span>🏷️ القسم</th> {{-- حقل جديد --}}
                        <th>📊 الحالة</th>
                        <th class="sortable"><span class="sort-icon">▲</span>📅 التاريخ</th>
                        <th>⚙️ الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="postsTable">
                    @foreach($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td><input type="checkbox" class="checkbox"></td>
                        <td class="post-title-cell">{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>
                            @if($post->thumbnail && file_exists(public_path('avatars/' . $post->thumbnail)))
                          <img src="{{ asset('avatars/' . $post->thumbnail) }}" alt="Thumbnail" class="table-thumbnail">
                            @else
                              لا يوجد
                            @endif

                        </td>
                        {{-- عرض اسم المؤلف والقسم من نفس عمود المقال --}}
                        <td>{{ $post->author ?? 'غير معروف' }}</td>
                        <td>{{ $post->category ?? 'غير مصنف' }}</td>
                        <td><span class="status-tag status-{{ $post->status }}">{{ $post->status }}</span></td>
                        <td>{{ $post->created_at ? $post->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td class="actions">
                            <span class="edit-btn" onclick="openPostModal({{ $post->id }})">✏️ تعديل</span> |
                            <span class="delete-btn" onclick="deletePost({{ $post->id }})">🗑️ حذف</span> |
                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="view-btn">👁️ عرض</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-container" id="pagination"></div>
</main>

<div id="postModalOverlay" class="modal-overlay hidden">
    <div class="modal">
        <button class="close-btn" onclick="closePostModal()">&times;</button>
        <h3 class="modal-title" id="postModalTitle">إدارة المقال</h3>
        <form id="postForm" class="post-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="postId" name="id">

            <div class="form-group">
                <label for="postTitle">العنوان:</label>
                <input type="text" id="postTitle" name="title" required>
            </div>

            <div class="form-group">
                <label for="postSlug">الرابط (Slug):</label>
                <input type="text" id="postSlug" name="slug" required>
                <small>سيتم استخدامه في رابط المقال (مثال: my-awesome-post)</small>
            </div>

            <div class="form-group">
                <label for="postContent">المحتوى:</label>
                <textarea id="postContent" name="content" rows="15" required></textarea>
            </div>

            <div class="form-group">
                <label for="postThumbnail">صورة المقال المصغرة:</label>
                <input type="file" id="postThumbnail" name="thumbnail">
                <img id="currentPostThumbnail" src="" alt="الصورة المصغرة الحالية" class="current-image-preview hidden">
            </div>

            {{-- حقول المؤلف والقسم كـ input text --}}
            <div class="form-group">
                <label for="postAuthor">المؤلف:</label>
                <input type="text" id="postAuthor" name="author" required>
            </div>

            <div class="form-group">
                <label for="postCategory">القسم:</label>
                <input type="text" id="postCategory" name="category" required>
            </div>

            <div class="form-group">
                <label for="postStatus">الحالة:</label>
                <select id="postStatus" name="status" required>
                    <option value="draft">مسودة (Draft)</option>
                    <option value="published">منشور (Published)</option>
                </select>
            </div>

            <button type="submit" class="save-btn" id="savePostButton">💾 حفظ المقال</button>
        </form>
    </div>
</div>

<script>
    const postModalOverlay = document.getElementById('postModalOverlay');
    const postModalTitle = document.getElementById('postModalTitle');
    const postIdInput = document.getElementById('postId');
    const postTitleInput = document.getElementById('postTitle');
    const postSlugInput = document.getElementById('postSlug');
    const postContentInput = document.getElementById('postContent');
    const postThumbnailInput = document.getElementById('postThumbnail');
    const currentPostThumbnail = document.getElementById('currentPostThumbnail');
    const postStatusSelect = document.getElementById('postStatus');
    const postAuthorInput = document.getElementById('postAuthor'); // تعريف الحقل الجديد
    const postCategoryInput = document.getElementById('postCategory'); // تعريف الحقل الجديد
    const postForm = document.getElementById('postForm');

    postTitleInput.addEventListener('input', function () {
        if (!postIdInput.value) {
            const slug = this.value.toLowerCase().trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            postSlugInput.value = slug;
        }
    });

    function openPostModal(postId = null) {
        postForm.reset();
        currentPostThumbnail.classList.add('hidden');
        currentPostThumbnail.src = '';
        postIdInput.value = '';

        if (postId) {
            postModalTitle.innerText = 'تعديل مقال';
            postIdInput.value = postId;
            fetch(`/admin/posts/${postId}/edit`)
                .then(response => {
                    if (!response.ok) throw new Error('خطأ في الاستجابة');
                    return response.json();
                })
                .then(data => {
                    postTitleInput.value = data.title;
                    postSlugInput.value = data.slug;
                    postContentInput.value = data.content;
                    if (data.thumbnail_url) {
                        currentPostThumbnail.src = data.thumbnail_url;
                        currentPostThumbnail.classList.remove('hidden');
                    }
                    postStatusSelect.value = data.status;
                    // تعبئة حقول المؤلف والقسم من بيانات المقال مباشرةً
                    postAuthorInput.value = data.author || '';
                    postCategoryInput.value = data.category || '';
                })
                .catch(error => {
                    console.error('خطأ في جلب البيانات:', error);
                    alert('تعذر تحميل بيانات المقال.');
                });
        } else {
            postModalTitle.innerText = 'إضافة مقال جديد';
            postStatusSelect.value = 'draft';
            // إفراغ حقول المؤلف والقسم للمقالات الجديدة
            postAuthorInput.value = '';
            postCategoryInput.value = '';
        }

        postModalOverlay.classList.remove('hidden');
    }

    function closePostModal() {
        postModalOverlay.classList.add('hidden');
    }

    postForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);
        const postId = postIdInput.value;
        let url = '/admin/posts';

        if (postId) {
            url = `/admin/posts/${postId}`;
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            if (!response.ok) {
                let errorMsg = 'الرد غير صالح';
                try {
                    const errorData = await response.json();
                    if (errorData.errors) {
                        errorMsg = Object.values(errorData.errors).flat().join('\n');
                    } else if (errorData.message) {
                        errorMsg = errorData.message;
                    }
                } catch (e) {
                    // إذا لم يكن الرد JSON، فاستخدم حالة النص الافتراضية
                }
                throw new Error(errorMsg);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                closePostModal();
                location.reload();
            } else {
                alert('خطأ: ' + (data.message || 'لم يتم الحفظ.'));
            }
        })
        .catch(error => {
            console.error('Error saving post:', error);
            alert('حدث خطأ أثناء حفظ المقال:\n' + error.message);
        });
    });

    function deletePost(id) {
        if (!confirm('هل أنت متأكد من حذف هذا المقال؟')) return;

        fetch(`/admin/posts/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            if (!response.ok) {
                let errorMsg = 'الرد غير صالح';
                try {
                    const errorData = await response.json();
                    if (errorData.message) {
                        errorMsg = errorData.message;
                    }
                } catch (e) {
                    // إذا لم يكن الرد JSON، فاستخدم حالة النص الافتراضية
                }
                throw new Error(errorMsg);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.querySelector(`tr[data-id="${id}"]`).remove();
                alert(data.message || 'تم حذف المقال بنجاح!');
            } else {
                alert('خطأ: ' + (data.message || 'لم يتم الحذف.'));
            }
        })
        .catch(error => {
            console.error('Error deleting post:', error);
            alert('حدث خطأ أثناء حذف المقال.\n' + error.message);
        });
    }

    document.getElementById('searchInput').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#postsTable tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // هذا الجزء يضمن إخفاء المودال عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', (event) => {
        postModalOverlay.classList.add('hidden');
    });

        /*-------------------------pagination--------------------------*/
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
    const tbody = document.querySelector('#postsTable');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    let ascending = this.classList.toggle('asc'); // toggle حالة الفرز

    rows.sort((a, b) => {
        const statusA = a.querySelector('.status-tag').textContent.trim();
        const statusB = b.querySelector('.status-tag').textContent.trim();

        // ترتيب: published قبل draft إذا تصاعدي، والعكس إذا تنازلي
        if (ascending) {
            return statusA.localeCompare(statusB);
        } else {
            return statusB.localeCompare(statusA);
        }
    });

    // إعادة ترتيب الصفوف
    rows.forEach(row => tbody.appendChild(row));
});

// ---------------- FILTER BY DATE -----------------
document.querySelector('.filter-section .filter-dropdown:nth-child(2)')
.addEventListener('click', function() {
    const tbody = document.querySelector('#postsTable');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    let ascending = this.classList.toggle('asc'); // toggle حالة الفرز

    rows.sort((a, b) => {
        const dateA = new Date(a.children[7].textContent.trim());
        const dateB = new Date(b.children[7].textContent.trim());

        return ascending ? dateA - dateB : dateB - dateA;
    });

    // إعادة ترتيب الصفوف
    rows.forEach(row => tbody.appendChild(row));
});
</script>
@endsection