@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Plans</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.plan.list') }}">Plans</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Plans</h1>
                <p class="panel-card-description">List of all plans in webiste</p>
            </div>
            <div class="flex items-center justify-between space-x-3">
                <div>
                    <select name="city" id="city_select"
                        onchange="window.location = `{{ route('admin.view.plan.list') }}?city=${this.value}`"
                        class="input-box-md" required>
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <a href="{{ route('admin.view.plan.create') }}" class="btn-primary-md">Add Plan</a>
                </div>
            </div>

        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>{{ $plan->id }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->city }}</td>
                                <td>{{ $plan->duration }} Days</td>
                                <td>{{ env('APP_CURRENCY') }}{{ number_format(is_null($plan->price_offer) ? $plan->price_regular : $plan->price_offer, 0) }}
                                </td>
                                <td>

                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.plan.update', ['id' => $plan->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Plan</a></li>
                                                <li><a href="javascript:handleDelete({{ $plan->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Plan</a></li>
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
        document.getElementById('plan-tab').classList.add('active');



        fetch("{{ asset('admin/json/plan-cities.json') }}")
            .then((res) => {
                return res.json();
            })
            .then((res) => {
                res.cities.forEach((city) => {
                    let option = document.createElement('option');
                    option.value = city;
                    option.innerHTML = city;
                    if (city == "{{ request('city') }}") {
                        option.selected = true;
                    }
                    document.getElementById('city_select').appendChild(option);
                });
            })
    </script>
    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this plan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/plan/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
