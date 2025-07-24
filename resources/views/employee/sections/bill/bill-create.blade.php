@extends('employee.layouts.app')


@section('main-content')
    <!--**********************************
                                          Content body start
                                         ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.view.bill.list') }}">Billing</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('employee.view.bill.create') }}">Create Invoice
                            </a>
                    </li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('employee.handle.bill.create') }}" method="POST" class="needs-loader"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">

                                        {{-- Row 1: Customer, Category, Service, Date --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="customer_id" class="input-label">Customer<span
                                                        class="text-red-500">*</span></label>
                                                <select class="form-select" name="customer_id" required>
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}
                                                            ({{ $customer->company_name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="service_category_id" class="input-label">Service Category</label>
                                                <select class="form-select" id="service_category_id" onchange="updateServices(this.value)">
                                                    <option value="">Select Category</option>
                                                    @foreach ($serviceCategories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="service_id" class="input-label">Add Service to Bill</label>
                                                <select class="form-select" id="service-dropdown" onchange="addServiceToBill(this.value)" disabled>
                                                    <option value="">Select a category first</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bill_date" class="input-label">Bill date <span
                                                        class="text-red-500">*</span></label>
                                                <input type="date" name="bill_date" value="{{ old('bill_date', date('Y-m-d')) }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        {{-- Row 2: Due Date & Currency --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="due_date" class="input-label">Due date</label>
                                                <input type="date" name="due_date" value="{{ old('due_date') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="invoice_currency" class="input-label">Invoice Currency <span
                                                        class="text-red-500">*</span></label>
                                                <select name="invoice_currency" id="invoice_currency" class="form-select" required>
                                                    <option value="INR" @selected(old('invoice_currency', 'INR') == 'INR')>Indian Rupees (INR)</option>
                                                    <option value="USD" @selected(old('invoice_currency') == 'USD')>US Dollars (USD)</option>
                                                    <option value="AUD" @selected(old('invoice_currency') == 'AUD')>Australian Dollars (AUD)</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- IMPROVED LAYOUT: Bill Items Section --}}
                                        <div class="col-12 mt-4">
                                            <h5>Bill Items</h5>
                                            <hr>
                                            <!-- Headers for the bill items table -->
                                            <div class="row d-none d-md-flex fw-bold mb-2">
                                                <div class="col-md-5">Item Name</div>
                                                <div class="col-md-2">Quantity</div>
                                                <div class="col-md-2">Price</div>
                                                <div class="col-md-2">Total</div>
                                                <div class="col-md-1">Action</div>
                                            </div>

                                            <!-- Container where bill items will be dynamically added -->
                                            <div id="bill-items-inputs">
                                                <!-- Bill items will be added here by JavaScript -->
                                            </div>
                                            @error('bill_item_name')
                                                <span class="input-error d-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Totals, Discounts, and other fields --}}
                                        <div class="col-12">
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" onchange="handleCalculateBill()" id="apply_gst"
                                                    @checked(old('apply_gst')) name="apply_gst" value="1"
                                                    class="form-check-input">
                                                <label for="apply_gst" class="form-check-label">Apply Tax (GST) in this bill</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tax" class="input-label">Tax (GST)</label>
                                            <input type="number" id="tax" name="tax" class="form-control" value="0.00" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total" class="input-label">Sub-Total</label>
                                            <input type="number" id="total" name="total" class="form-control" value="0.00" readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="discount_percentage">Discount (%)</label>
                                            <input type="number" name="discount_percentage" id="discount_percentage" step="0.01" class="form-control" value="0">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="discount_amount">Discount Amount</label>
                                            <input type="number" name="discount_amount" id="discount_amount" step="0.01" class="form-control" value="0">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Grand Total</label>
                                            <input type="text" id="payable_display" class="form-control" value="0.00" readonly style="font-weight: bold; font-size: 1.1rem;">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="payment_status" class="input-label">Payment Status <span class="text-red-500">*</span></label>
                                            <select class="form-select" name="payment_status" required>
                                                <option value="" @selected(old('payment_status') == '')>Select Status</option>
                                                {{-- <option value="Paid" @selected(old('payment_status') == 'Paid')>Paid</option> --}}
                                                <option value="Pending" @selected(old('payment_status', 'Pending') == 'Pending')>Pending</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bill_note" class="input-label">Bill Note</label>
                                            <textarea name="bill_note" rows="4" class="form-control" placeholder="Enter bill note">{{ old('bill_note') }}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Create Invoice</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Data from the controller
        const allServicesGrouped = @json($allServicesGrouped);
        const allServicesLookup = @json($allServicesForLookup);

        // Get references to DOM elements
        const serviceCategoryDropdown = document.getElementById('service_category_id');
        const serviceDropdown = document.getElementById('service-dropdown');
        const currencyDropdown = document.getElementById('invoice_currency');
        const totalInput = document.getElementById("total");
        const discountPercentageInput = document.getElementById("discount_percentage");
        const discountAmountInput = document.getElementById("discount_amount");
        const payableDisplayInput = document.getElementById("payable_display");
        const taxInput = document.getElementById("tax");
        const applyGstCheckbox = document.getElementById('apply_gst');
        const billItemsContainer = document.getElementById('bill-items-inputs');

        function addServiceToBill(serviceId) {
            if (!serviceId) return;

            const service = allServicesLookup[serviceId];
            if (!service) return;

            const selectedCurrency = currencyDropdown.value;
            let price = 0;
            switch (selectedCurrency) {
                case 'USD': price = service.service_price_in_usd; break;
                case 'AUD': price = service.service_price_in_aud; break;
                default:    price = service.service_price_in_inr; break;
            }

            handleCreateBillITem(service.service_name, 1, price, price);
            serviceDropdown.value = ''; // Reset for next selection
        }

        function updateServices(categoryId) {
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

        function updatePayableAmount() {
            let subTotalWithTax = parseFloat(totalInput.value) + parseFloat(taxInput.value);
            let discountPercentage = parseFloat(discountPercentageInput.value) || 0;
            let discountAmount = parseFloat(discountAmountInput.value) || 0;
            let finalPayable = subTotalWithTax;

            if (discountPercentage > 0) {
                discountAmount = (discountPercentage / 100) * subTotalWithTax;
                discountAmountInput.value = discountAmount.toFixed(2);
                finalPayable -= discountAmount;
            } else if (discountAmount > 0) {
                finalPayable -= discountAmount;
            }

            payableDisplayInput.value = finalPayable.toFixed(2);
        }

        function handleCalculateBill() {
            let subTotal = 0;
            document.querySelectorAll('.bill_item_total').forEach(el => {
                subTotal += parseFloat(el.value) || 0;
            });
            totalInput.value = subTotal.toFixed(2);

            let taxValue = 0;
            if (applyGstCheckbox.checked) {
                const taxPercentage = {{ DB::table('company_details')->first()->billing_tax_percentage ?? 0 }};
                taxValue = (subTotal * taxPercentage) / 100;
            }
            taxInput.value = taxValue.toFixed(2);

            updatePayableAmount();
        }

        // Event listeners for discounts to auto-calculate
        discountPercentageInput.addEventListener('input', (e) => {
            if (e.target.value) { discountAmountInput.value = ''; }
            updatePayableAmount();
        });

        discountAmountInput.addEventListener('input', (e) => {
            if (e.target.value) { discountPercentageInput.value = ''; }
            updatePayableAmount();
        });

        // Listen for changes on currency and tax to re-calculate everything
        currencyDropdown.addEventListener('change', handleCalculateBill);
        applyGstCheckbox.addEventListener('change', handleCalculateBill);

        // =========================================================================
        // REVISED: This function now creates a read-only item row with a grid layout.
        // =========================================================================
        function handleCreateBillITem(name, quantity, price, total) {
            const itemRow = document.createElement('div');
            itemRow.className = "row align-items-center mb-2";

            // Column for Item Name (Read-only)
            const nameCol = document.createElement('div');
            nameCol.className = "col-md-5";
            const nameInput = document.createElement('input');
            nameInput.type = "text";
            nameInput.className = "form-control bill_item_name";
            nameInput.name = "bill_item_name[]";
            nameInput.value = name;
            nameInput.readOnly = true;
            nameCol.appendChild(nameInput);

            // Column for Quantity (Editable)
            const qtyCol = document.createElement('div');
            qtyCol.className = "col-md-2";
            const qtyInput = document.createElement('input');
            qtyInput.type = "number";
            qtyInput.className = "form-control bill_item_quantity";
            qtyInput.name = "bill_item_quantity[]";
            qtyInput.value = quantity;
            qtyInput.min = 1;
            qtyInput.required = true;
            qtyInput.oninput = (e) => {
                const priceVal = parseFloat(e.target.closest('.row').querySelector('.bill_item_price').value) || 0;
                e.target.closest('.row').querySelector('.bill_item_total').value = (priceVal * e.target.value).toFixed(2);
                handleCalculateBill();
            };
            qtyCol.appendChild(qtyInput);

            // Column for Price (Read-only)
            const priceCol = document.createElement('div');
            priceCol.className = "col-md-2";
            const priceInput = document.createElement('input');
            priceInput.type = "text";
            priceInput.className = "form-control bill_item_price";
            priceInput.name = "bill_item_price[]";
            priceInput.value = parseFloat(price).toFixed(2);
            priceInput.readOnly = true;
            priceCol.appendChild(priceInput);

            // Column for Total (Read-only)
            const totalCol = document.createElement('div');
            totalCol.className = "col-md-2";
            const totalInput = document.createElement('input');
            totalInput.type = "text";
            totalInput.className = "form-control bill_item_total";
            totalInput.name = "bill_item_total[]";
            totalInput.value = parseFloat(total).toFixed(2);
            totalInput.readOnly = true;
            totalCol.appendChild(totalInput);

            // Column for Remove Button
            const actionCol = document.createElement('div');
            actionCol.className = "col-md-1";
            const removeBtn = document.createElement('button');
            removeBtn.type = "button";
            removeBtn.className = "btn btn-danger btn-sm";
            removeBtn.innerHTML = '×';
            removeBtn.onclick = (e) => {
                e.target.closest('.row').remove();
                handleCalculateBill();
            };
            actionCol.appendChild(removeBtn);

            itemRow.append(nameCol, qtyCol, priceCol, totalCol, actionCol);
            billItemsContainer.appendChild(itemRow);

            handleCalculateBill(); // Recalculate everything after adding the row
        }
    </script>
@endsection
