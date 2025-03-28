@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Settings</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.setting') }}">Settings</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-10 sm:gap-5">

        {{-- Account Information Card (Start) --}}
        <figure class="panel-card">
            <div class="h-[220px] w-full bg-admin-ascent border-admin-ascent bg-opacity-50 flex items-center justify-center">

                <img src="{{ is_null(auth()->user()->profile) || auth()->user()->profile == '' ? asset('admin/profile/default-profile.png') : asset('admin/profile/' . auth()->user()->profile) }}"
                    alt="profile" class="h-[100px] w-[100px] rounded-full border bg-white">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-semibold text-2xl">{{ auth()->user()->name }}</h1>
                    <p class="text-slate-600 text-sm">
                        Manage your account information
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.view.account.setting') }}">
                        <button type="button" class="btn-primary-md w-full"><i data-feather="edit"
                                class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button></a>
                </div>
            </div>
        </figure>
        {{-- Account Information Card (End) --}}

        {{-- Account Information Card (Start) --}}
        <figure class="panel-card">
            <div class="h-[220px] w-full flex items-center justify-center overflow-clip border-b">
                <img src="{{ asset('admin/images/setting-company-details.png') }}" alt="company-info" class="w-full">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-semibold text-2xl">Company Details</h1>
                    <p class="text-slate-600 text-sm">
                        Manage your company information
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.view.company.details.setting') }}">
                        <button type="button" class="btn-primary-md w-full"><i data-feather="edit"
                                class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button></a>
                </div>
            </div>
        </figure>
        {{-- Account Information Card (End) --}}

        {{-- Mail Credentials Card (Start) --}}
        <figure class="panel-card">
            <div class="h-[220px] w-full flex items-center justify-center overflow-clip border-b">
                <img src="{{ asset('admin/images/setting-mail-credentials.png') }}" alt="mail-credentials" class="w-full">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-semibold text-2xl">Mail Credentials</h1>
                    <p class="text-slate-600 text-sm">
                        Manage & Setup your mail credentials
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.view.mail.credentials.setting') }}">
                        <button type="button" class="btn-primary-md w-full"><i data-feather="edit"
                                class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button></a>
                </div>
            </div>
        </figure>
        {{-- Mail Credentials Card (End) --}}

    </div>
@endsection

@section('panel-script')
    <script>
        document.getElementById('setting-tab').classList.add('active');
    </script>
@endsection
