@extends('layouts.user')
@section('title','تعديل الملف الشخصي')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/profile.css') }}">
@endsection


{{-- profile.blade.php --}}
@section('main')
<div class="profile-widget">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="pw-alert pw-alert-success">
            {{ session('success') }}
            <button type="button" class="pw-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    @if($errors->any())
        <div class="pw-alert pw-alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
            <button type="button" class="pw-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    <div class="pw-card">
        <form class="pw-form" method="POST"
              action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- بيانات المستخدم --}}
            <div class="pw-left">
                <label class="pw-label">الاسم الكامل</label>
                <input name="name" value="{{ old('name',$user->name) }}"
                       class="pw-input @error('name') pw-invalid @enderror">
                @error('name') <div class="pw-feedback">{{ $message }}</div> @enderror

                <label class="pw-label">اسم المستخدم</label>
                <input name="username" value="{{ old('username',$user->username) }}"
                       class="pw-input @error('username') pw-invalid @enderror">
                @error('username') <div class="pw-feedback">{{ $message }}</div> @enderror

                <label class="pw-label">النبذة التعريفية</label>
                <textarea name="bio" rows="3"
                          class="pw-input @error('bio') pw-invalid @enderror">{{ old('bio',$user->bio) }}</textarea>
                @error('bio') <div class="pw-feedback">{{ $message }}</div> @enderror

                <button class="pw-btn">💾 حفظ التغييرات</button>
            </div>

            {{-- صورة البروفايل --}}
            <div class="pw-right">
                              @php
    $avatarPath = public_path('avatars/'.$user->avatar);
@endphp
                   @if($user->avatar && file_exists($avatarPath))
    <img src="{{ asset('avatars/'.$user->avatar) }}" 
                  alt="Avatar" class="pw-avatar" >
@else
    <img src="{{ asset('images/profile.png') }}"  alt="Avatar" class="pw-avatar" >
@endif
                <input type="file" name="avatar" accept="image/*"
                       class="pw-input-file @error('avatar') pw-invalid @enderror"
                       onchange="previewImg(this)">
                @error('avatar') <div class="pw-feedback">{{ $message }}</div> @enderror
            </div>
        </form>
    </div>
</div>

{{-- معاينة الصورة قبل الرفع --}}
<script src="{{url('js/user/profile.js')}}">
    </script>
@endsection


