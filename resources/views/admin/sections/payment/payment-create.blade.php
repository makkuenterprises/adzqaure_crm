@extends('admin.layouts.app')
@section('css')
    <style>
        /* Style for the required field marker */
        .input-label span.text-red-500 {
            color: red;
            font-weight: bold;
        }

        .input-invalid {
            border-color: red;
        }

        /* Style for error messages */
        .input-error {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
@endsection
@section('panel-header')
    <div>
        <h1 class="panel-title">Add Payment</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>

            @if (request('project_id'))
                <li><a href="{{ route('admin.view.project.list') }}">Projects</a></li>
                <li><i data-feather="chevron-right"></i></li>
                <li><a href="{{ route('admin.view.project.preview', ['id' => request('project_id')]) }}">Manage Payments</a>
                </li>
                <li><i data-feather="chevron-right"></i></li>
            @else
                <li><a href="{{ route('admin.view.payment.list') }}">Payments</a></li>
                <li><i data-feather="chevron-right"></i></li>
            @endif


            <li><a href="{{ route('admin.view.payment.create') }}">Add Payment</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.payment.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Project ID --}}
                    <div class="{{ request('project_id') ? 'hidden' : 'flex' }} flex-col">
                        <label for="project_id" class="input-label">Project <span class="text-red-500">*</span></label>
                        <select name="project_id" class="input-box-md @error('project_id') input-invalid @enderror">
                            <option value="">Select Project</option>
                            @foreach (DB::table('projects')->orderBy('name')->get() as $project)
                                <option @selected(old('project_id', request('project_id')) == $project->id) value="{{ $project->id }}">{{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div class="{{ request('type') ? 'hidden' : 'flex' }} flex-col">
                        <label for="type" class="input-label">Type</label>
                        <select name="type" class="input-box-md @error('type') input-invalid @enderror" required>
                            <option value="">Select Type</option>
                            <option @selected(old('type', request('type')) == 'Credit') value="Credit">Credit</option>
                            <option @selected(old('type', request('type')) == 'Debit') value="Debit">Debit</option>
                        </select>
                        @error('type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="flex flex-col">
                        <label for="amount" class="input-label">Amount <span class="text-red-500">*</span></label>
                        <input type="number" step="any" name="amount" value="{{ old('amount') }}"
                            class="input-box-md @error('amount') input-invalid @enderror" placeholder="Enter amount"
                            required min="0" max="1000000000">
                        @error('amount')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Date --}}
                    <div class="flex flex-col">
                        <label for="date" class="input-label">Date <span class="text-red-500">*</span></label>
                        <input type="date" name="date" value="{{ old('date') }}"
                            class="input-box-md @error('date') input-invalid @enderror" required>
                        @error('date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Remark --}}
                    <div class="flex flex-col">
                        <label for="remark" class="input-label">Remark <span class="text-red-500">*</span></label>
                        <input type="text" name="remark" value="{{ old('remark') }}"
                            class="input-box-md @error('remark') input-invalid @enderror" placeholder="Enter remark"
                            required minlength="1" maxlength="250">
                        @error('remark')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Method --}}
                    <div class="flex flex-col">
                        <label for="method" class="input-label">Method <span class="text-red-500">*</span></label>
                        <select name="method" class="input-box-md @error('method') input-invalid @enderror" required>
                            <option value="">Select Method</option>
                            <option value="UPI">UPI</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                        @error('method')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Payment</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('payment-tab').classList.add('active');
    </script>
@endsection
