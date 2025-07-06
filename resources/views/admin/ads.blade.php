@extends('layouts.admin')
@section('title', 'إدارة الإعلانات')

@section('page-css')
<link rel="stylesheet" href="{{ url('css/pages/admin/ads.css') }}" />

@endsection

@section('main')
<main class="main-content">
    <div class="content-header">
        <h2 class="page-title">إدارة الإعلانات</h2>
        <button class="add-btn" style="display: none;">+ إضافة إعلان جديد</button>
    </div>

    <div class="tab-navigation">
        <div class="tab-list" id="adTabs">
            @foreach($adTypes as $dbName => $displayName)
                <a href="#" class="tab-item" data-ad-name="{{ $dbName }}">
                    {{ $displayName }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="form-section">
        <div class="form-group">
            <label class="form-label" for="adCodeTextarea">كود الإعلان</label>
            <textarea class="form-textarea" id="adCodeTextarea" placeholder="أدخل كود الإعلان هنا..."></textarea>
        </div>
    </div>

    <div class="toggle-section">
        <div class="toggle-label">تفعيل الإعلان</div>
        <div class="toggle-container">
            <div class="toggle-switch" id="adToggleSwitch">
                <div class="toggle-knob"></div>
            </div>
        </div>
    </div>

    <div class="action-section">
        <button class="save-btn" id="saveAdButton">💾 حفظ الإعلان</button>
    </div>

    <div class="warning-section">
        <p class="warning-text">يرجى التأكد من أن يكون كود الإعلان صحيح.</p>
    </div>
</main>

<script>
    const adTabs = document.getElementById('adTabs');
    const adCodeTextarea = document.getElementById('adCodeTextarea');
    const adToggleSwitch = document.getElementById('adToggleSwitch');
    const saveAdButton = document.getElementById('saveAdButton');

    let currentAdName = ''; // الإعلان النشط حاليًا
    const adsEnabled = @json($adsEnabled); // القيمة من السيرفر (true/false)

    // تبديل حالة السويتش مع مراعاة adsEnabled
    function toggleSwitch(element) {
        if (!adsEnabled) {
            alert('تم تعطيل الإعلانات من إعدادات الموقع، لا يمكن تفعيل إعلان.');
            return;
        }
        element.classList.toggle("active");
    }

    async function loadAdData(adName) {
        try {
            const response = await fetch(`/admin/ads/show?name=${encodeURIComponent(adName)}`);
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'خطأ في جلب بيانات الإعلان.');
            }
            const data = await response.json();

            adCodeTextarea.value = data.code || '';
            adToggleSwitch.classList.toggle('active', data.active);
            currentAdName = adName;
        } catch (error) {
            console.error('Error loading ad data:', error);
            alert('حدث خطأ أثناء تحميل بيانات الإعلان: ' + error.message);
            adCodeTextarea.value = '';
            adToggleSwitch.classList.remove('active');
            currentAdName = '';
        }
    }

    adTabs.querySelectorAll(".tab-item").forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();
            adTabs.querySelectorAll(".tab-item").forEach((t) => t.classList.remove("active"));
            this.classList.add("active");
            loadAdData(this.dataset.adName);
        });
    });

    adToggleSwitch.addEventListener('click', function() {
        toggleSwitch(this);
    });

    saveAdButton.addEventListener('click', async function() {
        if (!currentAdName) {
            alert('يرجى اختيار نوع الإعلان أولاً.');
            return;
        }

        const adCode = adCodeTextarea.value;
        const isActive = adToggleSwitch.classList.contains('active');

        try {
            const response = await fetch('/admin/ads/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: currentAdName,
                    code: adCode,
                    active: isActive
                })
            });

            if (!response.ok) {
                const errorData = await response.json();
                let errorMessage = 'حدث خطأ أثناء حفظ الإعلان.';
                if (errorData.errors) {
                    errorMessage += '\n' + Object.values(errorData.errors).flat().join('\n');
                } else if (errorData.message) {
                    errorMessage = errorData.message;
                }
                throw new Error(errorMessage);
            }

            const data = await response.json();
            alert(data.message);

        } catch (error) {
            console.error('Error saving ad:', error);
            alert('فشل حفظ الإعلان: ' + error.message);
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const firstTab = adTabs.querySelector('.tab-item');
        if (firstTab) {
            firstTab.classList.add('active');
            loadAdData(firstTab.dataset.adName);
        }
    });
</script>
@endsection
