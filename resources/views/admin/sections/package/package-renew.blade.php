@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Renew Package</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.package.list') }}">Packages</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.package.renew',['id' => $package->id]) }}">Renew Package</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.package.renew',['id' => $package->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Start Date --}}
                    <div class="flex flex-col">
                        <label for="renew_date" class="input-label">Renew Date</label>
                        <input type="date" onchange="handleStartDateChange(event)" id="renew_date" name="renew_date" value="{{ old('renew_date') }}"
                            class="input-box-md @error('renew_date') input-invalid @enderror" required>
                        @error('renew_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Renew Package</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('package-tab').classList.add('active');
    </script>
@endsection
