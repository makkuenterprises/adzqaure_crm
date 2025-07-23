@extends('employee.layouts.app')

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
                                    <a href="{{ route('employee.view.account.setting') }}"
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
