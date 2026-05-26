
<?php
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
    <meta charset="UTF-8">
    <title>Payslip - {{ $payslip->employee->name }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0.8cm;
        }
        body {
            font-family: 'Helvetica Neue', 'Helvetica', 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.4;
            background-color: #ffffff;
        }

        /* --- Header Styles --- */
        .header-table {
            width: 100%;
            margin-bottom: 12px;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #111;
        }
        .company-sub {
            font-size: 10px;
            color: #555;
            margin: 2px 0 0 0;
        }
        .logo-img {
            max-height: 42px;
            float: right;
        }

        /* --- Document Title --- */
        .title-bar {
            width: 100%;
            border: 1px solid #777;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            font-weight: bold;
            background-color: #ffffff;
            margin-bottom: 12px;
        }

        /* --- Employee & Pay summary block --- */
        .summary-box {
            width: 100%;
            border: 1px solid #777;
            margin-bottom: 12px;
        }
        .summary-header {
            font-weight: bold;
            padding: 6px 8px;
            border-bottom: 1px solid #777;
            background-color: #f2f2f2;
        }
        .summary-body {
            width: 100%;
        }
        .summary-body td {
            padding: 8px;
            vertical-align: top;
        }
        .details-table {
            width: 100%;
        }
        .details-table th {
            text-align: left;
            font-weight: normal;
            color: #444;
            width: 110px;
            padding: 3px 0;
        }
        .details-table td {
            font-weight: bold;
            padding: 3px 0;
        }

        .net-pay-inner {
            text-align: center;
            padding-top: 10px;
        }
        .net-pay-inner .label {
            font-size: 11px;
            color: #444;
            margin-bottom: 3px;
        }
        .net-pay-inner .amount {
            font-size: 26px;
            font-weight: bold;
            margin: 4px 0;
            color: #111;
        }
        .net-pay-inner .sub-text {
            font-size: 10px;
            color: #555;
            margin-top: 3px;
        }

        /* --- Grid & Calculation tables --- */
        .earnings-table, .calc-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #777;
        }
        .earnings-table th, .earnings-table td {
            border: 1px solid #777;
            padding: 6px 8px;
        }
        .earnings-table thead th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 10px;
        }
        .earnings-table tfoot td {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }

        /* Calculation section */
        .calc-table {
            margin-top: -1px; /* collapse border with the top table */
        }
        .calc-table td {
            border: 1px solid #777;
            padding: 6px 8px;
        }
        .calc-table .header-row td {
            font-weight: bold;
        }
        .calc-table .total-row td {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        /* --- Footer Info Block --- */
        .final-summary-box {
            border: 1px solid #777;
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            margin-top: 12px;
        }
        .final-summary-box p {
            margin: 2px 0;
            font-size: 11px;
        }
        .final-summary-box .formula {
            font-size: 8.5px;
            color: #777;
            margin-top: 4px;
        }

        .generated-text {
            text-align: center;
            font-size: 8.5px;
            color: #777;
            margin-top: 15px;
        }

        /* Contact Details Footer bar */
        .contact-footer {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        .contact-footer td {
            width: 33.33%;
            text-align: center;
            font-size: 9.5px;
            color: #222;
            padding: 4px 0;
            border: none;
        }
        .contact-icon {
            color: #f54f25;
            font-weight: bold;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    @php
        // Dynamically calculate pro-rata values based on Present Days to display in grid
        $payableDays = $payslip->present_days + $payslip->paid_leaves + ($payslip->half_days * 0.5);
        $dailyBasic = $payslip->basic_salary / $payslip->total_days;
        $earnedBasic = $dailyBasic * $payableDays;

        $dailyAllowance = $payslip->allowances / $payslip->total_days;
        $earnedAllowances = $dailyAllowance * $payableDays;
    @endphp

    <!-- Top Letterhead Header -->
    <table class="header-table">
        <tr>
            <td style="vertical-align: middle;">
                <p class="company-name">{{ $company->brand_name ?? 'Makku Enterprises Pvt. Ltd.' }}</p>
                <p class="company-sub">India</p>
            </td>
            <td style="text-align: right; vertical-align: middle;">
                <img src="{{ public_path('admin_new/images/logo-full.png') }}" class="logo-img" alt="Logo">
            </td>
        </tr>
    </table>

    <!-- Month Title Bar -->
    <div class="title-bar">
        Payslip for the month of {{ \Carbon\Carbon::create()->month($payslip->month)->format('F') }} {{ $payslip->year }}
    </div>

    <!-- Employee summary parameters -->
    <div class="summary-box">
        <div class="summary-header">EMPLOYEE PAY SUMMARY</div>
        <table class="summary-body">
            <tr>
                <td style="width: 55%; border-right: 1px solid #777;">
                    <table class="details-table">
                        <tr>
                            <th>Employee Name</th>
                            <td>: {{ $payslip->employee->name }}, {{ $payslip->employee->employee_id ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>: {{ $payslip->employee->designation ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Date of Joining</th>
                            <td>: {{ $payslip->employee->date_of_joining ? \Carbon\Carbon::parse($payslip->employee->date_of_joining)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Pay Period</th>
                            <td>: {{ \Carbon\Carbon::create()->month($payslip->month)->format('F') }} {{ $payslip->year }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 45%; vertical-align: middle;">
                    <div class="net-pay-inner">
                        <p class="label">Employee Net Pay</p>
                        <p class="amount">Rs. {{ number_format($payslip->net_salary, 2) }}</p>
                        <p class="sub-text">Paid Days: {{ $payableDays }} | LOP Days: {{ $payslip->absent_days }}</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Earnings & Deductions grid layout table -->
    <table class="earnings-table">
        <thead>
            <tr>
                <th style="width: 25%; text-align: left;">EARNINGS</th>
                <th style="width: 15%;" class="text-right">AMOUNT</th>
                <th style="width: 10%;" class="text-right">YTD</th>
                <th style="width: 25%; text-align: left;">DEDUCTIONS</th>
                <th style="width: 15%;" class="text-right">AMOUNT</th>
                <th style="width: 10%;" class="text-right">YTD</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left;">Basic</td>
                <td class="text-right">Rs. {{ number_format($earnedBasic, 2) }}</td>
                <td class="text-right">Rs. {{ number_format($earnedBasic, 2) }}</td>
                <td style="text-align: left;">
                    @if($payslip->deductions > 0) Professional Tax @endif
                </td>
                <td class="text-right">
                    @if($payslip->deductions > 0) Rs. {{ number_format($payslip->deductions, 2) }} @endif
                </td>
                <td class="text-right">
                    @if($payslip->deductions > 0) Rs. {{ number_format($payslip->deductions, 2) }} @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: left;">House Rent Allowance</td>
                <td class="text-right">Rs. {{ number_format($earnedAllowances / 2, 2) }}</td>
                <td class="text-right">Rs. {{ number_format($earnedAllowances / 2, 2) }}</td>
                <td style="border-bottom: none;"></td>
                <td style="border-bottom: none;"></td>
                <td style="border-bottom: none;"></td>
            </tr>
            <tr>
                <td style="text-align: left;">Fixed Allowance</td>
                <td class="text-right">Rs. {{ number_format($earnedAllowances / 2, 2) }}</td>
                <td class="text-right">Rs. {{ number_format($earnedAllowances / 2, 2) }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: left;">Gross Earning</td>
                <td class="text-right">Rs. {{ number_format($earnedBasic + $earnedAllowances, 2) }}</td>
                <td></td>
                <td style="text-align: left;">Total Deductions</td>
                <td class="text-right">Rs. {{ number_format($payslip->deductions, 2) }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- Net calculation layout -->
    <table class="calc-table">
        <tr class="header-row">
            <td style="border: none; width: 50%; text-align: left;">NET PAY</td>
            <td style="width: 25%; text-align: left;"></td>
            <td style="width: 25%; text-align: right;">AMOUNT</td>
        </tr>
        <tr>
            <td style="border: none; width: 50%;"></td>
            <td style="text-align: left;">Gross Earnings</td>
            <td class="text-right">Rs. {{ number_format($earnedBasic + $earnedAllowances, 2) }}</td>
        </tr>
        <tr>
            <td style="border: none; width: 50%;"></td>
            <td style="text-align: left;">Total Deductions</td>
            <td class="text-right">(-) Rs. {{ number_format($payslip->deductions, 2) }}</td>
        </tr>
        <tr class="total-row">
            <td style="border: none; width: 50%;"></td>
            <td style="text-align: left;">Total Net Payable</td>
            <td class="text-right">Rs. {{ number_format($payslip->net_salary, 2) }}</td>
        </tr>
    </table>

    <!-- Net words & totals box -->
    <div class="final-summary-box">
        <p>Total Net Payable <b>Rs. {{ number_format($payslip->net_salary, 2) }}</b> ({{ convertNumberToWordsForIndia($payslip->net_salary) }})</p>
        <p class="formula">*Total Net Payable = Gross Earnings - Total Deductions</p>
    </div>

    <!-- Electronically generated disclaimer text -->
    <div class="generated-text">
        -- This document has been automatically generated; therefore, a signature is not required. --
    </div>

    <!-- Contact details footer -->
    <table class="contact-footer">
        <tr>
            <td>
                <span class="contact-icon">Phone:</span> {{ $company->company_phone ?? '+91-9304878684' }}
            </td>
            <td>
                <span class="contact-icon">Address:</span> Patna | Delhi
            </td>
            <td>
                <span class="contact-icon">Email:</span> {{ $company->company_email ?? 'info@adzquare.in' }}
            </td>
        </tr>
    </table>

</body>
</html>
