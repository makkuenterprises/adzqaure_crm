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
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="service_category_id" class="form-label">Service Category</label>
                                        <select class="form-select" name="service_category_id" id="service_category_id" onchange="updateServices(this.value)" required>
                                            <option value="">Select Category</option>
                                            @foreach ($serviceCategories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="service_id" class="form-label">Service</label>
                                        <select class="form-select" name="service_id" id="service-dropdown" required>
                                            <option value="">Select a category first</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="content" class="form-label">Description</label>
                                        <textarea name="content" id="easy-mde-textarea" class="form-control" rows="6">{{ old('content') }}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="quotation_amount" class="form-label">Quotation Amount</label>
                                        <input type="number" step="0.01" name="quotation_amount" class="form-control" placeholder="Enter quotation amount" required>
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
    const allServicesGrouped = @json($allServicesGrouped);

    function updateServices(categoryId) {
        const serviceDropdown = document.getElementById('service-dropdown');
        serviceDropdown.innerHTML = '';

        if (categoryId && allServicesGrouped[categoryId]) {
            serviceDropdown.disabled = false;
            serviceDropdown.innerHTML = '<option value="">Select Service</option>';
            allServicesGrouped[categoryId].forEach(service => {
                serviceDropdown.add(new Option(service.service_name, service.id));
            });
        } else {
            serviceDropdown.disabled = true;
            serviceDropdown.innerHTML = '<option value="">Select a category first</option>';
        }
    }

   document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#rich-textarea'))
            .catch(error => {
                console.error(error);
            });
    });


</script>
@endsection
