@extends('admin.layouts.app')

@section('main-content')

 <!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body default-height">
			<div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="{{ route('admin.view.bill.list') }}">Payments & Bill</a></li>

					</ol>
                </div>
				<!-- Row -->
				<div class="row">
					<div class="col-xl-12">
						<div>
							<a href="{{ route('admin.view.bill.create') }}" type="button" class="btn btn-sm btn-primary mb-4 open">Create Invoice</a>
						</div>
						<div class="filter cm-content-box box-primary">
							<div class="content-title SlideToolHeader">
								<div class="cpa">
									<i class="fa-solid fa-file-lines me-1"></i>Invoices
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
													<th>ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Amount</th>
                                                    <th>Bill Date</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach ($bills as $bill)
                                                    <tr>
                                                        <td>{{ $bill->id }}</td>
                                                        <td>{{ DB::table('customers')->find($bill->customer_id)?->name }}</td>
                                                        <td>{{env('APP_CURRENCY')}}{{ number_format($bill->total,2) }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($bill->bill_date)) }}</td>
                                                        <td>
                                                            @if (\Carbon\Carbon::parse($bill->due_date) <= \Carbon\Carbon::now())
                                                                    <span class="badge badge-rounded badge-danger">{{ date('d-m-Y',strtotime($bill->due_date)) }}</span>
                                                            @else
                                                                    <span class="badge badge-rounded badge-success">{{ date('d-m-Y',strtotime($bill->due_date)) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if ($bill->payment_status == "Paid")
                                                                    <i class="fa fa-circle text-success me-1"></i> Paid
                                                                @else
                                                                    <i class="fa fa-circle text-danger me-1"></i> Pending
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap">

                                                            <a href="{{ route('admin.view.bill.update', ['id' => $bill->id]) }}" class="btn btn-warning btn-sm content-icon">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('admin.handle.bill.duplicate', ['id' => $bill->id]) }}" class="btn btn-success btn-sm content-icon">
                                                                <i class="fa fa-window-maximize"></i>
                                                            </a>
                                                            <a href="{{ route('admin.handle.bill.invoice', ['id' => $bill->id]) }}" class="btn btn-success btn-sm content-icon">
                                                                <i class="fa fa-download"></i>
                                                            </a>

                                                            <a href="javascript:handleDelete({{ $bill->id }});" class="btn btn-danger btn-sm content-icon">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
											</tbody>
										</table>
										<div class="d-flex align-items-center justify-content-between flex-wrap">
											<p class="mb-2 me-3">Page 1 of 5, showing 2 records out of 8 total, starting on record 1, ending on 2</p>
											<nav aria-label="Page navigation example mb-2">
											  <ul class="pagination mb-2 mb-sm-0">
												<li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="fa-solid fa-angle-left"></i></a></li>
												<li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
												<li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
												<li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
												<li class="page-item"><a class="page-link " href="javascript:void(0);"><i class="fa-solid fa-angle-right"></i></a></li>
											  </ul>
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
        <!--**********************************
            Content body end
        ***********************************-->

@endsection

@section('panel-script')
    <script>
        document.getElementById('admin-tab').classList.add('active');
        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.handle.admin.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                console.log(result);
            }).catch((error) => {
                console.error(error);
            });
        }
    </script>


    <script>

        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this admin!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/admin-access/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
