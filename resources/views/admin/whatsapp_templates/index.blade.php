@extends('admin.layouts.app')

@section('main-content')
<div class="content-body default-height">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">WhatsApp</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.whatsapp-templates.index') }}">Message Templates</a></li>
            </ol>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.whatsapp-templates.sync') }}" class="btn btn-info me-2">
                <i class="fas fa-sync me-1"></i> Sync Templates Now
            </a>
            <a href="{{ route('admin.whatsapp-templates.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Create New Template
            </a>
        </div>

        @include('components.alert-messages')

        <!-- Templates Table -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Synced Templates</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Template Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Body Text</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($templates as $template)
                                <tr>
                                    <td><strong>{{ $template->name }}</strong></td>
                                    <td><span class="badge badge-primary">{{ $template->category }}</span></td>
                                    <td><span class="badge badge-success">{{ $template->status }}</span></td>
                                    <td style="white-space: pre-wrap; word-break: break-word;">{{ $template->body_text }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No templates found. Run the sync to fetch them from Meta.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $templates->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
