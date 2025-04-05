@extends('admin.layouts.app')

@section('css')
    <style>
        .password-div input[type="password"]:focus {
            outline: none;
            box-shadow: none;
        }

        .password-div input[type="password"] {
            border: 1px solid #ccc;
        }

        /* Center the items in the row */
        .form-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-inline .form-group {
            margin-right: 20px;
        }

        .form-inline select {
            width: auto;
            max-width: 250px;
        }

        .btn-add {
            margin-left: auto;
        }
    </style>
@endsection

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Password</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Password</a></li>
                </ol>
            </div>

            <!-- Row -->
            <div class="row">
                <div class="col-lg-3 mt-4">
                    <a href="{{ route('admin.view.password.create') }}" class="btn btn-sm btn-primary">Add
                        Password</a>
                </div>
                <div class="col-lg-6">
                    <form method="GET" action="{{ route('admin.view.password.list') }}"
                        class="d-flex align-items-center justify-content-between">
                        <div class="form-group w-100 mb-0">
                            <label for="customer_id"> <strong>Select Customer : </strong></label>
                            <select name="customer_id" id="customer_id" class="form-control w-100"
                                onchange="this.form.submit()">
                                <option value="">-- Select Customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>

            </div>



            <div class="filter cm-content-box box-primary mt-3">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-solid fa-file-lines me-1"></i>Password List
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt">
                    <div class="card-body pb-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Customer Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($passwords as $index => $password)
                                        <tr>
                                            <td>{{ $passwords->firstItem() + $index }}</td>
                                            <td>{{ DB::table('customers')->find($password->customer_id)?->name }}
                                            </td>
                                            <td>{{ $password->username }}</td>
                                            <td>{{ $password->email }}</td>
                                            <td>
                                                <div class="flex items-center justify-start password-div">
                                                    <input type="password"
                                                        class="text-sm font-medium text-slate-900 p-0 w-fit outline-none"
                                                        value="{{ $password->password }}" readonly>
                                                    <i class="fa fa-eye" onclick="handleTogglePassword(event)"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex items-center justify-start w-fit space-x-2">
                                                    <span>
                                                        @switch($password->type)
                                                            @case('Facebook')
                                                                <i class="fab fa-facebook-square fa-lg"></i>
                                                            @break

                                                            @case('Twitter')
                                                                <i class="fab fa-twitter fa-lg"></i>
                                                            @break

                                                            @case('Instagram')
                                                                <i class="fab fa-instagram fa-lg"></i>
                                                            @break

                                                            @case('Linkedin')
                                                                <i class="fab fa-linkedin fa-lg"></i>
                                                            @break

                                                            @case('Google')
                                                                <i class="fab fa-google fa-lg"></i>
                                                            @break

                                                            @case('Microsoft')
                                                                <i class="fab fa-microsoft fa-lg"></i>
                                                            @break
                                                        @endswitch
                                                    </span>
                                                    <span>{{ $password->type }}</span>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('admin.view.password.update', ['id' => $password->id]) }}"
                                                    class="btn btn-warning btn-sm content-icon">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:handleDelete({{ $password->id }});"
                                                    class="btn btn-danger btn-sm content-icon">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <p class="mb-2 me-3">
                                    Showing {{ $passwords->firstItem() }} to {{ $passwords->lastItem() }} of
                                    {{ $passwords->total() }} records
                                </p>
                                <nav aria-label="Page navigation example mb-2">
                                    {{ $passwords->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
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

        function handleTogglePassword(event) {
            const passwordInput = event.target.closest('div').querySelector('input');
            const type = passwordInput.getAttribute('type');
            if (type === 'text') {
                passwordInput.setAttribute('type', 'password');
            } else {
                passwordInput.setAttribute('type', 'text');
            }
        }
    </script>
@endsection
