<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Letter - {{ $customer->name }}</title>
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
        .letter-title { text-align: center; font-size: 16px; font-weight: bold; border-top: 1px solid #777; border-bottom: 1px solid #777; padding: 8px 0; margin: 20px 0; color: #f54f25; }

        .pm-card { border: 1px solid #ccc; background-color: #fff8f6; padding: 15px; margin-top: 15px; border-radius: 8px; }
        .pm-card h4 { margin: 0 0 5px 0; color: #f54f25; }
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
        <div class="letter-title">WELCOME & ONBOARDING PROPOSAL</div>
    </header>

    <main>
        <p>Date: <b>{{ date('d M Y') }}</b></p>
        <p>To,<br><b>{{ $customer->name }}</b><br>{{ $customer->company_name }}</p>

        <p>Dear {{ $customer->name }},</p>

        <p>Thank you for choosing <b>{{ $company->brand_name }}</b> as your technology and growth partner. We are highly motivated to assist you in managing and accelerating your operational requirements.</p>

        <p>Our goal is to ensure a completely smooth development lifecycle for your active pipelines. To handle your requests, coordinate sprints, and manage your billing ledger directly, we have assigned a dedicated **Project/Account Manager** to your account:</p>

        <div class="pm-card">
            <h4>Your Account Manager</h4>
            <p><b>Name:</b> Yash Makhariya</p>
            <p><b>Designation:</b> Client Coordinator & MOD</p>
            <p><b>Email Contact:</b> coordination@adzquare.in</p>
        </div>

        <p style="margin-top: 15px;">Your Account Manager will act as your single point of contact for backlog updates, timeline estimations, and system handoffs. You can also directly communicate with them and submit support tickets inside your secure **Client Hub**.</p>

        <p>We look forward to building a valuable, long-term relationship with you.</p>

        <p style="margin-top: 30px;">Sincerely,<br><br><b>The Adzquare Team</b><br>Makku Enterprises Pvt. Ltd.</p>
    </main>
</body>
</html>
