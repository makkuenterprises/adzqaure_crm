@extends('employee.layouts.app')

@section('panel-header')
<div>
    <h1 class="panel-title">Setting</h1>
    <ul class="breadcrumb">
        <li><a href="{{route('employee.view.dashboard')}}">Team Member</a></li>
        <li><i data-feather="chevron-right"></i></li>
        <li><a href="{{route('employee.view.setting')}}">Setting</a></li>
    </ul>
</div>
@endsection

@section('panel-body')

    <div class="grid md:grid-cols-3 sm:grid-cols-1 md:gap-10 sm:gap-5">

        {{-- Account Information Card (Start) --}}
        <figure class="panel-card">
            <div class="h-[220px] w-full bg-admin-ascent border-admin-ascent bg-opacity-50 flex items-center justify-center">
                <img src="{{ is_null(auth()->user('employee')->profile) ? asset('employee/images/default-profile.png') : asset('storage/'.auth()->user('employee')->profile) }}" alt="profile" class="h-[100px] w-[100px] rounded-full border bg-white">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-semibold text-2xl">{{auth()->user()->name}}</h1>
                    <h1 class="text-slate-700 text-sm font-medium flex items-center">
                        <i data-feather="mail" class="h-4 w-4 mr-2"></i> {{auth()->user()->email}}
                    </h1>
                    <h1 class="text-slate-700 text-sm font-medium flex items-center">
                        <i data-feather="phone" class="h-4 w-4 mr-2"></i> {{auth()->user()->phone}}
                    </h1>
                </div>
                <div>
                    <a href="{{route('employee.view.account.setting')}}">
                    <button type="button" class="btn-primary-md w-full"><i data-feather="edit" class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button></a>
                </div>
            </div>
        </figure>
        {{-- Account Information Card (End) --}}

    </div>
@endsection

@section('panel-script')
<script>
    document.getElementById('setting-tab').classList.add('active');
</script>
@endsection