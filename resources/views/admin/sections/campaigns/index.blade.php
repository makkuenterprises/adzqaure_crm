@extends('admin.layouts.app')

@section('main-content')
<!--**********************************
    Content body start
***********************************-->
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Campaigns</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Campaign List</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">

                @include('components.alert-messages')

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All WhatsApp Campaigns</h4>

                        <!-- ====================================================== -->
                        <!-- START: ADDED/CORRECTED CODE BLOCK                    -->
                        <!-- ====================================================== -->
                        <div class="d-flex align-items-center">
                            {{-- This form submits a POST request to the sync route --}}
                            {{-- <form action="{{ route('campaigns.templates.sync') }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-sync-alt me-1"></i> Sync Templates from Meta
                                </button>
                            </form> --}}

                            {{-- This button correctly links to the leads manager to start a campaign --}}
                            <a href="{{ route('admin.view.lead.manager.list') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Create New Campaign
                            </a>
                        </div>
                        <!-- ====================================================== -->
                        <!-- END: ADDED/CORRECTED CODE BLOCK                      -->
                        <!-- ====================================================== -->

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Campaign Name</th>
                                        <th>Status</th>
                                        <th>Total Leads</th>
                                        <th>Progress</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campaigns as $campaign)
                                        @php
                                            // Calculate stats for the progress bar.
                                            // Note: For better performance on large datasets, consider storing these counts on the campaigns table.
                                            $totalLeads = $campaign->campaign_leads_count; // Uses the count loaded by withCount()
                                            $sentCount = $campaign->campaignLeads->where('status', 'sent')->count();
                                            $failedCount = $campaign->campaignLeads->where('status', 'failed')->count();
                                            $completedCount = $sentCount + $failedCount;
                                            $progressPercentage = ($totalLeads > 0) ? round(($completedCount / $totalLeads) * 100) : 0;
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $campaign->id }}</strong></td>
                                            <td>{{ $campaign->name }}</td>
                                            <td>
                                                @if($campaign->status == 'completed')
                                                    <span class="badge light badge-success">Completed</span>
                                                @elseif($campaign->status == 'processing')
                                                    <span class="badge light badge-warning">Processing</span>
                                                @elseif($campaign->status == 'draft')
                                                    <span class="badge light badge-secondary">Draft</span>
                                                @else
                                                     <span class="badge light badge-danger">Failed</span>
                                                @endif
                                            </td>
                                            <td>{{ $totalLeads }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress" style="height: 6px; width: 100px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressPercentage }}%;"></div>
                                                    </div>
                                                    <span class="ms-3">{{ $completedCount }} / {{ $totalLeads }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $campaign->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-primary shadow btn-xs sharp me-1" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    {{-- You can add delete or other actions here in the future --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <p>No campaigns found.</p>
                                                <a href="{{ route('admin.view.lead.manager.list') }}" class="btn btn-primary btn-sm">Create Your First Campaign</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                            <div class="mt-3">
                                {{ $campaigns->links() }}
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
    {{-- Add a class to the campaign nav item to show it as active --}}
    <script>
        // Example: If you have a nav item with id="campaigns-tab"
        // document.getElementById('campaigns-tab').classList.add('active');
    </script>
@endsection
