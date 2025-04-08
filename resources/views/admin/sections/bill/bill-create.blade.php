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
                                <form action="{{ route('admin.handle.bill.create') }}" method="POST"
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
                                    <button type="submit" class="btn btn-primary">Create Customer</button>
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
        function handleCalculateBill() {

            let total = 0;
            let itemTotal = 0;

            document.querySelectorAll('.bill_item_total').forEach((element) => {
                itemTotal += parseInt(element.value);
            });

            total += itemTotal;

            if (document.getElementById('apply_gst').checked) {
                const taxPercentage = {{ DB::table('company_details')->first()->billing_tax_percentage ?? 0 }};
                let tax = (total * taxPercentage) / 100;
                total += tax;
                document.getElementById('tax').value = tax.toFixed(2);
            } else {
                let tax = 0;
                document.getElementById('tax').value = tax.toFixed(2);
            }

            document.getElementById('total').value = total.toFixed(2);
        };

        function handleCreateBillITem(name, quantity, price, total) {

            let parentDiv = document.createElement('div');
            parentDiv.className = "d-flex justify-content-between mb-2";

            let billItemNameInput = document.createElement('input');
            billItemNameInput.type = "text";
            billItemNameInput.className = "form-control bill_item_name";
            billItemNameInput.name = "bill_item_name[]";
            billItemNameInput.value = name;
            billItemNameInput.required = true;
            billItemNameInput.placeholder = "Enter item name";

            let billItemQuantityInput = document.createElement('input');
            billItemQuantityInput.type = "number";
            billItemQuantityInput.className = "form-control bill_item_quantity";
            billItemQuantityInput.name = "bill_item_quantity[]";
            billItemQuantityInput.value = quantity;
            billItemQuantityInput.required = true;
            billItemQuantityInput.placeholder = "Enter quantity";

            billItemQuantityInput.onchange = (event) => {
                event.target.parentNode.querySelector('.bill_item_total').value = (event.target.parentNode
                    .querySelector('.bill_item_price').value * event.target.value).toFixed(2);
                handleCalculateBill();
            };

            let billItemPriceInput = document.createElement('input');
            billItemPriceInput.type = "number";
            billItemPriceInput.className = "form-control bill_item_price";
            billItemPriceInput.name = "bill_item_price[]";
            billItemPriceInput.value = price;
            billItemPriceInput.required = true;
            billItemPriceInput.placeholder = "Enter price";
            billItemPriceInput.setAttribute('step', 'any');

            billItemPriceInput.onchange = (event) => {
                event.target.parentNode.querySelector('.bill_item_total').value = (event.target.parentNode
                    .querySelector('.bill_item_quantity').value * event.target.value).toFixed(2);
                handleCalculateBill();
            };

            let billItemTotalInput = document.createElement('input');
            billItemTotalInput.type = "number";
            billItemTotalInput.className = "form-control bill_item_total";
            billItemTotalInput.name = "bill_item_total[]";
            billItemTotalInput.value = total;
            billItemTotalInput.required = true;
            billItemTotalInput.placeholder = "Total";
            billItemTotalInput.setAttribute('step', 'any');
            billItemTotalInput.setAttribute('readonly', true);

            let remove = document.createElement('button');
            remove.className = "btn btn-danger";
            remove.innerHTML = ' &times ';
            remove.type = "button";
            remove.onclick = (event) => {
                event.target.parentNode.remove();
                handleCalculateBill();
            }

            parentDiv.append(billItemNameInput, billItemQuantityInput, billItemPriceInput, billItemTotalInput, remove);
            document.getElementById('bill-items-inputs').appendChild(parentDiv);
        }
    </script>
@endsection
