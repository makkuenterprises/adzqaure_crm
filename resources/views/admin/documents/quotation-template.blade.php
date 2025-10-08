<?php
// Helper function can be kept.
function convertNumberToWordsForIndia($number) { /* ... full function code ... */ }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation - #Q{{ str_pad($quotation->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page {
            /* Remove default page margins */
            margin: 0;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            /* CRITICAL FIX: Create a "safe area" for content on every page.
               This padding must be large enough to contain your header and footer. */
            padding-top: 4.5cm;
            padding-bottom: 3.5cm;
            padding-left: 2cm;
            padding-right: 2cm;
        }
        /* --- FIXED ELEMENTS THAT REPEAT ON EVERY PAGE --- */
        .header, .footer {
            position: fixed; /* This makes it repeat on each page */
            left: 0;
            right: 0;
            width: 100%;
        }
        .header {
            top: 0;
            height: 4.5cm; /* Must match body padding-top */
        }
        .footer {
            bottom: 0;
            height: 3.5cm; /* Must match body padding-bottom */
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            opacity: 0.20;
            z-index: -100; /* Put it behind everything */
        }

        /* --- BACKGROUND IMAGES --- */
        .header-bg {
            position: absolute;
            width: 55%; /* Control the size of the curve graphic */
            z-index: -10;
        }

         .footer-bg {
            position: absolute;
            width: 100%; /* Control the size of the curve graphic */
            z-index: -10;
        }
        .header-bg { top: 0; left: 0; }
        .footer-bg { bottom: 0; right: 0; }

        /* --- CONTENT POSITIONING --- */
        .header-content { padding: 1.5cm 2cm 0 2cm; }
        .footer-content { padding: 0 2cm; }
        .main-content {
            position: relative; /* Ensures it respects the body padding */
            z-index: 50;
        }
        .total-box { background-color: #fde3de; padding: 15px 20px; width: 60%; margin-top: 1cm; }
        p { margin: 0; padding: 2px 0; }
    </style>
</head>
<body>

    <!-- Watermark Layer (Fixed, behind everything) -->
    <img class="watermark" src="{{ public_path('admin_new/images/watermark.png') }}" alt="Watermark">

    <!-- Header Layer (Fixed, repeats on every page) -->
    <div class="header">
        <img class="header-bg" src="{{ public_path('admin_new/images/header-bg.png') }}" alt="Header Background">
        <div class="header-content">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;">
                        <!-- Intentionally blank space -->
                    </td>
                    <td style="width: 50%; text-align: right;">

                            <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" style="max-height: 55px;">

                        <p style="font-size: 9px; margin-top: 5px;">Powered by Makku Enterprises Pvt. Ltd.</p>
                        <br><br>
                        <p style="font-size: 14px; font-weight: bold;">{{ \Carbon\Carbon::parse($quotation->created_at)->format('F d, Y') }}</p>
                        <p>Quotation No.: #Q{{ str_pad($quotation->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Footer Layer (Fixed, repeats on every page) -->
    <div class="footer">
        <img class="footer-bg" src="{{ public_path('admin_new/images/footer-bg.png') }}" alt="Footer Background">
        {{-- <div class="footer-content">
            <table style="width: 100%; position: absolute; bottom: 1.5cm;">
                <tr>
                    <td style="width: 33.3%;">+91-9304878684</td>
                    <td style="width: 33.3%; text-align: center;">Patna | Delhi</td>
                    <td style="width: 33.3%; text-align: right;">hello@adzquare.com</td>
                </tr>
            </table>
        </div> --}}
    </div>

    <!-- Main Content (This is the only part that will flow across pages) -->
    <div class="main-content">
        <div>
            <p><b>Prepared For:</b></p>
            <p>{{ $quotation->customer?->name }}</p>
            @if($quotation->customer?->company_name)<p>{{ $quotation->customer->company_name }}</p>@endif
            @if($quotation->customer?->street)<p>{{ $quotation->customer->street }}</p>@endif
            <p>Patna - {{ $quotation->customer?->pincode }}</p>
        </div>
        <br><br>
        <div>
            <p><b>Subject: Quotation for {{ $quotation->service?->service_name ?? 'Proposed Services' }}</b></p>
        </div>
        <div class="quotation-description" style="margin-top: 1cm; line-height: 1.6;">
            {!! \Parsedown::instance()->text($quotation->content) !!}
        </div>
        <br>
        <strong><p>Amount in Words: Total: ₹{{ number_format($quotation->quotation_amount, 2) }}</p></strong>

    </div>

</body>
</html>
