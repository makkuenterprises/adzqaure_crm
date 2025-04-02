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
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_type_inr">Account Type</label>
                                            <select name="account_type_inr" id="account_type_inr" class="form-control">
                                                <option value="Current">Current</option>
                                                <option value="Saving">Saving</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_number_inr">Account Number</label>
                                            <input type="text" name="company_account_number_inr"
                                                id="company_account_number_inr" class="form-control"
                                                placeholder="Enter Account Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_holder_inr">Account Holder</label>
                                            <input type="text" name="company_account_holder_inr"
                                                id="company_account_holder_inr" class="form-control"
                                                placeholder="Enter Account Holder Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_ifsc_inr">Account IFSC</label>
                                            <input type="text" name="company_account_ifsc_inr"
                                                id="company_account_ifsc_inr" class="form-control"
                                                placeholder="Enter IFSC Code">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <!-- New UPI Payment Field -->
                                        <div class="form-group">
                                            <label for="upi_payment_inr">UPI Payment ID</label>
                                            <input type="text" name="upi_payment_inr" id="upi_payment_inr"
                                                class="form-control" placeholder="Enter UPI ID">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <!-- New Payment Link Field -->
                                        <div class="form-group">
                                            <label for="payment_link_inr">Payment Link</label>
                                            <input type="url" name="payment_link_inr" id="payment_link_inr"
                                                class="form-control" placeholder="Enter Payment Link">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="company_account_branch_inr">Account Branch</label>
                                            <input type="text" name="company_account_branch_inr"
                                                id="company_account_branch_inr" class="form-control"
                                                placeholder="Enter Branch Name">
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
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#usd_form"
                            aria-expanded="false" aria-controls="usd_form">
                            USD Payment Details
                        </button>
                    </h2>
                    <div id="usd_form" class="accordion-collapse collapse" aria-labelledby="usdHeading"
                        data-bs-parent="#paymentAccordion">
                        <div class="accordion-body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_holder_usd">Account Holder Name</label>
                                            <input type="text" name="company_account_holder_usd"
                                                id="company_account_holder_usd" class="form-control"
                                                placeholder="Enter Account Holder Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_method_usd">Payment Method</label>
                                            <select name="payment_method_usd" id="payment_method_usd"
                                                class="form-control">
                                                <option value="ACH">ACH</option>
                                                <option value="Wire Transfer">Wire Transfer</option>
                                                <option value="Cheque">Cheque</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ach_routing_number_usd">ACH Routing Number</label>
                                            <input type="text" name="ach_routing_number_usd"
                                                id="ach_routing_number_usd" class="form-control"
                                                placeholder="Enter ACH Routing Number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_number_usd">Account Number</label>
                                            <input type="text" name="company_account_number_usd"
                                                id="company_account_number_usd" class="form-control"
                                                placeholder="Enter Account Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bank_name_usd">Bank Name</label>
                                            <input type="text" name="bank_name_usd" id="bank_name_usd"
                                                class="form-control" placeholder="Enter Bank Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beneficiary_address_usd">Beneficiary Address</label>
                                            <input type="text" name="beneficiary_address_usd"
                                                id="beneficiary_address_usd" class="form-control"
                                                placeholder="Enter Beneficiary Address">
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
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_holder_aud">Account Holder Name</label>
                                            <input type="text" name="account_holder_aud" id="account_holder_aud"
                                                class="form-control" placeholder="Enter Account Holder Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_method_aud">Payment Method</label>
                                            <select name="payment_method_aud" id="payment_method_aud"
                                                class="form-control">
                                                <option value="Bank Transfer">Bank Transfer</option>
                                                <option value="Wire Transfer">Wire Transfer</option>
                                                <option value="Cheque">Cheque</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_account_number_aud">Account Number</label>
                                            <input type="text" name="company_account_number_aud"
                                                id="company_account_number_aud" class="form-control"
                                                placeholder="Enter Account Number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bsb_number_aud">BSB Number</label>
                                            <input type="text" name="bsb_number_aud" id="bsb_number_aud"
                                                class="form-control" placeholder="Enter BSB Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bank_name_aud">Bank Name</label>
                                            <input type="text" name="bank_name_aud" id="bank_name_aud"
                                                class="form-control" placeholder="Enter Bank Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beneficiary_address_aud">Beneficiary Address</label>
                                            <input type="text" name="beneficiary_address_aud"
                                                id="beneficiary_address_aud" class="form-control"
                                                placeholder="Enter Beneficiary Address">
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
