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
            color: #444;
            line-height: 1.6;
            padding: 2.2cm 2cm 2cm 2cm;
        }
        .header-bg, .footer-bg { position: absolute; z-index: -10; left: 0; right: 0; width: 100%; }
        .header-bg { top: 0; height: 120px; }
        .footer-bg { bottom: 0; height: 100px; }

        .company-name { font-size: 18px; font-weight: bold; color: #f54f25; margin: 0; }
        .company-sub { font-size: 9px; color: #777; margin: 2px 0 0 0; }
        .logo-img { max-height: 40px; float: right; }

        .letter-title { text-align: center; font-size: 14px; font-weight: bold; border-top: 1px solid #777; border-bottom: 1px solid #777; padding: 8px 0; margin: 20px 0; color: #f54f25; text-transform: uppercase; }

        .pm-card { border: 1px solid #eee; background-color: #fff8f6; padding: 15px; margin: 15px 0; border-radius: 8px; }
        .pm-card h4 { margin: 0 0 8px 0; color: #f54f25; font-size: 12px; }
        .pm-card p { margin: 3px 0; }
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
                    <p class="company-sub">Building Growth Together</p>
                </td>
                <td style="text-align: right;">
                    <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" class="logo-img">
                </td>
            </tr>
        </table>
        <div class="letter-title">Welcome to Adzquare</div>
    </header>

    <main>
        <p>Date: <b>{{ date('d M Y') }}</b></p>
        <p>To,<br><b>{{ $customer->name }}</b><br>{{ $customer->company_name }}</p>

        <p>Dear {{ $customer->name }},</p>

        <p>Welcome to <b>{{ $company->brand_name ?? 'Adzquare' }}</b>! We are thrilled that you’ve chosen us to be your growth partner. We don’t just see this as a service agreement; we see it as the beginning of a long-term collaboration to help your brand reach new heights.</p>

        <p>Our goal is to make every step of our journey together clear, productive, and enjoyable. To ensure you always have a direct line to our team for sprint updates, strategy changes, and feedback, we have assigned a dedicated point of contact to your account:</p>

        <div class="pm-card">
            <h4>Your Dedicated Success Manager</h4>
            <p><b>Name:</b> Yash Makhariya</p>
            <p><b>Role:</b> Client Coordinator & Project Lead</p>
            <p><b>Email:</b> coordination@adzquare.in</p>
            <p><b>Support:</b> Available via your Client Hub Dashboard</p>
        </div>

        <p>Your Success Manager will keep you in the loop regarding timeline milestones and project status. We encourage you to log into your <b>Client Hub</b> regularly, where you can submit tickets, chat with us, and view your billing progress in real-time.</p>

        <p>Transparency is at the heart of what we do. If you ever have questions or need a helping hand, please don't hesitate to reach out—we are here for you.</p>

        <p>Thank you for trusting us with your vision. Let’s create something amazing!</p>

        <p style="margin-top: 30px;">Warm regards,<br><br><b>The Adzquare Team</b><br>{{ $company->company_name ?? 'Makku Enterprises Pvt. Ltd.' }}</p>
    </main>
</body>
</html>
