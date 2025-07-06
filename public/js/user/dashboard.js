 function copyToClipboard() {
        const urlText = document.getElementById("shareUrl").textContent;
        const copyBtn = document.getElementById("copyBtnText");

        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard
            .writeText(urlText)
            .then(() => {
              copyBtn.textContent = "تم النسخ!";
              setTimeout(() => {
                copyBtn.textContent = "نسخ الرابط";
              }, 2000);
            })
            .catch(() => {
              fallbackCopyTextToClipboard(urlText, copyBtn);
            });
        } else {
          fallbackCopyTextToClipboard(urlText, copyBtn);
        }
      }

      function fallbackCopyTextToClipboard(text, btn) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
          const successful = document.execCommand("copy");
          if (successful) {
            btn.textContent = "تم النسخ!";
            setTimeout(() => {
              btn.textContent = "نسخ الرابط";
            }, 2000);
          }
        } catch (err) {
          console.error("Fallback: Oops, unable to copy", err);
        }

        document.body.removeChild(textArea);
      }

      /* ال pagination */
      document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (!loadMoreBtn) return;

    loadMoreBtn.addEventListener('click', function() {
        const nextPage = this.getAttribute('data-next-page');
        const url = '{{ route("user") }}' + '?page=' + nextPage;

        this.disabled = true;
        this.textContent = 'جاري التحميل...';

        fetch(url)
        .then(response => response.text())
        .then(html => {
            // ننشئ عنصر مؤقت لتحليل كامل الصفحة المُعادة
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            // نبحث عن العناصر الجديدة في الصفحة المُعادة فقط داخل container الرسائل
            const newItems = tempDiv.querySelectorAll('#activities-container .activity-item');

            if (newItems.length === 0) {
                // لو مفيش عناصر جديدة نخفي زر "عرض المزيد"
                loadMoreBtn.style.display = 'none';
                return;
            }

            // نضيف العناصر الجديدة إلى الـ container الأصلي
            const container = document.getElementById('activities-container');
            newItems.forEach(item => {
                container.appendChild(item);
            });

            // تحديث رقم الصفحة التالية للزر
            const newPage = parseInt(nextPage) + 1;
            loadMoreBtn.setAttribute('data-next-page', newPage);
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent = 'عرض المزيد';
        })
        .catch(err => {
            console.error('Error loading more messages:', err);
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent = 'عرض المزيد';
        });
    });
});
