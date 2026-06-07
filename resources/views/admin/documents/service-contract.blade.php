<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Contract - {{ $customer->name }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica Neue', 'Helvetica', 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.5;
            padding: 2.2cm 2cm 2cm 2cm;
        }
        .header-bg, .footer-bg { position: absolute; z-index: -10; left: 0; right: 0; width: 100%; }
        .header-bg { top: 0; height: 120px; }
        .footer-bg { bottom: 0; height: 100px; }

        .company-name { font-size: 20px; font-weight: bold; color: #f54f25; margin: 0; }
        .contract-title { text-align: center; font-size: 16px; font-weight: bold; border-top: 1px solid #777; border-bottom: 1px solid #777; padding: 8px 0; margin: 20px 0; color: #f54f25; }

        h3 { font-size: 12px; font-weight: bold; margin-top: 15px; margin-bottom: 5px; color: #f54f25; }
        p { margin: 0 0 10px 0; }
        ol { margin: 5px 0 15px 0; padding-left: 20px; }
        li { margin-bottom: 6px; }

        .sig-table { width: 100%; margin-top: 40px; border-collapse: collapse; }
        .sig-table td { width: 50%; border: none; padding-top: 50px; text-align: center; }
        .sig-line { border-top: 1px solid #555; width: 80%; margin: 5px auto; }
    </style>
</head>
<body>
    <img class="header-bg" src="{{ public_path('admin_new/images/header-bg.png') }}">
    <img class="footer-bg" src="{{ public_path('admin_new/images/footer-bg.png') }}">

    <header>
        <table style="width: 100%;">
            <tr>
                <td>
                    <p class="company-name">{{ $company->brand_name ?? 'Adzquare' }}</p>
                    <p style="font-size: 9px; margin: 2px 0 0 0;">Powered by {{ $company->company_name ?? 'Makku Enterprises' }}</p>
                </td>
                <td style="text-align: right;">
                    <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" style="max-height: 40px;">
                </td>
            </tr>
        </table>
        <div class="contract-title">FORMAL SERVICE CONTRACT</div>
    </header>

    <main>
        <p>This Service Contract (the "Contract") is entered into on <b>{{ date('d M Y') }}</b>, by and between:</p>

        <p><b>PROVIDER:</b> {{ $company->company_name ?? 'Makku Enterprises Pvt. Ltd.' }} dba <b>{{ $company->brand_name ?? 'Adzquare' }}</b>, located at {{ $company->company_address_street ?? 'India' }}.</p>
        <p><b>CLIENT:</b> <b>{{ $customer->name }}</b>, representing <b>{{ $customer->company_name }}</b>, located at {{ $customer->street ?? 'India' }}.</p>

        <h3>1. SCOPE OF SERVICES</h3>
        <p>The Provider agrees to perform design, engineering, or administrative CRM implementation services as agreed upon in formal billing statements and project milestones. Deliverables will be provided incrementally according to clear technical backlogs.</p>

        <h3>2. CONSIDERATION & PAYMENTS</h3>
        <p>Payment details, pricing schedules, and taxes will be specified in individual Milestone Invoices. All invoices must be settled according to due dates specified on each bill to ensure active development sprints continue.</p>

        <h3>3. CONFIDENTIALITY</h3>
        <p>Both parties agree to hold in strict confidence any proprietary information, user credentials, access tokens, database schemas, and intellectual property. No confidential material shall be shared with third parties without written consent.</p>

        <h3>4. CONTRACT TERMINATION</h3>
        <p>Either party may terminate this contract with 30 days of written notice. Upon termination, all active hours completed up to the notice date must be paid by the Client, and all intellectual properties completed shall be handed over.</p>

        <table class="sig-table">
            <tr>
                <td>
                    <div class="sig-line"></div>
                    <p><b>For {{ $company->brand_name }}</b></p>
                    <p>(Authorized Signatory)</p>
                </td>
                <td>
                    <div class="sig-line"></div>
                    <p><b>For {{ $customer->company_name }}</b></p>
                    <p>(Client Authorized Signatory)</p>
                </td>
            </tr>
        </table>
    </main>
</body>
</html>
