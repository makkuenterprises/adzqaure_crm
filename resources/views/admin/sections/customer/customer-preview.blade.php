@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                                                                                                        Content body start
                                                                                                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.customer.list') }}">Customers</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.customer.preview', ['id' => $customer->id]) }}">Preview Customer</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card contact-bx item-content">
                                <div class="card-header border-0">
                                    <div class="action-dropdown">
                                        <div class="dropdown ">
                                            <div class="btn-link" data-bs-toggle="dropdown">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                                    <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                                    <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:handleDelete({{ $customer->id }});">Delete</a>
                                                <a class="dropdown-item" href="{{ route('admin.view.customer.update', ['id' => $customer->id]) }}">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body user-profile">
                                    <div class="image-bx">
                                        <img src="{{ is_null($customer->profile) ? asset('admin/profile/default-profile.png') : asset('admin/profile/'.$customer->profile) }}" data-src="images/contacts/Untitled-3.jpg" alt="" class="rounded-circle">
                                        <span class="active"></span>
                                    </div>
                                    <div class="media-body user-meta-info">
                                        <h5 class="mb-0"><a class="text-black user-name" data-name="Alan Green">{{$customer->name}}</a></h5>
                                        <p class=" mb-3" data-occupation="UI Designer">{{$customer->company_name}}</p>
                                        <ul>
                                            <li><a href="tel: {{$customer->phone}}"><i class="fas fa-phone-alt"></i></a></li>
                                            <li><a href="mailto: {{$customer->email}}"><i class="fa-regular fa-envelope"></i></a></li>
                                            @if (!is_null($customer->whatsapp))
                                                <li><a target="_blank" href="https://wa.me/{{$customer->whatsapp}}"><i class="fa-brands fa-whatsapp"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="row"> <!-- Add this row to align items in a row -->
                                <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
                                    <div class="card text-white bg-primary">
                                        <a class="m-3 text-white">Additional Info</a>
                                        <ul class="list-group list-group-flush">
                                            @if (!is_null($customer->phone_alternate))
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Alt Phone</span><strong class="text-white"><a class="text-white" href="tel: {{$customer->phone_alternate}}">{{$customer->phone_alternate}}</a></strong></li>
                                            @endif
                                            @if (!is_null($customer->whatsapp))
                                            <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">WhatsApp Phone</span><strong class="text-white"><a class="text-white" target="_blank" href="https://wa.me/{{$customer->whatsapp}}">{{$customer->whatsapp}}</a></strong></li>
                                            @endif
                                            @if (!is_null($customer->street) || !is_null($customer->city) || !is_null($customer->state) || !is_null($customer->country))
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Street</span><strong class="text-white">{{$customer->street}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">City</span><strong class="text-white">{{$customer->city}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Pincode</span><strong class="text-white">{{$customer->pincode}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">State</span><strong class="text-white">{{$customer->state}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Country</span><strong class="text-white">{{$customer->country}}</strong></li>
                                            @endif
                                            @if ( is_null($customer->phone_alternate) && is_null($customer->whatsapp) && is_null($customer->street) && is_null($customer->city) && is_null($customer->state) && is_null($customer->country))
                                              <li class="list-group-item d-flex justify-content-between text-white">No Additional Data Available</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
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
        function handleDelete(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this customer!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/customer/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection

