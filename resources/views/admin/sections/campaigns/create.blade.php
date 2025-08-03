@extends('admin.layouts.app')

@section('main-content')
<!--**********************************
    Content body start
***********************************-->
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Campaigns</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Campaign</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create New WhatsApp Campaign</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('campaigns.store') }}" method="POST">
                                @csrf

                                <!-- Section to display selected leads for confirmation -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h5 class="mb-3">Confirm Selected Leads ({{ count($leads) }} total)</h5>
                                        <div style="max-height: 200px; overflow-y: auto; border: 1px solid #eee; padding: 15px; border-radius: 0.25rem;">
                                            <ul class="list-group">
                                                @forelse ($leads as $lead)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $lead->name }}
                                                        <span class="badge bg-primary rounded-pill">{{ $lead->phone_number }}</span>
                                                    </li>
                                                    <!-- Hidden input to pass lead IDs to the controller -->
                                                    <input type="hidden" name="lead_ids[]" value="{{ $lead->id }}">
                                                @empty
                                                    <p class="text-danger">No leads were selected. Please go back and select leads to include in this campaign.</p>
                                                @endforelse
                                            </ul>
                                        </div>
                                         @error('lead_ids')
                                            <span class="input-error d-block mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Campaign details form -->
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Campaign Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') input-invalid @enderror" placeholder="e.g., August Promotion" required>
                                        @error('name')
                                            <span class="input-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="whatsapp_template_id" class="form-label">Select Template <span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide @error('whatsapp_template_id') input-invalid @enderror" name="whatsapp_template_id" id="whatsapp_template_id" required>
                                            <option value="" selected>Select a Template</option>
                                            @foreach ($templates as $template)
                                                <option value="{{ $template->id }}" {{ old('whatsapp_template_id') == $template->id ? 'selected' : '' }}>
                                                    {{ $template->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('whatsapp_template_id')
                                            <span class="input-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- TODO: Add a section here that dynamically shows inputs for template placeholders using JavaScript --}}


                                <button type="submit" class="btn btn-primary" {{ count($leads) === 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-paper-plane me-2"></i> Start Campaign
                                </button>
                                <a href="{{ route('admin.view.lead.manager.list') }}" class="btn btn-secondary">Cancel</a>
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


@section('panel-script')
    {{-- Add a class to the campaign nav item to show it as active --}}
    <script>
        // Example: If you have a nav item with id="campaign-tab"
        // document.getElementById('campaign-tab').classList.add('active');
    </script>
@endsection
