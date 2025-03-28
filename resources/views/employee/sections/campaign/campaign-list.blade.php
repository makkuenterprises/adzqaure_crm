@extends('employee.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Campaigns</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('employee.view.dashboard') }}">Team Member</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('employee.view.campaign.list') }}">Campaign</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Campaign</h1>
                <p class="panel-card-description">All campaign allocated for you </p>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Lead Count</th>
                            <th>Created on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($lead_id))
                            @foreach ($campaigns as $campaign)
                                <tr>
                                    <td>{{ $campaign->id }}</td>
                                    <td>{{ $campaign->name }}</td>
                                    <td>{{ DB::table('leads')->where('campaign_id', $campaign->id)->count() }}</td>
                                    <td>{{ date('D d M Y', strtotime($campaign->created_at)) }}</td>
                                    <td>
                                        <div class="table-dropdown">
                                            <button>Options<i data-feather="chevron-down"
                                                    class="ml-1 toggler-icon"></i></button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="{{ route('employee.view.campaign.preview', ['id' => $campaign->id]) }}"
                                                            class="dropdown-link-primary"><i data-feather="external-link"
                                                                class="mr-1"></i> Preview Campaign</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel-card-footer">

        </div>
    </figure>
@endsection
