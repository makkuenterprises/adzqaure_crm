<?php
// Dependency-free function to convert numbers to words for India.
function convertNumberToWordsForIndia($number)
{
    $no = round($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
        "." . ($words[$point / 10] . " " .
            $words[$point = $point % 10]) : '';
    return "Rupees " . ucwords($result) . " Only";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation - #Q{{ str_pad($quotation->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        :root {
            --brand-color: #007bff;
            --light-gray: #f8f9fa;
            --text-color: #343a40;
            --border-color: #dee2e6;
        }

        @page {
            margin: 0;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10.5px;
            color: var(--text-color);
            line-height: 1.6;
            padding-top: 4.5cm;
            padding-bottom: 3.5cm;
            padding-left: 2cm;
            padding-right: 2cm;
        }

        .header, .footer {
            position: fixed;
            left: 0;
            right: 0;
            width: 100%;
        }

        .header {
            top: 0;
            height: 4.5cm;
            box-sizing: border-box;
        }
        .header-inner {
            padding: 1.5cm 2cm -2 2cm;
            text-align: right;
            position: relative;
            z-index: 1;
        }

        .footer {
            bottom: 0;
            height: 3.5cm;
            box-sizing: border-box;
            font-size: 9px;
            color: #6c757d;
            /* padding: 0.5cm 2cm 0 2cm; */
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            opacity: 0.15;
            z-index: -100;
        }

        .header-bg {
            position: absolute;
            width: 55%;
            z-index: -10;
            top: 0;
            left: 0;
        }
        .footer-bg {
            position: absolute;
            width: 100%;
            z-index: -10;
            bottom: 0;
            right: 0;
        }

        .main-content {
            position: relative;
            z-index: 50;
            margin-bottom: 1cm;
            margin-top: 0.5cm;
        }

        .footer-text-container {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-top: 0;
            margin-bottom: 0;
            color: var(--brand-color);
            line-height: 1.2;
        }
        h2 { font-size: 18px; }
        h3 { font-size: 16px; margin-top: 15px; }
        p { margin: 0; padding: 3px 0; }
        b { font-weight: bold; }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: var(--brand-color);
            border-bottom: 2px solid var(--brand-color);
            padding-bottom: 5px;
            margin-bottom: 20px;
            margin-top: 15px;
        }

        /* IMPROVED: Client Details Section */
        .client-details p {
            padding: 1px 0; /* Reduced padding for tighter lines */
            line-height: 1.4;
            font-size: 10px;
        }

        .quotation-total-section {
            background-color: var(--light-gray);
            border: 1px solid var(--border-color);
            padding: 20px;
            margin-top: 40px;
            text-align: right;
            border-radius: 5px;
            width: 60%;
            float: right;
        }
        .quotation-total-section p {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px; /* REDUCED SPACE */
            font-size: 11px;
            padding: 0;
        }
        .quotation-total-section .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: var(--brand-color);
            margin-top: 10px; /* REDUCED SPACE */
            border-top: 2px solid var(--brand-color);
            padding-top: 8px; /* REDUCED SPACE */
            display: flex;
            justify-content: space-between;
            margin-bottom: 0;
        }
        .quotation-total-section .total-amount span:first-child {
            font-size: 16px;
            color: var(--text-color);
        }
        .quotation-total-section .total-amount span:last-child {
            color: var(--brand-color);
        }
        .amount-in-words {
            font-size: 10px;
            font-weight: bold;
            font-style: italic;
            color: #555;
            text-align: right;
            margin-top: 5px; /* REDUCED SPACE */
        }

        .clear { clear: both; }

    </style>
