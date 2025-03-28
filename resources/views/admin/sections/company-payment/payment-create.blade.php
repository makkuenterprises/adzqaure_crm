@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Company Payment Method</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="#">Payment Method</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    {{-- <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Select Payment Method</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">
                    <!-- Currency Selection -->
                    <div class="flex flex-col">
                        <label for="currency_type" class="input-label">Currency Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="inr_checkbox" class="currency_checkbox" name="currency_type[]"
                                    value="INR">
                                <label for="inr_checkbox" class="ml-2">INR</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="usd_checkbox" class="currency_checkbox" name="currency_type[]"
                                    value="USD">
                                <label for="usd_checkbox" class="ml-2">USD</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="aud_checkbox" class="currency_checkbox" name="currency_type[]"
                                    value="AUD">
                                <label for="aud_checkbox" class="ml-2">AUD</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INR Fields -->
                <div id="inr_fields" class="currency_fields" style="display: none; margin-top:40px;">
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">
                        <div class="flex flex-col">
                            <label for="account_type_inr" class="input-label">Account Type</label>
                            <select name="account_type_inr" class="input-box-md">
                                <option value="Current">Current</option>
                                <option value="Saving">Saving</option>
                            </select>
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_number_inr" class="input-label">Company Account Number</label>
                            <input type="text" name="company_account_number_inr" class="input-box-md">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_holder_inr" class="input-label">Company Account Holder</label>
                            <input type="text" name="company_account_holder_inr" class="input-box-md">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_ifsc_inr" class="input-label">Company Account IFSC</label>
                            <input type="text" name="company_account_ifsc_inr" class="input-box-md">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_branch_inr" class="input-label">Company Account Branch</label>
                            <input type="text" name="company_account_branch_inr" class="input-box-md">
                        </div>
                    </div>
                </div>

                <!-- USD Fields -->
                <div id="usd_fields" class="currency_fields" style="display: none; margin-top:40px;">
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">

                        <div class="flex flex-col">
                            <label for="company_account_holder_usd" class="input-label">Account Holder Name</label>
                            <input type="text" name="company_account_holder_usd" class="input-box-md"
                                value="MAKKU ENTERPRISES PRIVATE LIMITED">
                        </div>
                        <!-- Payment Method -->
                        <div class="flex flex-col">
                            <label for="payment_method_usd" class="input-label">Payment Method</label>
                            <select name="payment_method_usd" class="input-box-md">
                                <option value="ACH">ACH</option>
                                <option value="Wire Transfer">Wire Transfer</option>
                                <option value="Cheque">Cheque</option>
                                <!-- Add more payment methods as needed -->
                            </select>
                        </div>

                        <!-- ACH Routing Number -->
                        <div class="flex flex-col">
                            <label for="ach_routing_number_usd" class="input-label">ACH Routing Number</label>
                            <input type="text" name="ach_routing_number_usd" class="input-box-md" value="">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_number_usd" class="input-label"> Account Number</label>
                            <input type="text" name="company_account_number_usd" class="input-box-md"
                                value="8334319253">
                        </div>
                        <!-- Bank Name -->
                        <div class="flex flex-col">
                            <label for="bank_name_usd" class="input-label">Bank Name</label>
                            <input type="text" name="bank_name_usd" class="input-box-md"
                                value="Community Federal Savings Bank">
                        </div>




                        <div class="flex flex-col">
                            <label for="beneficiary_address_usd" class="input-label">Beneficiary Address</label>
                            <input type="text" name="beneficiary_address_usd" class="input-box-md"
                                value="5 Penn Plaza, 14th Floor, New York, NY 10001, US">
                        </div>
                    </div>
                </div>


                <!-- AUD Fields -->
                <div id="aud_fields" class="currency_fields" style="display: none; margin-top:40px;">
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">



                        <!-- Account Holder -->
                        <div class="flex flex-col">
                            <label for="account_holder_aud" class="input-label">Account Holder Name</label>
                            <input type="text" name="account_holder_aud" class="input-box-md"
                                value="MAKKU ENTERPRISES PRIVATE LIMITED">
                        </div>

                        <!-- Payment Method -->
                        <div class="flex flex-col">
                            <label for="payment_method_aud" class="input-label">Payment Method</label>
                            <select name="payment_method_aud" class="input-box-md">
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Wire Transfer">Wire Transfer</option>
                                <option value="Cheque">Cheque</option>
                                <!-- Add more payment methods as needed -->
                            </select>
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_number_usd" class="input-label"> Account Number</label>
                            <input type="text" name="company_account_number_usd" class="input-box-md"
                                value="8334319253">
                        </div>

                        <!-- BSB Number -->
                        <div class="flex flex-col">
                            <label for="bsb_number_aud" class="input-label">BSB Number</label>
                            <input type="text" name="bsb_number_aud" class="input-box-md" value="252000">
                        </div>

                        <!-- Bank Name -->
                        <div class="flex flex-col">
                            <label for="bank_name_aud" class="input-label">Bank Name</label>
                            <input type="text" name="bank_name_aud" class="input-box-md" value="BC Payments">
                        </div>


                        <!-- Beneficiary Address -->
                        <div class="flex flex-col">
                            <label for="beneficiary_address_aud" class="input-label">Beneficiary Address</label>
                            <input type="text" name="beneficiary_address_aud" class="input-box-md"
                                value="Level 11/10 Carrington St, Sydney NSW 2000, Australia">
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Submit</button>
            </div>
        </figure>
    </form> --}}

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Select Payment Method</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">
                    <!-- Currency Selection -->
                    <div class="flex flex-col">
                        <label for="currency_type" class="input-label">Currency Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="inr_checkbox" class="currency_checkbox" name="currency_type[]"
                                    value="INR">
                                <label for="inr_checkbox" class="ml-2">INR</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="usd_checkbox" class="currency_checkbox" name="currency_type[]"
                                    value="USD">
                                <label for="usd_checkbox" class="ml-2">USD</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="aud_checkbox" class="currency_checkbox" name="currency_type[]"
                                    value="AUD">
                                <label for="aud_checkbox" class="ml-2">AUD</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INR Fields -->
                <div id="inr_fields" class="currency_fields" style="display: none; margin-top:40px;">
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">
                        <div class="flex flex-col">
                            <label for="account_type_inr" class="input-label">Account Type</label>
                            <select name="account_type_inr" class="input-box-md">
                                <option value="Current">Current</option>
                                <option value="Saving">Saving</option>
                            </select>
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_number_inr" class="input-label">Company Account Number</label>
                            <input type="text" name="company_account_number_inr" class="input-box-md">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_holder_inr" class="input-label">Company Account Holder</label>
                            <input type="text" name="company_account_holder_inr" class="input-box-md">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_ifsc_inr" class="input-label">Company Account IFSC</label>
                            <input type="text" name="company_account_ifsc_inr" class="input-box-md">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_branch_inr" class="input-label">Company Account Branch</label>
                            <input type="text" name="company_account_branch_inr" class="input-box-md">
                        </div>
                    </div>
                </div>

                <!-- USD Fields -->
                <div id="usd_fields" class="currency_fields" style="display: none; margin-top:40px;">
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">

                        <div class="flex flex-col">
                            <label for="company_account_holder_usd" class="input-label">Account Holder Name</label>
                            <input type="text" name="company_account_holder_usd" class="input-box-md"
                                value="MAKKU ENTERPRISES PRIVATE LIMITED">
                        </div>

                        <!-- Payment Method -->
                        <div class="flex flex-col">
                            <label for="payment_method_usd" class="input-label">Payment Method</label>
                            <select name="payment_method_usd" class="input-box-md">
                                <option value="ACH">ACH</option>
                                <option value="Wire Transfer">Wire Transfer</option>
                                <option value="Cheque">Cheque</option>
                                <!-- Add more payment methods as needed -->
                            </select>
                        </div>

                        <!-- ACH Routing Number -->
                        <div class="flex flex-col">
                            <label for="ach_routing_number_usd" class="input-label">ACH Routing Number</label>
                            <input type="text" name="ach_routing_number_usd" class="input-box-md" value="">
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_number_usd" class="input-label"> Account Number</label>
                            <input type="text" name="company_account_number_usd" class="input-box-md"
                                value="8334319253">
                        </div>

                        <!-- Bank Name -->
                        <div class="flex flex-col">
                            <label for="bank_name_usd" class="input-label">Bank Name</label>
                            <input type="text" name="bank_name_usd" class="input-box-md"
                                value="Community Federal Savings Bank">
                        </div>

                        <div class="flex flex-col">
                            <label for="beneficiary_address_usd" class="input-label">Beneficiary Address</label>
                            <input type="text" name="beneficiary_address_usd" class="input-box-md"
                                value="5 Penn Plaza, 14th Floor, New York, NY 10001, US">
                        </div>
                    </div>
                </div>

                <!-- AUD Fields -->
                <div id="aud_fields" class="currency_fields" style="display: none; margin-top:40px;">
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-7 sm:gap-5">
                        <!-- Account Holder -->
                        <div class="flex flex-col">
                            <label for="account_holder_aud" class="input-label">Account Holder Name</label>
                            <input type="text" name="account_holder_aud" class="input-box-md"
                                value="MAKKU ENTERPRISES PRIVATE LIMITED">
                        </div>

                        <!-- Payment Method -->
                        <div class="flex flex-col">
                            <label for="payment_method_aud" class="input-label">Payment Method</label>
                            <select name="payment_method_aud" class="input-box-md">
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Wire Transfer">Wire Transfer</option>
                                <option value="Cheque">Cheque</option>
                                <!-- Add more payment methods as needed -->
                            </select>
                        </div>

                        <div class="flex flex-col">
                            <label for="company_account_number_usd" class="input-label"> Account Number</label>
                            <input type="text" name="company_account_number_usd" class="input-box-md"
                                value="8334319253">
                        </div>

                        <!-- BSB Number -->
                        <div class="flex flex-col">
                            <label for="bsb_number_aud" class="input-label">BSB Number</label>
                            <input type="text" name="bsb_number_aud" class="input-box-md" value="252000">
                        </div>

                        <!-- Bank Name -->
                        <div class="flex flex-col">
                            <label for="bank_name_aud" class="input-label">Bank Name</label>
                            <input type="text" name="bank_name_aud" class="input-box-md" value="BC Payments">
                        </div>

                        <!-- Beneficiary Address -->
                        <div class="flex flex-col">
                            <label for="beneficiary_address_aud" class="input-label">Beneficiary Address</label>
                            <input type="text" name="beneficiary_address_aud" class="input-box-md"
                                value="Level 11/10 Carrington St, Sydney NSW 2000, Australia">
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Submit</button>
            </div>
        </figure>
    </form>


    <script>
        // Show/Hide Fields Based on Checkbox Selection
        const checkboxes = document.querySelectorAll('.currency_checkbox');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (event) => {
                const selectedCurrency = event.target.value;

                // Hide all currency fields initially
                document.querySelectorAll('.currency_fields').forEach(field => {
                    field.style.display = 'none';
                });

                // Show selected currency fields
                if (selectedCurrency === 'INR' && event.target.checked) {
                    document.getElementById('inr_fields').style.display = 'block';
                } else if (selectedCurrency === 'USD' && event.target.checked) {
                    document.getElementById('usd_fields').style.display = 'block';
                } else if (selectedCurrency === 'AUD' && event.target.checked) {
                    document.getElementById('aud_fields').style.display = 'block';
                }
            });
        });
    </script>
@endsection
