@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Plan</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.plan.list') }}">Plans</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.plan.update',['id' => $plan->id]) }}">Edit Plan</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.plan.update',['id' => $plan->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Update Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Name --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $plan->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name"
                            required minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="flex flex-col">
                        <label for="city" class="input-label">City</label>
                        <select name="city" id="city_select" class="input-box-md @error('city') input-invalid @enderror" required>
                            <option value="Select City">Select City</option>
                        </select>
                        @error('city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Duration --}}
                    <div class="flex flex-col">
                        <label for="duration" class="input-label">Duration (In Days)</label>
                        <input type="number" name="duration" value="{{ old('duration', $plan->duration) }}"
                            class="input-box-md @error('duration') input-invalid @enderror" placeholder="Enter duration (in days)"
                            required min="1" max="1000">
                        @error('duration')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Summary --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="summary" class="input-label">Summary</label>
                        <input type="text" name="summary" value="{{ old('summary', $plan->summary) }}"
                            class="input-box-md @error('summary') input-invalid @enderror" placeholder="Enter summary" minlength="1" maxlength="500">
                        @error('summary')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Regular Price --}}
                    <div class="flex flex-col">
                        <label for="price_regular" class="input-label">Regular Price</label>
                        <input type="number" style="any" name="price_regular" value="{{ old('price_regular', $plan->price_regular) }}"
                            class="input-box-md @error('price_regular') input-invalid @enderror" placeholder="Enter regular price"
                            required>
                        @error('price_regular')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Regular Price --}}
                    <div class="flex flex-col">
                        <label for="price_offer" class="input-label">Offer Price</label>
                        <input type="number" style="any" name="price_offer" value="{{ old('price_offer', $plan->price_offer) }}"
                            class="input-box-md @error('price_offer') input-invalid @enderror" placeholder="Enter offer price">
                        @error('price_offer')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Save Changes</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('plan-tab').classList.add('active');

        fetch("{{asset('admin/json/plan-cities.json')}}")
        .then((res) => {
            return res.json();
        })
        .then((res) => {
            res.cities.forEach((city) => {
                let option = document.createElement('option');
                option.value = city;
                option.innerHTML = city;
                if (city == "{{$plan->city}}") {
                    option.selected = true;
                }
                document.getElementById('city_select').appendChild(option);
            });
        })
    </script>
@endsection
