@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.service.list') }}">Service List</a></li>
                    <li class="breadcrumb-item active"><a href="#">Update Service</a></li>
                </ol>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.handle.service.update', $service->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Service Name <span class="text-danger">*</span></label>
                                <input type="text" name="service_name"
                                    class="form-control @error('service_name') is-invalid @enderror"
                                    value="{{ old('service_name', $service->service_name) }}" required>
                                @error('service_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Service Category <span class="text-danger"> *</span></label>
                                <select name="service_category_id"
                                    class="form-control @error('service_category_id') is-invalid @enderror" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $service->service_category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Price (INR) <span class="text-danger"> *</span></label>
                                <input type="number" step="0.01" name="service_price_in_inr" class="form-control"
                                    value="{{ old('service_price_in_inr', $service->service_price_in_inr) }}" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Price (USD)</label>
                                <input type="number" step="0.01" name="service_price_in_usd" class="form-control"
                                    value="{{ old('service_price_in_usd', $service->service_price_in_usd) }}"
                                    placeholder="e.g. 12.50">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Price (AUD)</label>
                                <input type="number" step="0.01" name="service_price_in_aud" class="form-control"
                                    value="{{ old('service_price_in_aud', $service->service_price_in_aud) }}"
                                    placeholder="e.g. 20.00">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Discounted Price</label>
                                <input type="number" step="0.01" name="discounted_price" class="form-control"
                                    value="{{ old('discounted_price', $service->discounted_price) }}"
                                    placeholder="e.g. 50.00">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Govt. Fee Applied?</label><br>
                                <input type="checkbox" id="govt_fee_checkbox" value="1" onchange="toggleGovtFeeInput()"
                                    {{ $service->govt_fee ? 'checked' : '' }}>
                            </div>

                            <div class="mb-3 col-md-6" id="govt_fee_input_box" style="display: none;">
                                <label class="form-label">Govt. Fee</label>
                                <input type="number" step="0.01" name="govt_fee"
                                    class="form-control @error('govt_fee') is-invalid @enderror"
                                    value="{{ old('govt_fee', $service->govt_fee) }}">
                                @error('govt_fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Subscription Duration</label>
                                <select name="subscription_duration"
                                    class="form-control @error('subscription_duration') is-invalid @enderror" required>
                                    <option value="">-- Select Duration --</option>
                                    <option value="0"
                                        {{ old('subscription_duration', $service->subscription_duration) == '0' ? 'selected' : '' }}>
                                        One-Time</option>
                                    <option value="30"
                                        {{ old('subscription_duration', $service->subscription_duration) == '30' ? 'selected' : '' }}>
                                        30
                                        Days</option>
                                    <option value="90"
                                        {{ old('subscription_duration', $service->subscription_duration) == '90' ? 'selected' : '' }}>
                                        90
                                        Days</option>
                                    <option value="180"
                                        {{ old('subscription_duration', $service->subscription_duration) == '180' ? 'selected' : '' }}>
                                        180 Days</option>
                                    <option value="365"
                                        {{ old('subscription_duration', $service->subscription_duration) == '365' ? 'selected' : '' }}>
                                        365 Days</option>
                                </select>
                                @error('subscription_duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Partner Margin (%)</label>
                                <input type="number" name="partner_margin_percentage" step="0.01" class="form-control"
                                    value="{{ old('partner_margin_percentage', $service->partner_margin_percentage) }}"
                                    placeholder="e.g. 10 for 10%">
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label">Service Details</label>
                                <textarea name="service_details" class="form-control" rows="3"
                                    placeholder="Add detailed description about the service">{{ old('service_details', $service->service_details) }}</textarea>
                            </div>
                        </div>

                        <hr>
                        <h5>Required Documents</h5>
                        <div id="documents-area">
                            @foreach ($service->documents as $index => $doc)
                                <div class="document-row row mt-2">
                                    <div class="col-md-4">
                                        <input type="text" name="documents[{{ $index }}][name]"
                                            class="form-control"
                                            value="{{ old('documents.' . $index . '.name', $doc->document_name) }}"
                                            placeholder="Document Name">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="documents[{{ $index }}][file]"
                                            class="form-control">
                                        <input type="hidden" name="documents[{{ $index }}][old_file]"
                                            value="{{ $doc->document_file }}">
                                        @if ($doc->document_file)
                                            <a href="{{ asset('admin_new/service_document/' . $doc->document_file) }}"
                                                target="_blank">
                                                View/Documents
                                            </a>
                                        @endif

                                    </div>
                                    <div class="col-md-2">
                                        <label><input type="checkbox" name="documents[{{ $index }}][is_required]"
                                                {{ old('documents.' . $index . '.is_required', $doc->is_required) ? 'checked' : '' }}>
                                            Required</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" onclick="addDocumentRow()">Add More
                            Document</button>

                        <br><br>
                        <button type="submit" class="btn btn-primary">Update Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let docIndex = {{ count($service->documents) }};

        function addDocumentRow() {
            const container = document.getElementById('documents-area');
            const html = `
                <div class="document-row row mt-2">
                    <div class="col-md-4">
                        <input type="text" name="documents[${docIndex}][name]" class="form-control" placeholder="Document Name">
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="documents[${docIndex}][file]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label><input type="checkbox" name="documents[${docIndex}][is_required]" checked> Required</label>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            docIndex++;
        }

        function toggleGovtFeeInput() {
            const checkbox = document.getElementById('govt_fee_checkbox');
            const inputBox = document.getElementById('govt_fee_input_box');
            inputBox.style.display = checkbox.checked ? 'block' : 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleGovtFeeInput(); // Call once to set visibility on load
        });
    </script>
@endsection
