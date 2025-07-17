@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                                          Content body start
                                         ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.bill.list') }}">Billing</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.bill.create') }}">Billing
                            Customer</a>
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
                                <form action="{{ route('admin.handle.bill.create') }}" method="POST" class="needs-loader"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">

                                        {{-- Customer --}}
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
                                                @error('customer_id')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Bill Date --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bill_date" class="input-label">Bill date <span
                                                        class="text-red-500">*</span></label>
                                                <input type="date" name="bill_date" value="{{ old('bill_date') }}"
                                                    class="form-control @error('bill_date') input-invalid @enderror"
                                                    required>
                                                @error('bill_date')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Due Date --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="due_date" class="input-label">Due date</label>
                                                <input type="date" name="due_date" value="{{ old('due_date') }}"
                                                    class="form-control @error('due_date') input-invalid @enderror">
                                                @error('due_date')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Currency --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="invoice_currency" class="input-label">Invoice Currency <span
                                                        class="text-red-500">*</span></label>
                                                <select name="invoice_currency" class="form-select" required>
                                                    <option value="INR" @selected(old('invoice_currency', 'INR') == 'INR')>Indian Rupees (INR)
                                                    </option>
                                                    <option value="USD" @selected(old('invoice_currency') == 'USD')>US Dollars (USD)
                                                    </option>
                                                    <option value="AUD" @selected(old('invoice_currency') == 'AUD')>Australian Dollars
                                                        (AUD)</option>
                                                </select>
                                                @error('invoice_currency')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Bill Items --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bill_items" class="input-label">Bill Items</label>
                                                <div class="space-y-2" id="bill-items-inputs">
                                                    <!-- Bill items will be added dynamically -->
                                                </div>
                                                <button type="button" onclick="handleCreateBillITem(null,null,null,null)"
                                                    class="btn btn-secondary">Add Item</button>
                                                @error('bill_items')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Apply GST --}}
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" onchange="handleCalculateBill()" id="apply_gst"
                                                    @checked(old('apply_gst')) name="apply_gst" value="1"
                                                    class="form-check-input">
                                                <label for="apply_gst" class="form-check-label">Apply Tax (GST) in this
                                                    bill</label>
                                            </div>
                                        </div>

                                        {{-- Tax --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tax" class="input-label">Tax (GST)</label>
                                                <input type="number" step="any" value="0.00" id="tax"
                                                    name="tax" value="{{ old('tax') }}"
                                                    class="form-control @error('tax') input-invalid @enderror"
                                                    placeholder="Enter tax" readonly>
                                                @error('tax')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Total --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total" class="input-label">Total</label>
                                                <input type="number" step="any" value="0.00" id="total"
                                                    name="total" value="{{ old('total') }}"
                                                    class="form-control @error('total') input-invalid @enderror"
                                                    placeholder="Enter total" readonly>
                                                @error('total')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <!-- Discount Percentage -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount_percentage">Discount (%)</label>
                                                    <input type="number" name="discount_percentage" id="discount_percentage" step="0.01" class="form-control" value="0">
                                                </div>
                                            </div>

                                            <!-- Discount Amount -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount_amount">Discount (₹)</label>
                                                    <input type="number" name="discount_amount" id="discount_amount" step="0.01" class="form-control" value="0">
                                                </div>
                                            </div>

                                            <!-- Payable After Discount -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Payable After Discount (₹)</label>
                                                    <input type="text" id="payable_display" class="form-control" value="0.00" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Payment Status --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="payment_status" class="input-label">Payment Status <span
                                                        class="text-red-500">*</span></label>
                                                <select class="form-select" name="payment_status" required>
                                                    <option value="" @selected(old('payment_status') == '')>Select Payment
                                                        Status</option>
                                                    <option value="Paid" @selected(old('payment_status', 'Pending') == 'Paid')>Paid</option>
                                                    <option value="Pending" @selected(old('payment_status', 'Pending') == 'Pending')>Pending</option>
                                                </select>
                                                @error('payment_status')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Bill Note --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="bill_note" class="input-label">Bill Note</label>
                                                <textarea name="bill_note" rows="5" class="form-control @error('bill_note') input-invalid @enderror"
                                                    placeholder="Enter bill note" minlength="1" maxlength="1000">{{ old('bill_note') }}</textarea>
                                                @error('bill_note')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Create Invoice</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                                                                    Content body end
                                                                ***********************************-->
@endsection

@section('js')
    <script>
        // Get references to elements once to avoid repeated lookups
        const totalInput = document.getElementById("total");
        const discountPercentageInput = document.getElementById("discount_percentage");
        const discountAmountInput = document.getElementById("discount_amount");
        const payableDisplayInput = document.getElementById("payable_display");
        const taxInput = document.getElementById("tax");
        const applyGstCheckbox = document.getElementById('apply_gst');
        const billItemsContainer = document.getElementById('bill-items-inputs');

        function updatePayableAmount() {
            let total = parseFloat(totalInput.value) || 0;
            let discountPercentage = parseFloat(discountPercentageInput.value) || 0;
            let discountAmount = parseFloat(discountAmountInput.value) || 0;
            let finalPayable = total;

            // Determine which discount to apply
            if (discountPercentage > 0) {
                // If a percentage is being used, calculate the amount from it
                discountAmount = (discountPercentage / 100) * total;
                discountAmountInput.value = discountAmount.toFixed(2); // Update the other input for clarity
                finalPayable = total - discountAmount;
            } else if (discountAmount > 0) {
                // If a fixed amount is used
                finalPayable = total - discountAmount;
            }

            payableDisplayInput.value = finalPayable.toFixed(2);
        }

        function handleCalculateBill() {
            let subTotal = 0;

            // Calculate subtotal from all bill items
            document.querySelectorAll('.bill_item_total').forEach((element) => {
                subTotal += parseFloat(element.value) || 0;
            });

            let finalTotal = subTotal;
            let taxValue = 0;

            // Calculate and add tax if applicable
            if (applyGstCheckbox.checked) {
                const taxPercentage = {{ DB::table('company_details')->first()->billing_tax_percentage ?? 0 }};
                taxValue = (subTotal * taxPercentage) / 100;
                finalTotal += taxValue;
            }

            taxInput.value = taxValue.toFixed(2);
            totalInput.value = finalTotal.toFixed(2);

            // *** THE KEY STEP ***
            // Now that the total is updated, also update the final payable amount
            updatePayableAmount();
        }

        // Add event listeners
        discountPercentageInput.addEventListener('input', (e) => {
            // If user types a percentage, clear the fixed amount field
            if (e.target.value) {
                discountAmountInput.value = '';
            }
            updatePayableAmount();
        });

        discountAmountInput.addEventListener('input', (e) => {
            // If user types a fixed amount, clear the percentage field
            if (e.target.value) {
                discountPercentageInput.value = '';
            }
            updatePayableAmount();
        });


        // --- Your existing `handleCreateBillITem` function (unchanged) ---
        function handleCreateBillITem(name, quantity, price, total) {
            let parentDiv = document.createElement('div');
            parentDiv.className = "d-flex justify-content-between mb-2";

            let billItemNameInput = document.createElement('input');
            billItemNameInput.type = "text";
            billItemNameInput.className = "form-control bill_item_name";
            billItemNameInput.name = "bill_item_name[]";
            billItemNameInput.value = name || '';
            billItemNameInput.required = true;
            billItemNameInput.placeholder = "Enter item name";

            let billItemQuantityInput = document.createElement('input');
            billItemQuantityInput.type = "number";
            billItemQuantityInput.className = "form-control bill_item_quantity";
            billItemQuantityInput.name = "bill_item_quantity[]";
            billItemQuantityInput.value = quantity || 1;
            billItemQuantityInput.required = true;
            billItemQuantityInput.placeholder = "Qty";

            billItemQuantityInput.oninput = (event) => { // use oninput for instant feedback
                event.target.parentNode.querySelector('.bill_item_total').value = (event.target.parentNode
                    .querySelector('.bill_item_price').value * event.target.value).toFixed(2);
                handleCalculateBill();
            };

            let billItemPriceInput = document.createElement('input');
            billItemPriceInput.type = "number";
            billItemPriceInput.className = "form-control bill_item_price";
            billItemPriceInput.name = "bill_item_price[]";
            billItemPriceInput.value = price || '';
            billItemPriceInput.required = true;
            billItemPriceInput.placeholder = "Enter price";
            billItemPriceInput.setAttribute('step', 'any');

            billItemPriceInput.oninput = (event) => { // use oninput for instant feedback
                event.target.parentNode.querySelector('.bill_item_total').value = (event.target.parentNode
                    .querySelector('.bill_item_quantity').value * event.target.value).toFixed(2);
                handleCalculateBill();
            };

            let billItemTotalInput = document.createElement('input');
            billItemTotalInput.type = "number";
            billItemTotalInput.className = "form-control bill_item_total";
            billItemTotalInput.name = "bill_item_total[]";
            billItemTotalInput.value = total || 0;
            billItemTotalInput.required = true;
            billItemTotalInput.placeholder = "Total";
            billItemTotalInput.setAttribute('step', 'any');
            billItemTotalInput.setAttribute('readonly', true);

            let remove = document.createElement('button');
            remove.className = "btn btn-danger";
            remove.innerHTML = ' × ';
            remove.type = "button";
            remove.onclick = (event) => {
                event.target.parentNode.remove();
                handleCalculateBill();
            }

            parentDiv.append(billItemNameInput, billItemQuantityInput, billItemPriceInput, billItemTotalInput, remove);
            billItemsContainer.appendChild(parentDiv);
        }
    </script>
@endsection
