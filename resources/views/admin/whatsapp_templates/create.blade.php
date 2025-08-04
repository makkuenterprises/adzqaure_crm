@extends('admin.layouts.app')

@section('main-content')
<div class="content-body default-height">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.whatsapp-templates.index') }}">Message Templates</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create New</a></li>
            </ol>
        </div>

        @include('components.alert-messages')

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create New Template</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">Fill out this form to submit a new template to Meta for approval. Once submitted, use the "Sync Templates" button on the main page to check its status.</p>
                <hr>
                <form action="{{ route('admin.whatsapp-templates.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Template Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            <small class="form-text text-muted">Required. Use only lowercase letters, numbers, and underscores (e.g., `order_confirmation_v2`).</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select form-control" id="category" name="category" required>
                                <option value="MARKETING">Marketing - Promotions or special offers</option>
                                <option value="UTILITY" selected>Utility - Related to a user transaction (e.g., order confirmation, delivery status)</option>
                                <option value="AUTHENTICATION">Authentication - One-time passcodes</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="body_text" class="form-label">Body Text <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="body_text" name="body_text" rows="5" required>{{ old('body_text') }}</textarea>
                            <small class="form-text text-muted">The main content of your message. Use placeholders for dynamic content, like `{{1}}`, `{{2}}`, etc. Example: `Hello {{1}}, your order #{{2}} has been shipped.`</small>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="body_example" class="form-label">Body Example</label>
                            <input type="text" class="form-control" id="body_example" name="body_example" value="{{ old('body_example') }}">
                            <small class="form-text text-muted">Provide an example for the placeholders used above, separated by commas. Example: `John Doe, 12345`</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit for Approval</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
