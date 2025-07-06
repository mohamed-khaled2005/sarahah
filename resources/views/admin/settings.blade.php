@extends('layouts.admin')
@section('title','إعدادات الموقع')

@section('page-css')
<link rel="stylesheet" href="{{ url('css/pages/admin/settings.css') }}"/>
@endsection

@section('main')
<main class="main-content">
    <div class="content-header">
        <h2 class="page-title">إعدادات الموقع</h2>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Logo Section -->
        <div class="section">
            <div class="section-header">
                <h3 class="section-title">شعار الموقع</h3>
            </div>
            <div class="section-content">
                <div class="logo-upload" onclick="handleLogoUpload()">
                    <div class="logo-upload-content">
                        <div class="logo-upload-title">اضف شعار الموقع</div>
                        <div class="logo-upload-subtitle">استخدم صورة بجودة واضحة لشعار الموقع الخاص بك</div>
                        <div class="logo-preview">
                            <img 
                                id="logoPreviewImage"
                                src="{{ !empty($settings['site_logo']->value) ? asset('uploads/' . $settings['site_logo']->value) : '#' }}" 
                                height="60"
                                style="{{ empty($settings['site_logo']->value) ? 'display:none;' : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="file" id="logoInput" name="site_logo" style="display: none;">
            </div>
        </div>


        <!-- Site Title -->
        <div class="section">
            <div class="section-header">
                <h3 class="section-title">عنوان الموقع</h3>
            </div>
            <div class="input-container">
                <div class="input-field">
                    <input type="text" name="site_title" class="input filled" placeholder="عنوان الموقع" value="{{ $settings['site_title']->value ?? '' }}" />
                </div>
            </div>
        </div>

        <!-- Navbar العلوية -->
        <div class="section">
            <div class="section-header">
                <h3 class="section-title">القائمة العلوية (Header Navbar)</h3>
            </div>
            @foreach($navItems as $item)
                <div class="input-container">
                    <div class="input-field">
                        <input type="text" name="nav_items[{{ $item->id }}][title]" class="input filled" placeholder="عنوان الرابط" value="{{ $item->title }}">
                    </div>
                    <div class="input-field">
                        <input type="url" name="nav_items[{{ $item->id }}][url]" class="input filled" placeholder="الرابط" value="{{ $item->url }}">
                    </div>
                    <div class="input-field">
                        <input type="text" name="nav_items[{{ $item->id }}][icon]" class="input filled" placeholder="أيقونة أو كود SVG" value="{{ $item->icon }}">
                    </div>
                    <div class="delete-btn" onclick="deleteNavItem({{ $item->id }})">🗑️</div>
                </div>
            @endforeach

            <div id="newNavItems"></div>
            <div class="add-new-btn" onclick="addNewNavItem()">+ إضافة رابط جديد</div>
        </div>

        <!-- Footer Navbar السفلية -->
        <div class="section">
            <div class="section-header">
                <h3 class="section-title">القائمة السفلية (Footer Navbar)</h3>
            </div>
            @foreach($footerNavItems as $item)
                <div class="input-container">
                    <div class="input-field">
                        <input type="text" name="footer_nav_items[{{ $item->id }}][title]" class="input filled" placeholder="عنوان الرابط" value="{{ $item->title }}">
                    </div>
                    <div class="input-field">
                        <input type="url" name="footer_nav_items[{{ $item->id }}][url]" class="input filled" placeholder="الرابط" value="{{ $item->url }}">
                    </div>
                    <div class="input-field">
                        <input type="text" name="footer_nav_items[{{ $item->id }}][icon]" class="input filled" placeholder="أيقونة أو كود SVG" value="{{ $item->icon }}">
                    </div>
                    <div class="delete-btn" onclick="deleteFooterNavItem({{ $item->id }})">🗑️</div>
                </div>
            @endforeach

            <div id="newFooterNavItems"></div>
            <div class="add-new-btn" onclick="addNewFooterNavItem()">+ إضافة رابط جديد</div>
        </div>

        <!-- Toggle Section -->
        <div class="toggle-section">
            <div class="toggle-container">
                <div class="toggle-switch {{ ($settings['ads_enabled']->value ?? false) ? 'active' : '' }}" onclick="toggleSwitch(this)">
                    <div class="toggle-knob"></div>
                </div>
                <input type="hidden" name="ads_enabled" id="adsEnabledInput" value="{{ ($settings['ads_enabled']->value ?? false) ? 1 : 0 }}">
            </div>
            <div class="toggle-label">تفعيل / تعطيل الإعلانات</div>
        </div>

                <!-- Save Button -->
        <div class="save-section">
            <button class="save-btn" type="submit">حفظ الإعدادات</button>
        </div>
    </form>
</main>

<script>
function toggleSwitch(element) {
    element.classList.toggle("active");
    document.getElementById('adsEnabledInput').value = element.classList.contains("active") ? 1 : 0;
}

function handleLogoUpload() {
    document.getElementById('logoInput').click();
}

// ✅ الكود الجديد لعرض الشعار مباشرة عند الاختيار
document.getElementById('logoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.getElementById('logoPreviewImage');
            img.src = event.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

let newNavItemIndex = 0;
function addNewNavItem() {
    let container = document.getElementById('newNavItems');
    container.insertAdjacentHTML('beforeend', `
        <div class="input-container">
            <div class="input-field"><input type="text" name="new_nav_items[${newNavItemIndex}][title]" class="input" placeholder="عنوان الرابط الجديد"></div>
            <div class="input-field"><input type="url" name="new_nav_items[${newNavItemIndex}][url]" class="input" placeholder="الرابط الجديد"></div>
            <div class="input-field"><input type="text" name="new_nav_items[${newNavItemIndex}][icon]" class="input" placeholder="أيقونة أو كود SVG"></div>
        </div>
    `);
    newNavItemIndex++;
}

let newFooterNavItemIndex = 0;
function addNewFooterNavItem() {
    let container = document.getElementById('newFooterNavItems');
    container.insertAdjacentHTML('beforeend', `
        <div class="input-container">
            <div class="input-field"><input type="text" name="new_footer_nav_items[${newFooterNavItemIndex}][title]" class="input" placeholder="عنوان الرابط الجديد"></div>
            <div class="input-field"><input type="url" name="new_footer_nav_items[${newFooterNavItemIndex}][url]" class="input" placeholder="الرابط الجديد"></div>
            <div class="input-field"><input type="text" name="new_footer_nav_items[${newFooterNavItemIndex}][icon]" class="input" placeholder="أيقونة أو كود SVG"></div>
        </div>
    `);
    newFooterNavItemIndex++;
}

function deleteNavItem(id) {
    if(confirm('هل أنت متأكد من حذف هذا الرابط؟')) {
        fetch('/admin/nav-item/delete/' + id, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'}
        }).then(res => res.ok ? location.reload() : alert('خطأ بالحذف!'));
    }
}

function deleteFooterNavItem(id) {
    if(confirm('هل أنت متأكد من حذف هذا الرابط؟')) {
        fetch('/admin/footer-nav-item/delete/' + id, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'}
        }).then(res => res.ok ? location.reload() : alert('خطأ بالحذف!'));
    }
}
</script>
@endsection