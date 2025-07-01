@extends('layouts.user')
@section('title','صراحة - صندوق الوارد')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/inbox.css') }}">
@endsection
@section('main')
      <!-- Main Content -->
     <div class="main-content">
        <div class="content-container">
          <!-- Page Title -->
          <div class="page-title">
            <div>
              <h2 class="title-text">صندوق الوارد</h2>
            </div>
          </div>

          <!-- Search Bar -->
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

<div class="message-list" id="message-list">
  {{-- سيتم تحميل الرسائل هنا بالجاڤا سكريبت --}}
</div>

<button id="load-more">أعرض المزيد</button>

<!-- Popup -->
<div id="popup-overlay" role="dialog" aria-modal="true" aria-labelledby="popup-title" tabindex="-1">
  <div id="popup">
    <button class="btn-close" aria-label="إغلاق">&times;</button>
    <h2 id="popup-title">محتوى الرسالة</h2>
    <div class="content" tabindex="0"></div>
    <div class="popup-time"></div>
    <div class="btn-group">
      <button class="btn-delete">حذف الرسالة</button>
      <button class="btn-report">تبليغ</button>
    </div>
  </div>
</div>

<!-- Notification -->
<div id="notification" role="alert" aria-live="assertive"></div>


<script>
  // قراءة توكن CSRF من Blade
  const csrfToken = '{{ csrf_token() }}';

  // بيانات الرسائل تأتي من Controller كـ JSON
  const messages = @json($messages);

  // عناصر الـ DOM
  const messageList = document.getElementById('message-list');
  const loadMoreBtn = document.getElementById('load-more');

  const popupOverlay = document.getElementById('popup-overlay');
  const popupContent = document.querySelector('#popup .content');
  const popupTime = document.querySelector('#popup .popup-time');
  const btnClose = document.querySelector('#popup .btn-close');
  const btnDelete = document.querySelector('#popup .btn-delete');
  const btnReport = document.querySelector('#popup .btn-report');
  const notification = document.getElementById('notification');

  let currentMessageId = null;
  let currentIndex = 0;
  const PAGE_SIZE = 5;

  function showNotification(message, isError = false) {
    notification.textContent = message;
    if (isError) {
      notification.classList.add('error');
    } else {
      notification.classList.remove('error');
    }
    notification.classList.add('show');
    setTimeout(() => {
      notification.classList.remove('show');
    }, 3500);
  }

  function loadMessages() {
    const end = currentIndex + PAGE_SIZE;
    const slice = messages.slice(currentIndex, end);

    slice.forEach(m => {
      const card = document.createElement('div');
      card.classList.add('message-card');
      card.setAttribute('tabindex', '0');
      card.dataset.id = m.id;
      card.dataset.content = m.content;
      card.dataset.created = m.created_at;
      card.dataset.isRead = m.is_read;

      const contentDiv = document.createElement('div');
      contentDiv.classList.add('message-content');

      const titleDiv = document.createElement('div');
      titleDiv.classList.add('message-title');
      const titleSpan = document.createElement('span');
      titleSpan.classList.add('message-title-text');
      titleSpan.textContent = m.is_read ? 'رسالة مقروءة' : 'رسالة جديدة';
      titleDiv.appendChild(titleSpan);

      const bodyDiv = document.createElement('div');
      bodyDiv.classList.add('message-text');
      const bodySpan = document.createElement('span');
      bodySpan.classList.add('message-body');
      bodySpan.textContent = m.content.length > 60 ? m.content.substring(0, 60) + '...' : m.content;
      bodyDiv.appendChild(bodySpan);

      const timeDiv = document.createElement('div');
      timeDiv.classList.add('message-time');
      const timeSpan = document.createElement('span');
      timeSpan.classList.add('message-time-text');
      timeSpan.textContent = 'وقت الاستلام: ' + m.created_at;
      timeDiv.appendChild(timeSpan);

      contentDiv.appendChild(titleDiv);
      contentDiv.appendChild(bodyDiv);
      contentDiv.appendChild(timeDiv);

      card.appendChild(contentDiv);

      if (m.is_read) {
        const iconDiv = document.createElement('div');
        iconDiv.classList.add('message-icon');
        iconDiv.setAttribute('aria-hidden', 'true');
        iconDiv.innerHTML = `
          <svg class="check-icon" viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"/>
          </svg>`;
        card.appendChild(iconDiv);
      }

      messageList.appendChild(card);

      card.addEventListener('click', () => openPopup(card));
    });

    currentIndex += PAGE_SIZE;

    if (currentIndex >= messages.length) {
      loadMoreBtn.style.display = 'none';
    } else {
      loadMoreBtn.style.display = 'block';
    }
  }

  function openPopup(card) {
    currentMessageId = card.dataset.id;
    popupContent.textContent = card.dataset.content;
    popupTime.textContent = 'وقت الاستلام: ' + card.dataset.created;

    popupOverlay.style.display = 'flex';
    popupOverlay.focus();

    if (card.dataset.isRead === '0' || card.dataset.isRead === 'false') {
      fetch(`/messages/mark-read/${currentMessageId}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
      })
      .then(resp => {
        if (resp.ok) {
          card.dataset.isRead = 'true';
          card.querySelector('.message-title-text').textContent = 'رسالة مقروءة';

          if (!card.querySelector('.message-icon')) {
            const iconDiv = document.createElement('div');
            iconDiv.classList.add('message-icon');
            iconDiv.setAttribute('aria-hidden', 'true');
            iconDiv.innerHTML = `
              <svg class="check-icon" viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"/>
              </svg>`;
            card.appendChild(iconDiv);
          }
        }
      });
    }
  }

  btnClose.addEventListener('click', () => {
    popupOverlay.style.display = 'none';
  });

  popupOverlay.addEventListener('click', (e) => {
    if (e.target === popupOverlay) {
      popupOverlay.style.display = 'none';
    }
  });

  btnDelete.addEventListener('click', () => {
    if (!currentMessageId) return showNotification('حدث خطأ، الرجاء إعادة المحاولة.', true);

    confirmModal('هل أنت متأكد من حذف هذه الرسالة؟').then(confirmed => {
      if (!confirmed) return;

      fetch(`/messages/delete/${currentMessageId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
      .then(response => {
        if (response.ok) {
          showNotification('تم حذف الرسالة.');
          popupOverlay.style.display = 'none';

          // إزالة البطاقة من القائمة
          const cardToRemove = [...messageList.children].find(c => c.dataset.id === currentMessageId);
          if (cardToRemove) {
            messageList.removeChild(cardToRemove);
          }
          currentMessageId = null;
        } else {
          showNotification('فشل حذف الرسالة.', true);
        }
      })
      .catch(() => showNotification('فشل في الاتصال بالخادم.', true));
    });
  });

  btnReport.addEventListener('click', () => {
    showNotification('تم الضغط على زر التبليغ (لم يتم تفعيله بعد).');
  });

  loadMoreBtn.addEventListener('click', () => {
    loadMessages();
  });

  function confirmModal(message) {
    return new Promise((resolve) => {
      let existing = document.getElementById('confirm-modal');
      if (existing) existing.remove();

      const modal = document.createElement('div');
      modal.id = 'confirm-modal';
      modal.style.position = 'fixed';
      modal.style.top = '0';
      modal.style.left = '0';
      modal.style.right = '0';
      modal.style.bottom = '0';
      modal.style.background = 'rgba(0,0,0,0.7)';
      modal.style.display = 'flex';
      modal.style.justifyContent = 'center';
      modal.style.alignItems = 'center';
      modal.style.zIndex = '2000';

      const box = document.createElement('div');
      box.style.background = '#222';
      box.style.color = '#eee';
      box.style.padding = '20px 30px';
      box.style.borderRadius = '12px';
      box.style.maxWidth = '400px';
      box.style.textAlign = 'center';
      box.style.boxShadow = '0 0 15px #6a6aff';

      const text = document.createElement('p');
      text.textContent = message;
      text.style.fontSize = '18px';
      text.style.marginBottom = '25px';

      const btnYes = document.createElement('button');
      btnYes.textContent = 'نعم';
      btnYes.style.margin = '0 10px';
      btnYes.style.padding = '8px 20px';
      btnYes.style.border = 'none';
      btnYes.style.background = '#6a6aff';
      btnYes.style.color = 'white';
      btnYes.style.fontWeight = '600';
      btnYes.style.borderRadius = '8px';
      btnYes.style.cursor = 'pointer';

      const btnNo = document.createElement('button');
      btnNo.textContent = 'لا';
      btnNo.style.margin = '0 10px';
      btnNo.style.padding = '8px 20px';
      btnNo.style.border = 'none';
      btnNo.style.background = '#ff5c5c';
      btnNo.style.color = 'white';
      btnNo.style.fontWeight = '600';
      btnNo.style.borderRadius = '8px';
      btnNo.style.cursor = 'pointer';

      box.appendChild(text);
      box.appendChild(btnYes);
      box.appendChild(btnNo);
      modal.appendChild(box);
      document.body.appendChild(modal);

      btnYes.focus();

      btnYes.onclick = () => {
        modal.remove();
        resolve(true);
      };
      btnNo.onclick = () => {
        modal.remove();
        resolve(false);
      };
    });
  }

  // تحميل أول مجموعة من الرسائل عند تحميل الصفحة
  loadMessages();

  /*---------------Search---------------------*/
  const searchInput = document.querySelector('.search-input');
const messageCards = document.querySelectorAll('.message-card');

searchInput.addEventListener('input', () => {
  const query = searchInput.value.trim().toLowerCase();

  messageCards.forEach(card => {
    const content = card.dataset.content.toLowerCase();

    if (content.includes(query)) {
      card.style.display = 'flex'; // أو 'block' حسب التصميم
    } else {
      card.style.display = 'none';
    }
  });
});


</script>


@endsection