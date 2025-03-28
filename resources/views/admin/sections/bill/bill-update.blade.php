@extends('admin.layouts.app')
@section('css')
    <style>
        /* Style for the required field marker */
        .input-label span.text-red-500 {
            color: red;
            font-weight: bold;
        }

        .input-invalid {
            border-color: red;
        }

        /* Style for error messages */
        .input-error {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
@endsection
@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Bill</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.bill.list') }}">Billing</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.bill.update', ['id' => $bill->id]) }}">Edit Bill</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.bill.update', ['id' => $bill->id]) }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Customer --}}
                    <div class="flex flex-col">
                        <label for="customer_id" class="input-label">Customer <span class="text-red-500">*</span></label>
                        <select class="input-box-md" name="customer_id" required>
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option @selected($bill->customer_id == $customer->id) value="{{ $customer->id }}">{{ $customer->name }}
                                    ({{ $customer->company_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Bill date --}}
                    <div class="flex flex-col">
                        <label for="bill_date" class="input-label">Bill date <span class="text-red-500">*</span></label>
                        <input type="date" name="bill_date" value="{{ old('bill_date', $bill->bill_date) }}"
                            class="input-box-md @error('bill_date') input-invalid @enderror" required>
                        @error('bill_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Due date --}}
                    <div class="flex flex-col">
                        <label for="due_date" class="input-label">Due date</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $bill->due_date) }}"
                            class="input-box-md @error('due_date') input-invalid @enderror">
                        @error('due_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Invoice Currency --}}
                    <div class="flex flex-col">
                        <label for="invoice_currency" class="input-label">Invoice Currency <span
                                class="text-red-500">*</span></label>
                        <select name="invoice_currency" class="input-box-md" required>
                            <option value="INR" @selected(old('invoice_currency', $bill->invoice_currency) == 'INR')>Indian Rupees (INR)</option>
                            <option value="USD" @selected(old('invoice_currency', $bill->invoice_currency) == 'USD')>US Dollars (USD)</option>
                            <option value="AUD" @selected(old('invoice_currency', $bill->invoice_currency) == 'AUD')>Australian Dollars (AUD)</option>
                        </select>
                        @error('invoice_currency')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Bill Items --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="bill_items" class="input-label">Bill Items</label>
                        <div class="space-y-2">
                            <div class="space-y-2" id="bill-items-inputs">

                            </div>
                            <button type="button" onclick="handleCreateBillItem(null,null,null,null)"
                                class="btn-secondary-md">Add Item</button>
                        </div>
                        @error('bill_items')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Apply GST --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex items-center">
                            <input type="checkbox" onchange="handleCalculateBill()" id="apply_gst"
                                @checked(old('apply_gst', is_null($bill->tax) ? false : true)) name="apply_gst" value="1" id="apply_gst"
                                class="cursor-pointer">
                            <label for="apply_gst"
                                class="text-xs text-slate-700 select-none font-medium cursor-pointer">Apply Tax (GST) in
                                this bill</label>
                        </div>
                    </div>

                    {{-- Tax --}}
                    <div class="flex flex-col">
                        <label for="tax" class="input-label">Tax (GST)</label>
                        <input type="number" step="any" value="{{ is_null($bill->tax) ? '0.00' : $bill->tax }}"
                            id="tax" name="tax" class="input-box-md @error('tax') input-invalid @enderror"
                            placeholder="Enter tax" readonly>
                        @error('tax')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Total --}}
                    <div class="flex flex-col">
                        <label for="total" class="input-label">Total</label>
                        <input type="number" step="any" id="total" name="total" value="{{ $bill->total }}"
                            class="input-box-md @error('total') input-invalid @enderror" placeholder="Enter total" readonly>
                        @error('total')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Payment Status --}}
                    <div class="flex flex-col">
                        <label for="payment_status" class="input-label">Payment Status <span
                                class="text-red-500">*</span></label>
                        <select class="input-box-md" name="payment_status" required>
                            <option value="">Select Payment Status</option>
                            <option @selected($bill->payment_status == 'Paid') value="Paid">Paid</option>
                            <option @selected($bill->payment_status == 'Pending') value="Pending">Pending</option>
                        </select>
                        @error('payment_status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Bill Note --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="bill_note" class="input-label">Bill Note</label>
                        <textarea name="bill_note" rows="5" class="input-box-md @error('bill_note') input-invalid @enderror"
                            placeholder="Enter bill note" minlength="1" maxlength="1000">{{ old('bill_note', $bill->bill_note) }}</textarea>
                        @error('bill_note')
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
        // document.getElementById('bill-tab').classList.add('active');

        const handleCalculateBill = () => {

            let total = 0
            let itemTotal = 0;

            document.querySelectorAll('.bill_item_total').forEach((element) => {
                itemTotal += parseInt(element.value)
            });

            total += itemTotal;

            if (document.getElementById('apply_gst').checked) {
                let taxPercentage = parseInt("{{ DB::table('company_details')->first()->billing_tax_percentage }}");

                let tax = (total * taxPercentage) / 100;
                total += tax;
                document.getElementById('tax').value = tax.toFixed(2);
            } else {
                let tax = 0;
                document.getElementById('tax').value = tax.toFixed(2);
            }

            document.getElementById('total').value = total.toFixed(2);
        }

        const handleCreateBillItem = (name, quantity, price, total) => {

            let parentDiv = document.createElement('div');
            parentDiv.className = "flex space-x-2";

            let billItemNameInput = document.createElement('input');
            billItemNameInput.type = "text";
            billItemNameInput.className = "input-box-md w-full bill_item_name";
            billItemNameInput.name = "bill_item_name[]";
            billItemNameInput.value = name;
            billItemNameInput.required = true;
            billItemNameInput.placeholder = "Enter item nane";

            let billItemQuantityInput = document.createElement('input');
            billItemQuantityInput.type = "number";
            billItemQuantityInput.className = "input-box-md w-full bill_item_quantity";
            billItemQuantityInput.name = "bill_item_quantity[]";
            billItemQuantityInput.value = quantity;
            billItemQuantityInput.required = true;
            billItemQuantityInput.placeholder = "Enter item quantity";

            billItemQuantityInput.onchange = (event) => {
                event.target.parentNode.querySelector('.bill_item_total').value = (event.target.parentNode
                    .querySelector('.bill_item_price').value * event.target.value).toFixed(2);
                handleCalculateBill();
            };

            let billItemPriceInput = document.createElement('input');
            billItemPriceInput.type = "number";
            billItemPriceInput.className = "input-box-md w-full bill_item_price";
            billItemPriceInput.name = "bill_item_price[]";
            billItemPriceInput.value = price;
            billItemPriceInput.required = true;
            billItemPriceInput.placeholder = "Enter item price";
            billItemPriceInput.setAttribute('step', 'any');

            billItemPriceInput.onchange = (event) => {
                event.target.parentNode.querySelector('.bill_item_total').value = (event.target.parentNode
                    .querySelector('.bill_item_quantity').value * event.target.value).toFixed(2);
                handleCalculateBill();
            };

            let billItemTotalInput = document.createElement('input');
            billItemTotalInput.type = "number";
            billItemTotalInput.className = "input-box-md w-full bill_item_total";
            billItemTotalInput.name = "bill_item_total[]";
            billItemTotalInput.value = total;
            billItemTotalInput.required = true;
            billItemTotalInput.placeholder = "Total";
            billItemTotalInput.setAttribute('step', 'any');
            billItemTotalInput.setAttribute('readonly', true);

            let remove = document.createElement('button');
            remove.className = "btn-danger-md";
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

    @if (!is_null($bill->items))
        <script defer>
            @foreach (json_decode($bill->items) as $item)
                handleCreateBillItem('{{ $item->bill_item_name }}', {{ $item->bill_item_quantity }},
                    {{ $item->bill_item_price }}, {{ $item->bill_item_total }});
            @endforeach
        </script>
    @endif
@endsection
