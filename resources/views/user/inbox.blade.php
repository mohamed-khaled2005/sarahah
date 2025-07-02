@extends('layouts.user')
@section('title','صراحة - صندوق الوارد')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/inbox.css') }}">
@endsection
@section('main')
<style>
  .message-card.featured   {border-right:4px solid gold}
  .message-card .star-icon {margin-inline-start:4px}
  #notification            {transition:opacity .25s;opacity:0}
  #notification.show       {opacity:1}
  #notification.error      {background:#ff4d4d}
  /* نوافذ منبثقة مصغّرة */
  .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.6);display:flex;justify-content:center;align-items:center;z-index:3000}
  .modal-box    {background:#222;color:#eee;padding:20px 30px;border-radius:12px;max-width:420px;width:94%;box-shadow:0 0 18px #6a6aff;text-align:center}
  .modal-box button{margin:0 6px;padding:7px 20px;border:none;border-radius:8px;color:#fff;cursor:pointer}
  .modal-box .btn-ok{background:#6a6aff}
  .modal-box .btn-cancel{background:#ff5c5c}
  .modal-box textarea{width:100%;min-height:90px;margin-bottom:14px;border-radius:8px;border:none;padding:10px;background:#333;color:#eee;font-family:inherit;resize:vertical}
</style>

<div class="main-content">
  <h2 class="title-text">صندوق الوارد</h2>
 <div class="search-container">
            <div class="search-bar">
              <div class="search-wrapper">
                <!-- Search Input - Right side for RTL -->
                <div class="search-input-container">
                  <input
                    type="text"
                    class="search-input"
                    placeholder="ابحث في الرسائل"
                    dir="rtl"
                  />
                </div>

                <!-- Search Icon - Left side for RTL -->
                <div class="search-icon-container">
                  <svg
                    class="search-icon"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M19.5306 18.4694L14.8366 13.7762C17.6629 10.383 17.3204 5.36693 14.0591 2.38935C10.7978 -0.588237 5.77134 -0.474001 2.64867 2.64867C-0.474001 5.77134 -0.588237 10.7978 2.38935 14.0591C5.36693 17.3204 10.383 17.6629 13.7762 14.8366L18.4694 19.5306C18.7624 19.8237 19.2376 19.8237 19.5306 19.5306C19.8237 19.2376 19.8237 18.7624 19.5306 18.4694V18.4694ZM1.75 8.5C1.75 4.77208 4.77208 1.75 8.5 1.75C12.2279 1.75 15.25 4.77208 15.25 8.5C15.25 12.2279 12.2279 15.25 8.5 15.25C4.77379 15.2459 1.75413 12.2262 1.75 8.5V8.5Z"
                    />
                  </svg>
                </div>
              </div>
            </div>
          </div>

  <div id="message-list"></div>
  <button id="load-more">أعرض المزيد</button>
</div>

<div id="popup-overlay" role="dialog" aria-modal="true" tabindex="-1" style="display:none">
  <div id="popup">
    <button class="btn-close" aria-label="إغلاق">&times;</button>
    <h2 id="popup-title">محتوى الرسالة</h2>
    <div class="content" tabindex="0"></div>
    <div class="popup-time"></div>
    <div class="btn-group">
      <button class="btn-delete">حذف</button>
      <button class="btn-report">تبليغ</button>
      <button class="btn-feature"></button>
    </div>
  </div>
</div>

<div id="notification" role="alert" aria-live="assertive"></div>

<script>
const csrfToken  = '{{ csrf_token() }}';
const messages   = @json($messages);
const reportURL  = '{{ route('reports.store') }}';
const PAGE_SIZE  = 5;

const messageList   = document.getElementById('message-list');
const loadMoreBtn   = document.getElementById('load-more');
const popupOverlay  = document.getElementById('popup-overlay');
const popup         = document.getElementById('popup');
const popupContent  = popup.querySelector('.content');
const popupTime     = popup.querySelector('.popup-time');
const btnClose      = popup.querySelector('.btn-close');
const btnDelete     = popup.querySelector('.btn-delete');
const btnReport     = popup.querySelector('.btn-report');
const btnFeature    = popup.querySelector('.btn-feature');
const searchInput   = document.querySelector('.search-input');
const notification  = document.getElementById('notification');

let currentMessageId = null;
let currentIndex     = 0;

/* إشعار */
function notify(text, err = false) {
  notification.textContent = text;
  notification.classList.toggle('error', err);
  notification.classList.add('show');
  setTimeout(() => notification.classList.remove('show'), 3000);
}

/* مودال تأكيد */
function modalConfirm(text) {
  return new Promise(resolve => {
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    overlay.innerHTML = `
      <div class="modal-box">
        <p style="margin-bottom:18px">${text}</p>
        <button class="btn-ok">نعم</button>
        <button class="btn-cancel">لا</button>
      </div>`;
    document.body.appendChild(overlay);
    overlay.querySelector('.btn-ok').onclick     = () => { overlay.remove(); resolve(true); };
    overlay.querySelector('.btn-cancel').onclick = () => { overlay.remove(); resolve(false); };
  });
}

/* مودال كتابة السبب */
function modalPrompt(title) {
  return new Promise(resolve => {
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    overlay.innerHTML = `
      <div class="modal-box" dir="rtl">
        <h3 style="margin-bottom:14px">${title}</h3>
        <textarea placeholder="اكتب هنا..." required style="width:100%;min-height:90px;border-radius:8px;border:none;padding:10px;background:#333;color:#eee;margin-bottom:14px"></textarea>
        <div>
          <button class="btn-ok">إرسال</button>
          <button class="btn-cancel">إلغاء</button>
        </div>
      </div>`;
    document.body.appendChild(overlay);
    const textarea = overlay.querySelector('textarea');
    textarea.focus();
    overlay.querySelector('.btn-ok').onclick     = () => {
      const v = textarea.value.trim();
      if (v) { overlay.remove(); resolve(v); }
    };
    overlay.querySelector('.btn-cancel').onclick = () => { overlay.remove(); resolve(null); };
  });
}

/* إنشاء بطاقة رسالة */
function buildCard(m) {
  const card = document.createElement('div');
  card.className = 'message-card' + (m.is_featured ? ' featured' : '');
  Object.assign(card.dataset, {
    id         : m.id,
    content    : m.content,
    created    : m.created_at,
    isRead     : m.is_read,
    isFeatured : m.is_featured ? 'true' : 'false'
  });
  card.innerHTML = `
    <div class="message-content">
      <div class="message-title">
        <span class="message-title-text">${m.is_read ? 'رسالة مقروءة' : 'رسالة جديدة'}</span>
        ${m.is_featured ? '<svg class="star-icon" viewBox="0 0 24 24" width="22"><path d="M12 2l3 7h7l-5.5 4.5L18 22l-6-3-6 3 1.5-8.5L2 9h7z"/></svg>' : ''}
      </div>
      <div class="message-text"><span>${m.content.length > 60 ? m.content.slice(0, 60) + '…' : m.content}</span></div>
      <div class="message-time"><span>وقت الاستلام: ${m.created_at}</span></div>
    </div>
    ${m.is_read ? '<svg class="check-icon" viewBox="0 0 19 14" width="24"><path d="M18.53 1.28L6.53 13.28c-.14.14-.33.22-.53.22s-.39-.08-.53-.22L.22 8.03a.75.75 0 111.06-1.06L6 11.69 17.47.22a.75.75 0 111.06 1.06z"/></svg>' : ''}`;
  card.addEventListener('click', () => openPopup(card));
  return card;
}

/* تحميل الرسائل */
function loadMessages() {
  messages.slice(currentIndex, currentIndex + PAGE_SIZE).forEach(m => messageList.appendChild(buildCard(m)));
  currentIndex += PAGE_SIZE;
  loadMoreBtn.style.display = currentIndex < messages.length ? 'block' : 'none';
}

/* فتح الرسالة */
function openPopup(card) {
  currentMessageId = card.dataset.id;
  popupContent.textContent = card.dataset.content;
  popupTime.textContent = 'وقت الاستلام: ' + card.dataset.created;
  btnFeature.textContent = card.dataset.isFeatured === 'true' ? 'إزالة التمييز' : 'تمييز';
  popupOverlay.style.display = 'flex';

  if (card.dataset.isRead === '0' || card.dataset.isRead === 'false') {
    fetch(`/messages/mark-read/${currentMessageId}`, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken }
    }).then(r => {
      if (r.ok) {
        card.dataset.isRead = 'true';
        card.querySelector('.message-title-text').textContent = 'رسالة مقروءة';
        if (!card.querySelector('.check-icon')) {
          card.insertAdjacentHTML('beforeend',
            '<svg class="check-icon" viewBox="0 0 19 14" width="24"><path d="M18.53 1.28L6.53 13.28c-.14.14-.33.22-.53.22s-.39-.08-.53-.22L.22 8.03a.75.75 0 111.06-1.06L6 11.69 17.47.22a.75.75 0 111.06 1.06z"/></svg>');
        }
      }
    });
  }
}

/* زر الإغلاق */
btnClose.onclick = () => popupOverlay.style.display = 'none';
popupOverlay.addEventListener('click', e => { if (e.target === popupOverlay) popupOverlay.style.display = 'none'; });

/* زر الحذف */
btnDelete.onclick = () => {
  modalConfirm('هل أنت متأكد من الحذف؟').then(ok => {
    if (!ok) return;
    fetch(`/messages/delete/${currentMessageId}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': csrfToken }
    }).then(r => {
      if (r.ok) {
        notify('تم الحذف');
        popupOverlay.style.display = 'none';
        document.querySelector(`[data-id="${currentMessageId}"]`)?.remove();
      } else {
        notify('فشل الحذف', true);
      }
    }).catch(() => notify('خطأ اتصال', true));
  });
};

/* زر التبليغ */
btnReport.onclick = () => {
  modalPrompt('سبب التبليغ').then(reason => {
    if (!reason) return;
    btnReport.disabled = true;
    fetch(reportURL, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ message_id: currentMessageId, reason })
    }).then(r => {
      notify(r.ok ? 'تم إرسال التبليغ' : 'فشل التبليغ', !r.ok);
    }).catch(() => notify('خطأ اتصال', true))
      .finally(() => btnReport.disabled = false);
  });
};

/* زر التمييز */
btnFeature.onclick = () => {
  btnFeature.disabled = true;
  fetch(`/messages/toggle-featured/${currentMessageId}`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken }
  })
    .then(r => r.json())
    .then(data => {
      const card = document.querySelector(`[data-id="${currentMessageId}"]`);
      card.dataset.isFeatured = data.is_featured ? 'true' : 'false';
      btnFeature.textContent = data.is_featured ? 'إزالة التمييز' : 'تمييز';

      if (data.is_featured) {
        card.classList.add('featured');
        if (!card.querySelector('.star-icon')) {
          card.querySelector('.message-title').insertAdjacentHTML('beforeend',
            '<svg class="star-icon" viewBox="0 0 24 24" width="22"><path d="M12 2l3 7h7l-5.5 4.5L18 22l-6-3-6 3 1.5-8.5L2 9h7z"/></svg>');
        }
      } else {
        card.classList.remove('featured');
        card.querySelector('.star-icon')?.remove();
      }

      notify(data.is_featured ? 'تم تمييز الرسالة' : 'تم إلغاء التمييز');
    }).catch(() => notify('فشل التمييز', true))
    .finally(() => btnFeature.disabled = false);
};

/* البحث */
searchInput.addEventListener('input', () => {
  const q = searchInput.value.trim().toLowerCase();
  [...messageList.children].forEach(c => {
    c.style.display = c.dataset.content.toLowerCase().includes(q) ? 'flex' : 'none';
  });
});

/* تحميل أولي */
loadMessages();
loadMoreBtn.onclick = loadMessages;
</script>


@endsection