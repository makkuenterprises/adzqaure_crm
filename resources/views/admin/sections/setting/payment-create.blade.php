@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                                                                                                                                                                                                                                                                                                                                     Content body start
                                                                                                                                                                                                                                                                                                                                                 ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.setting') }}">Settings</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.payment-setting') }}">Payment Setting</a>
                    </li>
                </ol>
            </div>
            <!-- row -->

            <!-- Accordion to hold all forms -->
            <div class="accordion" id="paymentAccordion">

                <!-- INR Form Accordion Item -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="inrHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#inr_form"
                            aria-expanded="true" aria-controls="inr_form">
                            INR Payment Details
                        </button>
                    </h2>
                    <div id="inr_form" class="accordion-collapse collapse show" aria-labelledby="inrHeading"
                        data-bs-parent="#paymentAccordion">
                        <div class="accordion-body">
                            <form action="{{ route('admin.handle.payment.setting.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_type_inr" class="form-label">Account Type</label>
                                            <select name="account_type_inr" id="account_type_inr" class="form-control">
                                                <option value="Current"
                                                    {{ old('account_type_inr', $payment_settings->account_type_inr ?? '') == 'Current' ? 'selected' : '' }}>
                                                    Current
                                                </option>
                                                <option value="Saving"
                                                    {{ old('account_type_inr', $payment_settings->account_type_inr ?? '') == 'Saving' ? 'selected' : '' }}>
                                                    Saving
                                                </option>
                                            </select>
                                            @error('account_type_inr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_number_inr" class="form-label">Account
                                                Number</label>
                                            <input type="text" name="company_account_number_inr"
                                                id="company_account_number_inr"
                                                class="form-control @error('company_account_number_inr') is-invalid @enderror"
                                                placeholder="Enter Account Number"
                                                value="{{ old('company_account_number_inr', $payment_settings->company_account_number_inr ?? '') }}">
                                            @error('company_account_number_inr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company_account_holder_inr" class="form-label">Account
                                                Holder</label>
                                            <input type="text" name="company_account_holder_inr"
                                                id="company_account_holder_inr"
                                                class="form-control @error('company_account_holder_inr') is-invalid @enderror"
                                                placeholder="Enter Account Holder Name"
                                                value="{{ old('company_account_holder_inr', $payment_settings->company_account_holder_inr ?? '') }}">
                                            @error('company_account_holder_inr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company_account_ifsc_inr" class="form-label">Account IFSC</label>
                                            <input type="text" name="company_account_ifsc_inr"
                                                id="company_account_ifsc_inr"
                                                class="form-control @error('company_account_ifsc_inr') is-invalid @enderror"
                                                placeholder="Enter IFSC Code"
                                                value="{{ old('company_account_ifsc_inr', $payment_settings->company_account_ifsc_inr ?? '') }}">
                                            @error('company_account_ifsc_inr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="company_account_branch_inr" class="form-label">Account
                                                Branch</label>
                                            <input type="text" name="company_account_branch_inr"
                                                id="company_account_branch_inr"
                                                class="form-control @error('company_account_branch_inr') is-invalid @enderror"
                                                placeholder="Enter Branch Name"
                                                value="{{ old('company_account_branch_inr', $payment_settings->company_account_branch_inr ?? '') }}">
                                            @error('company_account_branch_inr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="upi_payment_inr" class="form-label">UPI Payment ID</label>
                                            <input type="text" name="upi_payment_inr" id="upi_payment_inr"
                                                class="form-control @error('upi_payment_inr') is-invalid @enderror"
                                                placeholder="Enter UPI ID"
                                                value="{{ old('upi_payment_inr', $payment_settings->upi_payment_inr ?? '') }}">
                                            @error('upi_payment_inr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="payment_link_inr" class="form-label">Payment Link</label>
                                            <input type="url" name="payment_link_inr" id="payment_link_inr"
                                                class="form-control @error('payment_link_inr') is-invalid @enderror"
                                                placeholder="Enter Payment Link"
                                                value="{{ old('payment_link_inr', $payment_settings->payment_link_inr ?? '') }}">
                                            @error('payment_link_inr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit INR</button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- USD Form Accordion Item -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="usdHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#usd_form" aria-expanded="false" aria-controls="usd_form">
                            USD Payment Details
                        </button>
                    </h2>
                    <div id="usd_form" class="accordion-collapse collapse" aria-labelledby="usdHeading"
                        data-bs-parent="#paymentAccordion">
                        <div class="accordion-body">
                            <form action="{{ route('admin.handle.payment.setting.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_holder_usd" class="form-label">Account Holder
                                                Name</label>
                                            <input type="text" name="company_account_holder_usd"
                                                id="company_account_holder_usd"
                                                class="form-control @error('company_account_holder_usd') is-invalid @enderror"
                                                placeholder="Enter Account Holder Name"
                                                value="{{ old('company_account_holder_usd', $payment_settings->company_account_holder_usd ?? '') }}">
                                            @error('company_account_holder_usd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_method_usd" class="form-label">Payment Method</label>
                                            <select name="payment_method_usd" id="payment_method_usd"
                                                class="form-control @error('payment_method_usd') is-invalid @enderror">
                                                <option value="ACH"
                                                    {{ old('payment_method_usd', $payment_settings->payment_method_usd ?? '') == 'ACH' ? 'selected' : '' }}>
                                                    ACH</option>
                                                <option value="Wire Transfer"
                                                    {{ old('payment_method_usd', $payment_settings->payment_method_usd ?? '') == 'Wire Transfer' ? 'selected' : '' }}>
                                                    Wire Transfer</option>
                                                <option value="Cheque"
                                                    {{ old('payment_method_usd', $payment_settings->payment_method_usd ?? '') == 'Cheque' ? 'selected' : '' }}>
                                                    Cheque</option>
                                            </select>
                                            @error('payment_method_usd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ach_routing_number_usd" class="form-label">ACH Routing
                                                Number</label>
                                            <input type="text" name="ach_routing_number_usd"
                                                id="ach_routing_number_usd"
                                                class="form-control @error('ach_routing_number_usd') is-invalid @enderror"
                                                placeholder="Enter ACH Routing Number"
                                                value="{{ old('ach_routing_number_usd', $payment_settings->ach_routing_number_usd ?? '') }}">
                                            @error('ach_routing_number_usd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_number_usd" class="form-label">Account
                                                Number</label>
                                            <input type="text" name="company_account_number_usd"
                                                id="company_account_number_usd"
                                                class="form-control @error('company_account_number_usd') is-invalid @enderror"
                                                placeholder="Enter Account Number"
                                                value="{{ old('company_account_number_usd', $payment_settings->company_account_number_usd ?? '') }}">
                                            @error('company_account_number_usd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bank_name_usd" class="form-label">Bank Name</label>
                                            <input type="text" name="bank_name_usd" id="bank_name_usd"
                                                class="form-control @error('bank_name_usd') is-invalid @enderror"
                                                placeholder="Enter Bank Name"
                                                value="{{ old('bank_name_usd', $payment_settings->bank_name_usd ?? '') }}">
                                            @error('bank_name_usd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beneficiary_address_usd" class="form-label">Beneficiary
                                                Address</label>
                                            <input type="text" name="beneficiary_address_usd"
                                                id="beneficiary_address_usd"
                                                class="form-control @error('beneficiary_address_usd') is-invalid @enderror"
                                                placeholder="Enter Beneficiary Address"
                                                value="{{ old('beneficiary_address_usd', $payment_settings->beneficiary_address_usd ?? '') }}">
                                            @error('beneficiary_address_usd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Submit USD</button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- AUD Form Accordion Item -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="audHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#aud_form" aria-expanded="false" aria-controls="aud_form">
                            AUD Payment Details
                        </button>
                    </h2>
                    <div id="aud_form" class="accordion-collapse collapse" aria-labelledby="audHeading"
                        data-bs-parent="#paymentAccordion">
                        <div class="accordion-body">
                            <form action="{{ route('admin.handle.payment.setting.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_holder_aud" class="form-label">Account Holder Name</label>
                                            <input type="text" name="account_holder_aud" id="account_holder_aud"
                                                class="form-control @error('account_holder_aud') is-invalid @enderror"
                                                placeholder="Enter Account Holder Name"
                                                value="{{ old('account_holder_aud', $payment_settings->account_holder_aud ?? '') }}">
                                            @error('account_holder_aud')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_method_aud" class="form-label">Payment Method</label>
                                            <select name="payment_method_aud" id="payment_method_aud"
                                                class="form-control @error('payment_method_aud') is-invalid @enderror">
                                                <option value="Bank Transfer"
                                                    {{ old('payment_method_aud', $payment_settings->payment_method_aud ?? '') == 'Bank Transfer' ? 'selected' : '' }}>
                                                    Bank Transfer</option>
                                                <option value="Wire Transfer"
                                                    {{ old('payment_method_aud', $payment_settings->payment_method_aud ?? '') == 'Wire Transfer' ? 'selected' : '' }}>
                                                    Wire Transfer</option>
                                                <option value="Cheque"
                                                    {{ old('payment_method_aud', $payment_settings->payment_method_aud ?? '') == 'Cheque' ? 'selected' : '' }}>
                                                    Cheque</option>
                                            </select>
                                            @error('payment_method_aud')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_number_aud" class="form-label">Account
                                                Number</label>
                                            <input type="text" name="company_account_number_aud"
                                                id="company_account_number_aud"
                                                class="form-control @error('company_account_number_aud') is-invalid @enderror"
                                                placeholder="Enter Account Number"
                                                value="{{ old('company_account_number_aud', $payment_settings->company_account_number_aud ?? '') }}">
                                            @error('company_account_number_aud')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bsb_number_aud" class="form-label">BSB Number</label>
                                            <input type="text" name="bsb_number_aud" id="bsb_number_aud"
                                                class="form-control @error('bsb_number_aud') is-invalid @enderror"
                                                placeholder="Enter BSB Number"
                                                value="{{ old('bsb_number_aud', $payment_settings->bsb_number_aud ?? '') }}">
                                            @error('bsb_number_aud')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bank_name_aud" class="form-label">Bank Name</label>
                                            <input type="text" name="bank_name_aud" id="bank_name_aud"
                                                class="form-control @error('bank_name_aud') is-invalid @enderror"
                                                placeholder="Enter Bank Name"
                                                value="{{ old('bank_name_aud', $payment_settings->bank_name_aud ?? '') }}">
                                            @error('bank_name_aud')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beneficiary_address_aud" class="form-label">Beneficiary
                                                Address</label>
                                            <input type="text" name="beneficiary_address_aud"
                                                id="beneficiary_address_aud"
                                                class="form-control @error('beneficiary_address_aud') is-invalid @enderror"
                                                placeholder="Enter Beneficiary Address"
                                                value="{{ old('beneficiary_address_aud', $payment_settings->beneficiary_address_aud ?? '') }}">
                                            @error('beneficiary_address_aud')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Submit AUD</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div> <!-- End of Accordion -->

        </div>
    </div>
    <!--**********************************
                                                                                                                                                                                                                                                                                                                                                                  Content body end
                                                                                                                                                                                                                                                                                                                                                                    ***********************************-->
@endsection


@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check if there is a validation error in INR form
            if (document.querySelector('.is-invalid') && document.querySelector('#inr_form')) {
                const inrAccordion = new bootstrap.Collapse(document.getElementById('inr_form'), {
                    toggle: true
                });
            }

            // Check if there is a validation error in USD form
            if (document.querySelector('.is-invalid') && document.querySelector('#usd_form')) {
                const usdAccordion = new bootstrap.Collapse(document.getElementById('usd_form'), {
                    toggle: true
                });
            }

            // Check if there is a validation error in USD form
            if (document.querySelector('.is-invalid') && document.querySelector('#aud_form')) {
                const usdAccordion = new bootstrap.Collapse(document.getElementById('aud_form'), {
                    toggle: true
                });
            }
        });
    </script>
@endsection
