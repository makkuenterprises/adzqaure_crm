@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height font-sans">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.quotation.list') }}">Billing</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.quotation.create') }}">Create Quotation</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Create Pro-Rata Quotation</h4>
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

                            <form action="{{ route('admin.handle.quotation.create') }}" method="POST" class="needs-loader">
                                @csrf

                                <div class="row g-3">
                                    <!-- Left Column: Customer Selector & Dynamic Preview -->
                                    <div class="col-md-6 border-end pr-4">
                                        <div class="form-group mb-3">
                                            <label for="customer_id" class="form-label font-w600">Select Customer</label>
                                            <select class="form-select" name="customer_id" id="customer-dropdown" onchange="handleCustomerChange(this.value)" required>
                                                <option value="">Select Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                                        {{ $customer->name }} ({{ $customer->company_name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Dynamic Customer Profile Preview Card -->
                                        <div id="customer-info-box" class="card bg-light border border-slate-200 d-none">
                                            <div class="card-body p-3">
                                                <h5 class="text-primary font-w600 mb-1" id="info-name"></h5>
                                                <p class="text-dark font-w500 mb-2" id="info-company"></p>
                                                <hr class="my-2" style="opacity: 0.1;">
                                                <div class="fs-12 leading-relaxed">
                                                    <div><strong>Email:</strong> <span id="info-email" class="font-sans"></span></div>
                                                    <div><strong>Phone:</strong> <span id="info-phone" class="font-mono"></span></div>
                                                    <div><strong>Address:</strong> <span id="info-address" class="font-sans"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column: Service Category & Main Service Selector -->
                                    <div class="col-md-6 pl-4">
                                        <div class="form-group mb-3">
                                            <label for="service_category_id" class="form-label font-w600">Service Category</label>
                                            <select class="form-select" name="service_category_id" id="service_category_id" onchange="updateServices(this.value)" required>
                                                <option value="">Select Category</option>
                                                @foreach ($serviceCategories as $category)
                                                    <option value="{{ $category->id }}" @selected(old('service_category_id') == $category->id)>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="service_id" class="form-label font-w600">Main Scope Service</label>

                                            <!-- Hidden input to safely store the primary service ID for backend validator -->
                                            <input type="hidden" name="service_id" id="hidden-service-id" value="{{ old('service_id') }}">

                                            <!-- Dropdown select is no longer marked 'required' or assigned 'name' -->
                                            <select class="form-select" id="service-dropdown" onchange="addServiceToQuotationGrid(this.value)">
                                                <option value="">Select a category first</option>
                                            </select>
                                            <small class="form-text text-muted">Selecting a service will automatically append it to the dynamic quote items list below.</small>
                                        </div>
                                    </div>

                                    <!-- Dynamic Multi-Service Quote Items -->
                                    <div class="col-md-12 mt-4">
                                        <h5>Multi-Service Line Items</h5>
                                        <hr>
                                        <div class="row d-none d-md-flex fw-bold mb-2">
                                            <div class="col-md-5">Item/Service Description</div>
                                            <div class="col-md-2">Quantity</div>
                                            <div class="col-md-2">Unit Rate</div>
                                            <div class="col-md-2">Total Amount</div>
                                            <div class="col-md-1 text-end">Action</div>
                                        </div>

                                        <div id="quote-items-container">
                                            <!-- Dynamic items go here -->
                                        </div>

                                        <button type="button" onclick="handleCreateQuotationItem(null, 1, 0, 0)" class="btn btn-secondary btn-sm mt-2">
                                            + Add Custom Line Item
                                        </button>
                                    </div>

                                    <!-- Proposal Details Description -->
                                    <div class="col-md-12 mt-4">
                                        <label for="content" class="form-label font-w600">Proposal Details (EasyMDE Editor)</label>
                                        <textarea name="content" id="easy-mde-textarea" class="form-control" rows="6">{{ old('content') }}</textarea>
                                        <small class="form-text text-muted">Use Markdown for formatting. Press Enter twice for a new paragraph.</small>
                                    </div>

                                    <!-- Editable Terms & Conditions -->
                                    <div class="col-md-12 mt-4">
                                        <label for="terms" class="form-label font-w600">Terms & Conditions</label>
                                        <textarea name="terms" id="terms-textarea" class="form-control" rows="5" placeholder="Enter terms and conditions...">{{ old('terms', "1. Prices are valid for 30 days from the quotation date.\n2. Payment terms: 50% upfront, 50% upon completion.\n3. Any additional services requested will be quoted separately.\n4. This quotation is subject to our standard terms of service.\n5. All intellectual property rights for custom-developed materials remain with Adzquare until full payment is received.") }}</textarea>
                                        <small class="form-text text-muted">Pre-filled with Adzquare's default terms. Feel free to edit or write custom clauses.</small>
                                    </div>

                                    <!-- Calculation Summary Card -->
                                    <div class="col-md-6 offset-md-6 mt-4">
                                        <div class="card bg-light border">
                                            <div class="card-body p-4">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="font-w600 text-muted">Subtotal:</span>
                                                    <span id="subtotal_display" class="font-mono font-w600 text-dark">₹0.00</span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                                    <span class="font-w600 text-muted">GST (18%):</span>
                                                    <span id="gst_display" class="font-mono font-w600 text-dark">+ ₹0.00</span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="font-w700 text-dark">Quotation Amount (Net):</span>
                                                    <input type="number" step="0.01" name="quotation_amount" id="quotation_amount" class="form-control font-mono font-w700 text-primary" style="width: 150px; font-size: 1.1rem; text-align: right;" value="{{ old('quotation_amount', '0.00') }}" required>
                                                </div>
                                            </div>
                                        </div>
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
    // Comprehensive lookups passed cleanly from controller
    const allServicesGrouped = @json($allServicesGrouped);
    const allServicesLookup = @json($allServicesForLookup ?? []);
    const customersLookup = @json($customers->keyBy('id'));

    // Dynamic customer details block display
    function handleCustomerChange(customerId) {
        const infoBox = document.getElementById('customer-info-box');
        if (!customerId || !customersLookup[customerId]) {
            infoBox.classList.add('d-none');
            return;
        }

        const client = customersLookup[customerId];
        document.getElementById('info-name').innerText = client.name || "N/A";
        document.getElementById('info-company').innerText = client.company_name || "";
        document.getElementById('info-email').innerText = client.email || "N/A";
        document.getElementById('info-phone').innerText = client.phone || "N/A";

        // Build address string cleanly
        const addressParts = [client.street, client.city, client.pincode, client.state, client.country].filter(Boolean);
        document.getElementById('info-address').innerText = addressParts.join(', ') || "No address details available.";

        infoBox.classList.remove('d-none');
    }

    // Dynamic services append to dropdown
    function updateServices(categoryId, selectedServiceId = null) {
        const serviceDropdown = document.getElementById('service-dropdown');
        serviceDropdown.innerHTML = '';

        if (categoryId && allServicesGrouped[categoryId]) {
            serviceDropdown.disabled = false;
            serviceDropdown.innerHTML = '<option value="">Select Service</option>';
            allServicesGrouped[categoryId].forEach(service => {
                const option = new Option(service.service_name, service.id);
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

    // Core Calculation: Subtotal, GST, and Total Amount
    function handleCalculateQuotation() {
        let subtotal = 0;
        document.querySelectorAll('.quote_item_total').forEach(el => {
            subtotal += parseFloat(el.value) || 0;
        });

        // 18% GST calculation
        let gst = subtotal * 0.18;
        let grandTotal = subtotal + gst;

        document.getElementById('subtotal_display').innerText = '₹' + subtotal.toFixed(2);
        document.getElementById('gst_display').innerText = '+ ₹' + gst.toFixed(2);
        document.getElementById('quotation_amount').value = grandTotal.toFixed(2);
    }

    // Appends a service item row dynamically on select
    function addServiceToQuotationGrid(serviceId) {
        if (!serviceId || !allServicesLookup[serviceId]) return;

        const service = allServicesLookup[serviceId];
        const defaultPrice = parseFloat(service.service_price_in_inr) || 0;

        handleCreateQuotationItem(service.service_name, 1, defaultPrice, defaultPrice);

        // Dynamic assignment: Set the hidden service_id for backend validation if not already set
        const hiddenServiceId = document.getElementById('hidden-service-id');
        if (!hiddenServiceId.value) {
            hiddenServiceId.value = serviceId;
        }

        document.getElementById('service-dropdown').value = ''; // Reset select
    }

    // Dynamic Row Builder
    function handleCreateQuotationItem(name, quantity, price, total) {
        const itemRow = document.createElement('div');
        itemRow.className = "row align-items-center mb-2";

        // Item Name / Service Description
        const nameCol = document.createElement('div');
        nameCol.className = "col-md-5";
        const nameInput = document.createElement('input');
        nameInput.type = "text";
        nameInput.className = "form-control quote_item_name";
        nameInput.name = "quote_item_name[]";
        nameInput.value = name || "";
        nameInput.required = true;
        nameInput.placeholder = "Enter item/service description";
        nameCol.appendChild(nameInput);

        // Quantity
        const qtyCol = document.createElement('div');
        qtyCol.className = "col-md-2";
        const qtyInput = document.createElement('input');
        qtyInput.type = "number";
        qtyInput.className = "form-control quote_item_quantity";
        qtyInput.name = "quote_item_quantity[]";
        qtyInput.value = quantity || 1;
        qtyInput.min = 1;
        qtyInput.required = true;
        qtyInput.oninput = (e) => {
            const row = e.target.closest('.row');
            const rateVal = parseFloat(row.querySelector('.quote_item_price').value) || 0;
            row.querySelector('.quote_item_total').value = (rateVal * e.target.value).toFixed(2);
            handleCalculateQuotation();
        };
        qtyCol.appendChild(qtyInput);

        // Price
        const priceCol = document.createElement('div');
        priceCol.className = "col-md-2";
        const priceInput = document.createElement('input');
        priceInput.type = "number";
        priceInput.step = "any";
        priceInput.className = "form-control quote_item_price";
        priceInput.name = "quote_item_price[]";
        priceInput.value = price || 0;
        priceInput.required = true;
        priceInput.placeholder = "Rate";
        priceInput.oninput = (e) => {
            const row = e.target.closest('.row');
            const qtyVal = parseFloat(row.querySelector('.quote_item_quantity').value) || 0;
            row.querySelector('.quote_item_total').value = (qtyVal * e.target.value).toFixed(2);
            handleCalculateQuotation();
        };
        priceCol.appendChild(priceInput);

        // Total
        const totalCol = document.createElement('div');
        totalCol.className = "col-md-2";
        const totalInput = document.createElement('input');
        totalInput.type = "text";
        totalInput.className = "form-control quote_item_total";
        totalInput.name = "quote_item_total[]";
        totalInput.value = parseFloat(total || 0).toFixed(2);
        totalInput.readOnly = true;
        totalCol.appendChild(totalInput);

        // Remove Button
        const actionCol = document.createElement('div');
        actionCol.className = "col-md-1 text-end";
        const removeBtn = document.createElement('button');
        removeBtn.type = "button";
        removeBtn.className = "btn btn-danger btn-sm";
        removeBtn.innerHTML = '×';
        removeBtn.onclick = (e) => {
            e.target.closest('.row').remove();
            handleCalculateQuotation();
        };
        actionCol.appendChild(removeBtn);

        itemRow.append(nameCol, qtyCol, priceCol, totalCol, actionCol);
        document.getElementById('quote-items-container').appendChild(itemRow);

        handleCalculateQuotation();
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize EasyMDE markdown editor
        const easyMDE = new EasyMDE({
            element: document.getElementById('easy-mde-textarea'),
            spellChecker: false,
        });

        // Handle repopulation of services dropdown on validation failure
        const initialCategoryId = document.getElementById('service_category_id').value;
        const oldServiceId = "{{ old('service_id') }}";

        if (initialCategoryId) {
            updateServices(initialCategoryId, oldServiceId);
        }

        // Initialize preselected customer preview card if present (old values)
        const preselectedCustomer = document.getElementById('customer-dropdown').value;
        if (preselectedCustomer) {
            handleCustomerChange(preselectedCustomer);
        }
    });
</script>
@endsection