</head>
<body>

    <img class="watermark" src="{{ public_path('admin_new/images/watermark.png') }}" alt="Watermark">

    <!-- Fixed Header (repeats on all pages) -->
    <div class="header">
        <img class="header-bg" src="{{ public_path('admin_new/images/header-bg.png') }}" alt="Header Background">
        <div class="header-inner">
            <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" style="max-height: 55px;">
            <p style="font-size: 9px; margin-top: 2px; margin-bottom: 0;">Powered by Makku Enterprises Pvt. Ltd.</p>
        </div>
    </div>

    <!-- Fixed Footer (repeats on all pages) -->
    <div class="footer">
        <div class="footer-text-container">
            <p style="font-size: 0.7rem; margin:0; color: #a0a0a0; ">Adzquare Powered by Makku Enterprises Pvt. Ltd.</p>
            <p style="font-size: 0.65rem; color: #a0a0a0; ">This is an electronically generated document. No signature is required.</p>
            <!-- IMPROVED: Single line contact details -->
            <p style="font-size: 9px; color: #6c757d; margin-top: 10px; white-space: nowrap;">
                +91-9304878684 &nbsp; |&nbsp; +91-7004641340 &nbsp;|&nbsp; Patna | Delhi &nbsp;|&nbsp; hello@adzquare.com
            </p>
        </div>
        <img class="footer-bg" src="{{ public_path('admin_new/images/footer-bg.png') }}" alt="Footer Background">
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <!-- First Page Only Section -->
        <div style="text-align: right; margin-bottom: 30px;">
            <h2 style="color: var(--brand-color); font-size: 20px; margin-bottom: 0;">QUOTATION</h2>
            <p style="font-size: 12px; font-weight: bold; line-height: 1.2;">Date: {{ \Carbon\Carbon::parse($quotation->created_at)->format('F d, Y') }}</p>
            <p style="font-size: 12px; font-weight: bold; line-height: 1.2;">Quotation No.: <span style="color: var(--brand-color);">#Q{{ str_pad($quotation->id, 4, '0', STR_PAD_LEFT) }}</span></p>
        </div>


        <!-- IMPROVED: "Prepared For" section -->
        <div class="client-details" style="margin-bottom: 15px;">
            <p style="font-weight: bold; color: var(--brand-color); margin-bottom: 4px;">Prepared For:</p>
            <p><b>{{ $quotation->customer?->name }}</b></p>
            @if($quotation->customer?->company_name)<p>{{ $quotation->customer->company_name }}</p>@endif
            @if($quotation->customer?->street)<p>{{ $quotation->customer->street }}</p>@endif
            <p>Patna - {{ $quotation->customer?->pincode }}</p>
        </div>

        <p style="font-weight: bold; margin-bottom: 5px;">Subject: Quotation for <span style="color: var(--brand-color);">{{ $quotation->service?->service_name ?? 'Proposed Services' }}</span></p>

        <div class="quotation-description">
            <div class="section-title">Proposal Details</div>
            {!! \Parsedown::instance()->text($quotation->content) !!}
        </div>

        <div class="quotation-total-section">
            @php
                $subtotal = $quotation->quotation_amount - ($quotation->tax_amount ?? 0);
                $taxAmount = $quotation->tax_amount ?? 0;
                $taxPercentage = $quotation->tax_percentage ?? 0;
            @endphp
            <p><span>Subtotal:</span> <span>₹ {{ number_format($subtotal, 2) }}</span></p>
            @if($taxAmount > 0)
                <p><span>GST ({{ $taxPercentage }}%):</span> <span>₹ {{ number_format($taxAmount, 2) }}</span></p>
            @endif
            <div class="total-amount">
                <span>TOTAL AMOUNT:</span> <span>₹ {{ number_format($quotation->quotation_amount, 2) }}</span>
            </div>
            <div class="amount-in-words">
                {{ convertNumberToWordsForIndia($quotation->quotation_amount) }}
            </div>
        </div>
        <div class="clear"></div>

        <div class="section-title" style="margin-top: 40px;">Terms & Conditions</div>
        <div style="font-size: 9.5px; line-height: 1.5;">
            <ol style="margin-top: 5px; padding-left: 20px;">
                <li>Prices are valid for 30 days from the quotation date.</li>
                <li>Payment terms: 50% upfront, 50% upon completion.</li>
                <li>Any additional services requested will be quoted separately.</li>
                <li>This quotation is subject to our standard terms of service.</li>
                <li>All intellectual property rights for custom-developed materials remain with Adzquare until full payment is received.</li>
            </ol>
        </div>

        <div style="margin-top: 40px; text-align: left; font-size: 10px;">
            <p>Thank you for considering our proposal.</p>
            <p style="margin-top: 10px;">Sincerely,</p>
            <p style="font-weight: bold; margin-top: 5px;">The Adzquare Team</p>
        </div>

    </div>

</body>
</html>