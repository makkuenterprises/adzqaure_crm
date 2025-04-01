@extends('admin.layouts.app')


@section('main-content')
      <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body default-height">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('admin.view.domain.hosting.list') }}">Domain & Hosting</a></li>
						<li class="breadcrumb-item active"><a href="{{ route('admin.view.domain.hosting.update', ['id' => $domain_hosting->id]) }}">Update a Domain Hosting</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
					<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.handle.domain.hosting.update', ['id' => $domain_hosting->id]) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <label for="basic-form" class="form-label">Select Customer <span class="text-danger">*</span></label>
                                            <div class="basic-form">
                                                <select class="default-select form-control wide mb-3" name="customer_id">
                                                    @if (!empty($customers))
                                                        <option selected>Select Customer</option>
                                                        @foreach ($customers as $customer)
                                                            <option @selected($domain_hosting->customer_id == $customer->id) value="{{ $customer->id }}">{{ $customer->name }}
                                                                ({{ $customer->company_name }})
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('customer_id')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Domain Name</label>
                                                <input type="text" name="domain_name" value="{{ old('domain_name', $domain_hosting->domain_name) }}" class="form-control @error('domain_name') input-invalid @enderror" placeholder="Enter domain name" minlength="1" maxlength="250">
                                                @error('domain_name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Domain Provider</label>
                                                <input type="text" name="domain_provider" value="{{ old('domain_provider', $domain_hosting->domain_provider) }}" class="form-control @error('domain_provider') input-invalid @enderror" placeholder="Enter domain provider" minlength="1" maxlength="250">
                                                @error('domain_provider')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Domain Purchase Date</label>
                                                <input type="date" name="domain_purchase" value="{{ old('domain_purchase', $domain_hosting->domain_purchase) }}" class="form-control @error('domain_purchase') input-invalid @enderror" placeholder="Enter purchase date">
                                                @error('domain_purchase')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="domain_renewal_price" class="form-label">Domain Renewal Price</label>
                                                <input type="number" name="domain_renewal_price" value="{{ old('domain_renewal_price', $domain_hosting->domain_renewal_price) }}" class="form-control @error('domain_renewal_price') input-invalid @enderror" placeholder="Enter renewal price">
                                                @error('domain_renewal_price')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="hosting_provider" class="form-label">Hosting Provider</label>
                                                <input type="text" name="hosting_provider" value="{{ old('hosting_provider', $domain_hosting->hosting_provider) }}" class="form-control @error('hosting_provider') input-invalid @enderror" placeholder="Enter hosting provider" minlength="1" maxlength="250">
                                                @error('hosting_provider')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="hosting_purchase" class="form-label">Hosting Purchase Date</label>
                                                <input type="date" name="hosting_purchase" value="{{ old('hosting_purchase', $domain_hosting->hosting_purchase) }}" class="form-control @error('hosting_purchase') input-invalid @enderror" placeholder="Enter hosting purchase date">
                                                @error('hosting_purchase')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="hosting_renewal_price" class="form-label">Hosting Renewal Price</label>
                                                <input type="number" name="hosting_renewal_price" value="{{ old('hosting_renewal_price', $domain_hosting->hosting_renewal_price) }}" class="form-control @error('hosting_renewal_price') input-invalid @enderror" placeholder="Enter renewal price">
                                                @error('hosting_renewal_price')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Domain Hosting</button>
                                    </form>
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


