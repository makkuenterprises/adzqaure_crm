<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Next Steps & Timeline - {{ $customer->name }}</title>
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
        .report-title { text-align: center; font-size: 16px; font-weight: bold; border-top: 1px solid #777; border-bottom: 1px solid #777; padding: 8px 0; margin: 20px 0; color: #f54f25; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
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
        <div class="report-title">NEXT STEPS & IMPLEMENTATION ROADMAP</div>
    </header>

    <main>
        <p>Prepared For: <b>{{ $customer->name }}</b> ({{ $customer->company_name }})</p>
        <p>This report outlines the onboarding steps and initial implementation timeline for your services.</p>

        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Phase</th>
                    <th style="width: 45%;">Key Objectives / Activities</th>
                    <th style="width: 20%;">Target Duration</th>
                    <th style="width: 20%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Phase 1</b></td>
                    <td><b>Kickoff & Discovery</b><br>Initial alignment meeting, requirement mapping, and environment sandboxing.</td>
                    <td>Days 1 – 3</td>
                    <td><span style="color: orange; font-weight: bold;">In-Progress</span></td>
                </tr>
                <tr>
                    <td><b>Phase 2</b></td>
                    <td><b>Sprint Planning</b><br>Finalization of backlog tickets, UX wireframing, and architecture approvals.</td>
                    <td>Days 4 – 7</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td><b>Phase 3</b></td>
                    <td><b>Execution Sprints</b><br>Dynamic development, UI designs implementation, and beta code deployments.</td>
                    <td>Weeks 2 – 3</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td><b>Phase 4</b></td>
                    <td><b>QA & Acceptance</b><br>Internal testing, bug-fixing, and Client User Acceptance Testing (UAT).</td>
                    <td>Week 4</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td><b>Phase 5</b></td>
                    <td><b>Handoff & Support</b><br>Live system deployment, training coordination, and launching SLA support desk.</td>
                    <td>On-going</td>
                    <td>Pending</td>
                </tr>
            </tbody>
        </table>

        <p style="margin-top: 20px;">** Note: Sprints schedules may shift slightly depending on prompt approval of milestone designs and invoices clearance.</p>
    </main>
</body>
</html>
