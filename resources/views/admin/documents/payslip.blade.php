<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            background-color: #fdfdfd;
        }
        .payslip-container {
            width: 210mm; /* A4 width */
            min-height: 297mm; /* A4 height */
            margin: 0 auto;
            position: relative;
            padding: 1cm;
            box-sizing: border-box;
        }
        .header-bg, .footer-bg {
            position: absolute;
            z-index: -1;
            left: 0;
            right: 0;
            width: 100%;
        }
        .header-bg { top: 0; height: 120px; }
        .footer-bg { bottom: 0; height: 100px; }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 6px 8px;
            vertical-align: top;
        }

        /* --- Header Section --- */
        .header-table td {
            vertical-align: middle;
            padding-bottom: 10px;
        }
        .company-name {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .company-sub {
            font-size: 12px;
            margin: 2px 0 0 0;
        }
        .logo {
            max-height: 40px;
            float: right;
        }
        .payslip-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            padding: 8px 0;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            margin-bottom: 15px;
        }

        /* --- Employee Summary Section --- */
        .summary-container {
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
        .summary-title {
            background-color: #f0f0f0;
            padding: 8px;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
        }
        .summary-content {
            padding: 10px;
        }
        .details-table th {
            text-align: left;
            font-weight: normal;
            color: #555;
            width: 110px;
        }
        .details-table td {
            font-weight: bold;
        }
        .net-pay-box {
            border: 1px solid #ccc;
            text-align: center;
            padding: 15px;
            height: 100%;
            box-sizing: border-box;
        }
        .net-pay-box .label {
            font-size: 12px;
            margin-bottom: 5px;
        }
        .net-pay-box .amount {
            font-size: 28px;
            font-weight: bold;
            margin: 5px 0;
        }
        .net-pay-box .sub-text {
            font-size: 10px;
            color: #555;
        }

        /* --- Earnings & Deductions Tables --- */
        .main-table, .calculation-table {
            border: 1px solid #ccc;
        }
        .main-table th, .main-table td,
        .calculation-table th, .calculation-table td {
            border: 1px solid #ccc;
        }
        .main-table thead th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .main-table .right, .calculation-table .right {
            text-align: right;
        }
        .main-table tfoot td, .calculation-table .total-row td {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        /* --- Final Summary --- */
        .final-summary {
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .final-summary p { margin: 3px 0; }
        .final-summary .formula { font-size: 9px; color: #777; font-style: italic; }

        .disclaimer {
            text-align: center;
            font-size: 9px;
            color: #999;
            margin-top: 20px;
            font-style: italic;
        }

        /* --- Footer Contact Info --- */
        .footer-contact {
            position: absolute;
            bottom: 1cm;
            left: 1cm;
            right: 1cm;
            width: calc(100% - 2cm);
        }
        .footer-contact td {
            text-align: center;
            font-size: 11px;
            color: #333;
        }
        .footer-contact .icon {
            font-size: 14px;
            color: #f54f25;
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="payslip-container">
        <!-- Placeholder background images -->
        <img class="header-bg" src="{{ public_path('admin_new/images/payslip-header-bg.png') }}" alt="">
        <img class="footer-bg" src="{{ public_path('admin_new/images/payslip-footer-bg.png') }}" alt="">

        <header>
            <table class="header-table">
                <tr>
                    <td>
                        <p class="company-name">Makku Enterprises Pvt. Ltd.</p>
                        <p class="company-sub">India</p>
                    </td>
                    <td>
                        <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" class="logo">
                    </td>
                </tr>
            </table>
            <div class="payslip-title">Payslip for the month of December 2024</div>
        </header>

        <main>
            <div class="summary-container">
                <div class="summary-title">EMPLOYEE PAY SUMMARY</div>
                <div class="summary-content">
                    <table>
                        <tr>
                            <td style="width: 60%; vertical-align: top;">
                                <table class="details-table">
                                    <tr>
                                        <th>Employee Name</th>
                                        <td>: Ayush Kumar Singh, ADZ024</td>
                                    </tr>
                                    <tr>
                                        <th>Designation</th>
                                        <td>: Digital Marketing Executive</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Joining</th>
                                        <td>: 30/06/2020</td>
                                    </tr>
                                    <tr>
                                        <th>Pay Period</th>
                                        <td>: December 2023</td>
                                    </tr>
                                    <tr>
                                        <th>Pay Date</th>
                                        <td>: 31/01/2024</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 40%; vertical-align: top;">
                                <div class="net-pay-box">
                                    <p class="label">Employee Net Pay</p>
                                    <p class="amount">₹14,700.00</p>
                                    <p class="sub-text">Paid Days : 31 | LOP Days : 0</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <table class="main-table">
                <thead>
                    <tr>
                        <th style="width: 25%;">EARNINGS</th>
                        <th style="width: 12.5%;">AMOUNT</th>
                        <th style="width: 12.5%;">YTD</th>
                        <th style="width: 25%;">DEDUCTIONS</th>
                        <th style="width: 12.5%;">AMOUNT</th>
                        <th style="width: 12.5%;">YTD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Basic</td>
                        <td class="right">₹7,700.00</td>
                        <td class="right">₹7,700.00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>House Rent Allowance</td>
                        <td class="right">₹5,000.00</td>
                        <td class="right">₹5,000.00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Fixed Allowance</td>
                        <td class="right">₹2,000.00</td>
                        <td class="right">₹2,000.00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Gross Earning</td>
                        <td class="right">₹14,700.00</td>
                        <td></td>
                        <td>Total Deductions</td>
                        <td class="right">₹0.00</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <table class="calculation-table" style="margin-top: -1px;">
                <tr>
                    <td style="border: none; font-weight: bold; width: 50%;">NET PAY</td>
                    <td style="width: 25%;"></td>
                    <td style="width: 25%; font-weight: bold; text-align: center;">AMOUNT</td>
                </tr>
                <tr>
                    <td style="border: none; width: 50%;"></td>
                    <td>Gross Earnings</td>
                    <td class="right">₹14,700.00</td>
                </tr>
                <tr>
                    <td style="border: none; width: 50%;"></td>
                    <td>Total Deductions</td>
                    <td class="right">(-) ₹0.00</td>
                </tr>
                <tr class="total-row">
                    <td style="border: none; width: 50%;"></td>
                    <td>Total Net Payable</td>
                    <td class="right">₹14,700.00</td>
                </tr>
            </table>

            <div class="final-summary">
                <p>Total Net Payable <b>₹14,700.00</b> (Indian Rupee Fourteen Thousand Seven Hundred Only)</p>
                <p class="formula">**Total Net Payable = Gross Earnings - Total Deductions</p>
            </div>

            <div class="disclaimer">
                -- This document has been automatically generated; therefore, a signature is not required. --
            </div>
        </main>

        <div class="footer-contact">
            <table>
                <tr>
                    <td style="width: 33.3%;">
                        <span class="icon">☎</span> +91-9304878684
                    </td>
                    <td style="width: 33.3%;">
                        <span class="icon"></span> Patna | Delhi
                    </td>
                    <td style="width: 33.3%;">
                        <span class="icon">✉</span> hello@adzquare.com
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
