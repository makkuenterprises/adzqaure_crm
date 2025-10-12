@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.quotation.list') }}">Billing</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.quotation.create') }}">Create Quotation</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Quotation</h4>
                        </div>
                        <div class="card-body">
                            {{-- This error display is perfect, no changes needed. --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>The form could not be submitted. Please correct the following errors:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.handle.quotation.create') }}" method="POST">
                                @csrf
                                <div class="row g-3">

                                    <div class="col-md-4">
                                        <label for="customer_id" class="form-label">Customer</label>
                                        <select class="form-select" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                {{-- IMPROVEMENT: Retain old value on validation error --}}
                                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="service_category_id" class="form-label">Service Category</label>
                                        <select class="form-select" name="service_category_id" id="service_category_id" onchange="updateServices(this.value)" required>
                                            <option value="">Select Category</option>
                                            @foreach ($serviceCategories as $category)
                                                {{-- IMPROVEMENT: Retain old value on validation error --}}
                                                <option value="{{ $category->id }}" {{ old('service_category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="service_id" class="form-label">Service</label>
                                        <select class="form-select" name="service_id" id="service-dropdown" required>
                                            {{-- The JS will handle the initial state --}}
                                            <option value="">Select a category first</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="content" class="form-label">Description</label>
                                        {{-- This was already correct, no changes needed --}}
                                        <textarea name="content" id="easy-mde-textarea" class="form-control" rows="6">{{ old('content') }}</textarea>
                                        <small class="form-text text-muted">Use Markdown for formatting. Press Enter twice for a new paragraph.</small>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="quotation_amount" class="form-label">Quotation Amount</label>
                                        {{-- IMPROVEMENT: Retain old value on validation error --}}
                                        <input type="number" step="0.01" name="quotation_amount" class="form-control" placeholder="Enter quotation amount" value="{{ old('quotation_amount') }}" required>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Create Quotation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- EasyMDE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde@2.18.0/dist/easymde.min.css">
<!-- EasyMDE JS -->
<script src="https://cdn.jsdelivr.net/npm/easymde@2.18.0/dist/easymde.min.js"></script>

<script>
    // This data passing is perfect.
    const allServicesGrouped = @json($allServicesGrouped);

    // This function logic is good.
    function updateServices(categoryId, selectedServiceId = null) {
        const serviceDropdown = document.getElementById('service-dropdown');
        serviceDropdown.innerHTML = ''; // Clear existing options

        if (categoryId && allServicesGrouped[categoryId]) {
            serviceDropdown.disabled = false;
            serviceDropdown.innerHTML = '<option value="">Select Service</option>';
            allServicesGrouped[categoryId].forEach(service => {
                const option = new Option(service.service_name, service.id);
                // If a previously selected service ID is passed, select it.
                if (selectedServiceId && service.id == selectedServiceId) {
                    option.selected = true;
                }
                serviceDropdown.add(option);
            });
        } else {
            serviceDropdown.disabled = true;
            serviceDropdown.innerHTML = '<option value="">Select a category first</option>';
        }
    }

   document.addEventListener('DOMContentLoaded', function () {
        // CRITICAL FIX: Initialize EasyMDE on the correct textarea.
        const easyMDE = new EasyMDE({
            element: document.getElementById('easy-mde-textarea'),
            spellChecker: false, // Optional: disable spell checker
            // You can add more configuration options here
        });

        // --- IMPROVEMENT: Handle repopulation of services dropdown on page load ---
        const initialCategoryId = document.getElementById('service_category_id').value;
        const oldServiceId = "{{ old('service_id') }}";

        if (initialCategoryId) {
            updateServices(initialCategoryId, oldServiceId);
        }
        // --- End of improvement ---
    });
</script>
@endsection