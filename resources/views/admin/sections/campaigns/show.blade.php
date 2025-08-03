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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Campaign Details</a></li>
            </ol>
        </div>

        @php
            // Calculate statistics for the campaign
            $totalLeads = $campaign->campaignLeads->count();
            $sentCount = $campaign->campaignLeads->where('status', 'sent')->count();
            $pendingCount = $campaign->campaignLeads->where('status', 'pending')->count();
            $failedCount = $campaign->campaignLeads->where('status', 'failed')->count();
            $progressPercentage = ($totalLeads > 0) ? round((($sentCount + $failedCount) / $totalLeads) * 100) : 0;
        @endphp

        <!-- row -->
        <div class="row">
            <!-- Campaign Summary Card -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $campaign->name }}</h4>
                        <span class="badge badge-lg light badge-primary">{{ ucfirst($campaign->status) }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <strong>Template Used:</strong>
                                <p>{{ $campaign->template->display_name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong>Created On:</strong>
                                <p>{{ $campaign->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong>Total Leads:</strong>
                                <p>{{ $totalLeads }}</p>
                            </div>
                        </div>

                        <!-- Progress Bar and Stats -->
                        <div class="mt-3">
                            <h5>Campaign Progress ({{ $progressPercentage }}%)</h5>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($sentCount / $totalLeads) * 100 }}%;" aria-valuenow="{{ $sentCount }}" aria-valuemin="0" aria-valuemax="{{ $totalLeads }}">
                                    Sent: {{ $sentCount }}
                                </div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ ($failedCount / $totalLeads) * 100 }}%;" aria-valuenow="{{ $failedCount }}" aria-valuemin="0" aria-valuemax="{{ $totalLeads }}">
                                    Failed: {{ $failedCount }}
                                </div>
                                @if($pendingCount > 0)
                                <div class="progress-bar bg-light text-dark" role="progressbar" style="width: {{ ($pendingCount / $totalLeads) * 100 }}%;" aria-valuenow="{{ $pendingCount }}" aria-valuemin="0" aria-valuemax="{{ $totalLeads }}">
                                    Pending: {{ $pendingCount }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leads Details Card -->
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Lead Status Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Lead Name</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campaign->campaignLeads as $index => $campaignLead)
                                        <tr>
                                            <td><strong>{{ $index + 1 }}</strong></td>
                                            <td>{{ $campaignLead->lead->name ?? 'N/A' }}</td>
                                            <td>{{ $campaignLead->lead->phone_number ?? 'N/A' }}</td>
                                            <td>
                                                @if($campaignLead->status == 'sent')
                                                    <span class="badge light badge-success">Sent</span>
                                                @elseif($campaignLead->status == 'failed')
                                                    <span class="badge light badge-danger">Failed</span>
                                                @else
                                                    <span class="badge light badge-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($campaignLead->status == 'failed')
                                                    <span class="text-danger">{{ $campaignLead->failed_reason }}</span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No leads were found for this campaign.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
