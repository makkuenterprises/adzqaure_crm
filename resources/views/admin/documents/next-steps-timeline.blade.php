<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Onboarding Roadmap - {{ $customer->name }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica Neue', 'Helvetica', 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #444;
            line-height: 1.5;
            padding: 2.2cm 2cm 2cm 2cm;
        }
        .header-bg, .footer-bg { position: absolute; z-index: -10; left: 0; right: 0; width: 100%; }
        .header-bg { top: 0; height: 120px; }
        .footer-bg { bottom: 0; height: 100px; }

        .company-name { font-size: 18px; font-weight: bold; color: #f54f25; margin: 0; }
        .company-sub { font-size: 9px; color: #777; margin: 2px 0 0 0; }
        .logo-img { max-height: 40px; float: right; }

        .report-title { text-align: center; font-size: 14px; font-weight: bold; border-top: 1px solid #777; border-bottom: 1px solid #777; padding: 8px 0; margin: 20px 0; color: #f54f25; text-transform: uppercase; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f8f8f8; font-weight: bold; color: #333; }

        .phase-name { font-weight: bold; color: #f54f25; }
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
                    <p class="company-sub">Your Growth Partner</p>
                </td>
                <td style="text-align: right;">
                    <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" class="logo-img">
                </td>
            </tr>
        </table>
        <div class="report-title">Implementation Roadmap & Next Steps</div>
    </header>

    <main>
        <p>Dear <b>{{ $customer->name }}</b>,</p>
        <p>At <b>{{ $company->brand_name ?? 'Adzquare' }}</b>, we follow a structured, transparent process to ensure every project meets our quality standards. This roadmap outlines the typical phases we take to bring your vision to life.</p>

        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Phase</th>
                    <th style="width: 50%;">Key Objectives</th>
                    <th style="width: 30%;">Outcome</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="phase-name">01. Discovery</span></td>
                    <td>Alignment meeting, requirement gathering, and objective setting.</td>
                    <td>Strategy Approval</td>
                </tr>
                <tr>
                    <td><span class="phase-name">02. Planning</span></td>
                    <td>Resource allocation, timeline finalization, and backlog preparation.</td>
                    <td>Project Blueprint</td>
                </tr>
                <tr>
                    <td><span class="phase-name">03. Execution</span></td>
                    <td>Active development, creative production, or campaign deployment.</td>
                    <td>Progress Updates</td>
                </tr>
                <tr>
                    <td><span class="phase-name">04. Quality Check</span></td>
                    <td>Rigorous testing, review, and Client feedback integration (UAT).</td>
                    <td>Refined Solution</td>
                </tr>
                <tr>
                    <td><span class="phase-name">05. Handoff</span></td>
                    <td>Final delivery, documentation, and handover to support/maintenance.</td>
                    <td>Successful Launch</td>
                </tr>
            </tbody>
        </table>

        <h3>What happens next?</h3>
        <p>Your dedicated Project Manager will be reaching out shortly to schedule your <b>Kickoff Call</b>. During this call, we will walk you through the specifics of your first sprint and define the immediate action items. We prioritize clear, consistent communication so you always know where your project stands.</p>

        <p>We are excited to begin this collaborative work. If you have any questions in the meantime, please use your <b>Client Hub</b> to send us a quick message.</p>

        <p style="margin-top: 30px;">Best regards,<br><br><b>The Adzquare Team</b></p>
    </main>
</body>
</html>
