<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Agreement - {{ $customer->name }}</title>
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

        .company-name { font-size: 20px; font-weight: bold; color: #f54f25; margin: 0; }
        .contract-title { text-align: center; font-size: 16px; font-weight: bold; border-top: 1px solid #777; border-bottom: 1px solid #777; padding: 8px 0; margin: 20px 0; color: #f54f25; }

        h3 { font-size: 12px; font-weight: bold; margin-top: 15px; margin-bottom: 5px; color: #f54f25; }
        p { margin: 0 0 10px 0; text-align: justify; }

        .sig-table { width: 100%; margin-top: 40px; border-collapse: collapse; }
        .sig-table td { width: 50%; border: none; padding-top: 40px; text-align: center; }
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
                    <p style="font-size: 9px; margin: 2px 0 0 0;">Building Growth Together</p>
                </td>
                <td style="text-align: right;">
                    <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" style="max-height: 40px;">
                </td>
            </tr>
        </table>
        <div class="contract-title">SERVICE AGREEMENT</div>
    </header>

    <main>
        <p>This agreement outlines how we will work together to achieve your business goals. By starting this journey with <b>{{ $company->brand_name ?? 'Adzquare' }}</b>, we commit to transparency, quality, and your long-term success.</p>

        <p><b>PARTNERS:</b> This agreement is between <b>{{ $company->brand_name ?? 'Adzquare' }}</b> and <b>{{ $customer->name }}</b> of <b>{{ $customer->company_name }}</b>, dated <b>{{ date('d M Y') }}</b>.</p>

        <h3>OUR COMMITMENT</h3>
        <p>We believe in open communication. We will work closely with you to understand your vision, providing tailored services that help your business stand out. Whether it’s marketing, design, or development, we treat your business as our own.</p>

        <h3>TRANSPARENT WORKING</h3>
        <p>We promise to keep you updated on all progress. Billing will always be based on clearly defined milestones, and we will never surprise you with hidden costs. Any changes to the scope of work will be discussed and agreed upon by both parties before proceeding.</p>

        <h3>COLLABORATION</h3>
        <p>Your input is vital. We thrive on your feedback and work best when we collaborate as a team. We respect your deadlines and strive to deliver high-quality results that drive real, measurable impact for your brand.</p>

        <h3>PRIVACY & TRUST</h3>
        <p>Your ideas, data, and access credentials are safe with us. We handle all shared information with the highest level of professional care and will never share your business insights with anyone else.</p>

        <p style="margin-top: 20px;">We are excited to help you reach new heights. Let’s build something great together!</p>

        <table class="sig-table">
            <tr>
                <td>
                    <div class="sig-line"></div>
                    <p><b>For {{ $company->brand_name ?? 'Adzquare' }}</b></p>
                </td>
                <td>
                    <div class="sig-line"></div>
                    <p><b>For {{ $customer->company_name }}</b></p>
                </td>
            </tr>
        </table>
    </main>
</body>
</html>
