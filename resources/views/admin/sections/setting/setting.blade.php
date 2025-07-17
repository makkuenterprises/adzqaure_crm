@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                            Content body start
                                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Management</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
                </ol>
            </div>

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row"> <!-- Added row wrapper -->
                        <div class="col-xl-4 col-lg-12 col-sm-12">
                            <div class="card overflow-hidden">
                                <div class="text-center p-5 overlay-box"
                                    style="background-image: url(images/big/img5.jpg);">
                                    <img src="{{ is_null(auth()->user()->profile) || auth()->user()->profile == '' ? asset('admin/profile/default-profile.png') : asset('admin/profile/' . auth()->user()->profile) }}"
                                        width="100" class="img-fluid rounded-circle" alt="profile image">
                                    <h3 class="mt-3 mb-0 text-white">{{ auth()->user()->name }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="bgl-primary rounded p-3">
                                                <h4 class="mb-0">Account Info</h4>
                                                <small>Manage your account information</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer mt-0">
                                    <a href="{{ route('admin.view.account.setting') }}"
                                        class="btn btn-primary btn-block btn-loader">Edit Infomation</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-sm-12">
                            <div class="card overflow-hidden">
                                <div class="text-center p-5 overlay-box"
                                    style="background-image: url(images/big/img5.jpg);">
                                    <img src="{{ asset('admin/images/setting-company-details.png') }}" width="100"
                                        class="img-fluid rounded-circle" alt="">
                                    <h3 class="mt-3 mb-0 text-white">Company</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="bgl-primary rounded p-3">
                                                <h4 class="mb-0">Company Info</h4>
                                                <small>Manage your company information</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer mt-0">
                                    <a href="{{ route('admin.view.company.details.setting') }}"
                                        class="btn btn-primary btn-block btn-loader">Edit Infomation</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-sm-12">
                            <div class="card overflow-hidden">
                                <div class="text-center p-5 overlay-box"
                                    style="background-image: url(images/big/img5.jpg);">
                                    <img src="{{ asset('admin/images/setting-mail-credentials.png') }}" width="100"
                                        class="img-fluid rounded-circle" alt="">
                                    <h3 class="mt-3 mb-0 text-white">Mail Settings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="bgl-primary rounded p-3">
                                                <h4 class="mb-0">Mail Credentials</h4>
                                                <small>Manage & Setup your mail credentials</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer mt-0">
                                    <a href="{{ route('admin.view.mail.credentials.setting') }}"
                                        class="btn btn-primary btn-block btn-loader">Edit Infomation</a>
                                </div>
                            </div>
                        </div>

                        {{-- crm settings --}}
                        <div class="col-xl-4 col-lg-12 col-sm-12">
                            <div class="card overflow-hidden">
                                <div class="text-center p-5 overlay-box"
                                    style="background-image: url(images/big/img5.jpg);">
                                    <img src="{{ asset('admin/images/setting-crm.png') }}" width="100"
                                        class="img-fluid rounded-circle" alt="">
                                    <h3 class="mt-3 mb-0 text-white">CRM Settings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="bgl-primary rounded p-3">
                                                <h4 class="mb-0">CRM Settings</h4>
                                                <small>Manage & Setup your crm settings</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer mt-0">
                                    <a href="{{ route('admin.view.crm.setting') }}" class="btn btn-primary btn-block btn-loader">Edit
                                        Infomation</a>
                                </div>
                            </div>
                        </div>
                        {{-- Payment Method settings --}}
                        <div class="col-xl-4 col-lg-12 col-sm-12">
                            <div class="card overflow-hidden">
                                <div class="text-center p-5 overlay-box"
                                    style="background-image: url(images/big/img5.jpg);">
                                    <img src="{{ asset('admin/images/payment-method.png') }}" width="100"
                                        class="img-fluid rounded-circle" alt="">
                                    <h3 class="mt-3 mb-0 text-white">Payment Settings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="bgl-primary rounded p-3">
                                                <h4 class="mb-0">Payment Method</h4>
                                                <small>Manage & Setup your Payments</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer mt-0">
                                    <a href="{{ route('admin.view.payment-setting') }}"
                                        class="btn btn-primary btn-block btn-loader">Edit Infomation</a>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End of row wrapper -->
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                                            Content body end
                                    ***********************************-->
@endsection
