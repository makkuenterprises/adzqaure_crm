@extends('admin.layouts.app')

@section('panel-head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('panel-header')
    <div>
        <h1 class="panel-title">Password Manager</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.password.list') }}">Password Manager</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Passwords</h1>
                <p class="panel-card-description">All password in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.password.create') }}" class="btn-primary-md">Add Password</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($passwords as $password)
                            <tr>
                                <td>{{ $password->id }}</td>
                                <td>{{ DB::table('customers')->find($password->customer_id)?->name }}</td>
                                <td>{{ $password->username }}</td>
                                <td>{{ $password->email }}</td>
                                <td>
                                    <div class="flex items-center justify-start password-div">
                                        <input type="password"
                                            class="text-sm font-medium text-slate-900 p-0 w-fit outline-none"
                                            value="{{ $password->password }}" readonly>
                                        <button onclick="handleTogglePassword(event)" class="p-1">
                                            <div class="password-hidden">
                                                <i data-feather="eye-off" class="h-4 w-4"></i>
                                            </div>
                                            <div class="password-show" hidden>
                                                <i data-feather="eye" class="h-4 w-4"></i>
                                            </div>
                                        </button>
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
                                                    <i class="fab fa-goggle fa-lg"></i>
                                                @break

                                                @case('Microsoft')
                                                    <i class="fab fa-microsoft fa-lg"></i>
                                                @break
                                            @endswitch
                                        </span>
                                        <span>{{ $password->type }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.password.update', ['id' => $password->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Password</a></li>
                                                <li><a href="javascript:handleDelete({{ $password->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Password</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('password-tab').classList.add('active');


        const handleTogglePassword = (event) => {
            if (event.target.parentNode.parentNode.parentNode.querySelector('input').getAttribute('type') == 'text') {
                event.target.parentNode.parentNode.parentNode.querySelector('input').setAttribute('type', 'password');
                event.target.parentNode.parentNode.querySelector('.password-hidden').removeAttribute('hidden');
                event.target.parentNode.parentNode.querySelector('.password-show').setAttribute('hidden', true);

            } else {
                event.target.parentNode.parentNode.parentNode.querySelector('input').setAttribute('type', 'text');
                event.target.parentNode.parentNode.querySelector('.password-hidden').setAttribute('hidden', true);
                event.target.parentNode.parentNode.querySelector('.password-show').removeAttribute('hidden');
            }
        }
    </script>

    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this password!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/password/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
