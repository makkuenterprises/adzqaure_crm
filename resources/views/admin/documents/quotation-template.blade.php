<?php
// Dependency-free function to convert numbers to words for India.
if (!function_exists('convertNumberToWordsForIndia')) {
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
        return "Rupees " . ucwords($result) . " Only";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation - #Q{{ str_pad($quotation->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        :root {
            --brand-color: #f54f25; /* Swapped generic blue with Adzquare Neon-Orange */
            --light-gray: #fcedea;
            --text-color: #333333;
            --border-color: #dee2e6;
        }

        @page {
            margin: 0;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: var(--text-color);
            line-height: 1.5;
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
            padding: 1.5cm 2cm 0 2cm;
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
            font-size: 14px;
            font-weight: bold;
            color: var(--brand-color);
            border-bottom: 2px solid var(--brand-color);
            padding-bottom: 5px;
            margin-bottom: 15px;
            margin-top: 15px;
        }

        .billing-card {
            background-color: var(--light-gray);
            padding: 12px;
            border-radius: 8px;
        }
        .billing-card table th, .billing-card table td { padding: 1.2px 0; }

        /* Client Details Section */
        .client-details p {
            padding: 1px 0;
            line-height: 1.4;
            font-size: 10px;
        }

        /* Items Table Grid */
        .items-table {
            width: 100%;
            margin-top: 15px;
            font-size: 0.8rem;
            border-collapse: collapse;
        }
        .items-table thead {
            background-color: var(--brand-color);
            color: #fff;
        }
        .items-table th {
            padding: 8px;
            font-weight: bold;
            text-align: left;
        }
        .items-table tbody {
            background-color: var(--light-gray);
        }
        .items-table td {
            padding: 8px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .items-table .right {
            text-align: right;
        }

        /* Totals Block styling */
        .totals-section {
            margin-top: 20px;
            width: 100%;
        }
        .totals-table {
            width: 100%;
        }
        .totals-table td {
            padding: 2px 5px;
            text-align: right;
        }
        .totals-table tr.net-payable td {
            font-size: 12px;
            font-weight: bold;
            padding-top: 8px;
            padding-bottom: 8px;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            color: var(--brand-color);
        }
        .total-in-words {
            font-size: 0.9rem;
            vertical-align: bottom;
            padding: 10px 0;
            width: 60%;
        }

        .clear { clear: both; }
    </style>
</head>
<body>

    @php
        // Decodes multi-service items and runs pro-rata tax math backwards
        $grandTotal = (float)($quotation->quotation_amount ?? 0);
        $subtotal = $grandTotal / 1.18;
        $totalTax = $grandTotal - $subtotal;
        $halfTax = $totalTax / 2; // CGST 9% and SGST 9%

        $quoteItems = json_decode($quotation->items, true) ?? [];
        $companyDetails = DB::table('company_details')->first();
    @endphp

    <img class="watermark" src="{{ public_path('admin_new/images/watermark.png') }}" alt="Watermark">

    <!-- Fixed Header (repeats on all pages) -->
    <div class="header">
        <img class="header-bg" src="{{ public_path('admin_new/images/header-bg.png') }}" alt="Header Background">
        <div class="header-inner">
            <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" style="max-height: 45px;">
            <p style="font-weight: bold; font-size: 0.6rem; margin-top: 3px; margin-bottom: 0;">CIN: U72900BR2021PTC054492</p>
        </div>
    </div>

    <!-- Fixed Footer (repeats on all pages) -->
    <div class="footer">
        <div class="footer-text-container">
            <p style="font-size: 0.7rem; margin:0; color: #a0a0a0; ">Adzquare Powered by Makku Enterprises Pvt. Ltd.</p>
            <p style="font-size: 0.65rem; color: #a0a0a0; ">This is an electronically generated document. No signature is required.</p>
            <p style="font-size: 9px; color: #6c757d; margin-top: 10px; white-space: nowrap;">
                {{ $companyDetails->company_phone ?? '+91-9304878684' }} &nbsp; |&nbsp; {{ $companyDetails->company_phone_alternate ?? '+91-7004641340' }} &nbsp;|&nbsp; Patna | Delhi &nbsp;|&nbsp; {{ $companyDetails->company_email ?? 'info@adzquare.in' }}
            </p>
        </div>
        <img class="footer-bg" src="{{ public_path('admin_new/images/footer-bg.png') }}" alt="Footer Background">
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <!-- First Page Only Section -->
        <div style="text-align: right; margin-bottom: 20px;">
            <h2 style="color: var(--brand-color); font-size: 20px; margin-bottom: 0; font-weight: bold;">QUOTATION</h2>
            <p style="font-size: 11px; font-weight: bold; line-height: 1.2;">Date: {{ \Carbon\Carbon::parse($quotation->created_at)->format('d F Y') }}</p>
            <p style="font-size: 11px; font-weight: bold; line-height: 1.2;">Quotation No.: <span style="color: var(--brand-color);">#Q{{ str_pad($quotation->id, 4, '0', STR_PAD_LEFT) }}</span></p>
        </div>

        <hr style="opacity: 0.2; border: 0.5px solid #ccc; margin: 10px 0;">

        <!-- Billed By vs Billed To Cards -->
        <table style="width: 100%; border-spacing: 15px; border-collapse: separate; margin-left: -15px;">
            <tr>
                <td class="billing-card" style="width: 50%;">
                    <div class="client-details">
                        <p style="font-size: 1.15rem; font-weight: bold; padding-bottom: 2px; color: var(--brand-color);">Billed By</p>
                        <p>
                            <b>{{ $companyDetails->brand_name ?? 'Adzquare' }}</b><br>
                            A Unit of <b>{{ $companyDetails->company_name ?? 'Makku Enterprises' }}</b><br>
                            {{ $companyDetails->company_address_street ?? '' }}<br>
                            {{ $companyDetails->company_address_city ?? '' }} - {{ $companyDetails->company_address_pincode ?? '' }}<br>
                            {{ $companyDetails->company_address_state ?? '' }}, {{ $companyDetails->company_address_country ?? '' }}
                        </p>
                    </div>
                </td>
                <td class="billing-card" style="width: 50%;">
                    <div class="client-details">
                        <p style="font-size: 1.15rem; font-weight: bold; padding-bottom: 2px; color: var(--brand-color);">Prepared For</p>
                        @php
                            $addressParts = array_filter([$quotation->customer?->city, $quotation->customer?->pincode, $quotation->customer?->state, $quotation->customer?->country]);
                            $addressString = implode(', ', $addressParts);
                        @endphp
                        <p>
                            <b>{{ $quotation->customer?->name }}</b><br>
                            <b>{{ $quotation->customer?->company_name }}</b><br>
                            @if($quotation->customer?->street) {{ $quotation->customer->street }}<br> @endif
                            {{ $addressString ?: 'No address details available.' }}
                        </p>
                    </div>
                </td>
            </tr>
        </table>

        <p style="font-weight: bold; margin-bottom: 5px; margin-top: 10px;">Subject: Quotation for <span style="color: var(--brand-color);">{{ $quotation->service?->service_name ?? 'Proposed Services' }}</span></p>

        <!-- Proposals Description -->
        <div class="quotation-description">
            <div class="section-title">Proposal Details</div>
            {!! \Parsedown::instance()->text($quotation->content) !!}
        </div>

        <!-- Render Itemized Grid only if multi-service items exist -->
        @if (count($quoteItems) > 0)
            <div class="section-title">Multi-Service Line Items</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Sr No.</th>
                        <th style="width: 45%;">Items</th>
                        <th style="width: 10%;" class="right">Quantity</th>
                        <th style="width: 15%;" class="right">Rate</th>
                        <th style="width: 20%;" class="right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quoteItems as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item['name'] ?? 'N/A' }}</td>
                            <td class="right">{{ $item['quantity'] ?? 1 }}</td>
                            <td class="right">Rs. {{ number_format($item['price'] ?? 0, 2) }}</td>
                            <td class="right">Rs. {{ number_format($item['total'] ?? 0, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Totals & In-words block -->
        <table class="totals-section">
            <tr>
                <td class="total-in-words">
                    <b>Total in Words:</b> <span style="text-transform: uppercase;">{{ convertNumberToWordsForIndia((int) $grandTotal) }}</span>
                </td>
                <td style="width: 40%;">
                    <table class="totals-table">
                        <tr>
                            <td>Subtotal:</td>
                            <td>Rs. {{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td>CGST (9%):</td>
                            <td>Rs. {{ number_format($halfTax, 2) }}</td>
                        </tr>
                        <tr>
                            <td>SGST (9%):</td>
                            <td>Rs. {{ number_format($halfTax, 2) }}</td>
                        </tr>
                        <tr class="net-payable">
                            <td>Grand Total:</td>
                            <td>Rs. {{ number_format($grandTotal, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Dynamic Terms & Conditions block -->
        <div class="section-title" style="margin-top: 30px;">Terms & Conditions</div>
        <div style="font-size: 9.5px; line-height: 1.5; text-align: left;">
            @if (!empty($quotation->terms))
                <!-- Converts newlines to linebreaks while preserving safe formatting -->
                {!! nl2br(e($quotation->terms)) !!}
            @else
                <ol style="margin-top: 5px; padding-left: 20px;">
                    <li>Prices are valid for 30 days from the quotation date.</li>
                    <li>Payment terms: 50% upfront, 50% upon completion.</li>
                    <li>Any additional services requested will be quoted separately.</li>
                    <li>This quotation is subject to our standard terms of service.</li>
                    <li>All intellectual property rights for custom-developed materials remain with Adzquare until full payment is received.</li>
                </ol>
            @endif
        </div>

        <div style="margin-top: 35px; text-align: left; font-size: 10px;">
            <p>Thank you for considering our proposal.</p>
            <p style="margin-top: 10px;">Sincerely,</p>
            <p style="font-weight: bold; margin-top: 5px; color: var(--brand-color);">The Adzquare Team</p>
        </div>

    </div>

</body>
</html>
