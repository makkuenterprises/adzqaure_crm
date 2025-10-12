<?php
function convertNumberToWordsForIndia($number)
{
    // ... (Your existing PHP function remains the same)
    $number = (string) $number;

    $words = [
        '0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fourteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'forty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninety',
    ];

    $number_length = strlen($number);
    $number_array = [0, 0, 0, 0, 0, 0, 0, 0, 0];
    $received_number_array = [];

    for ($i = 0; $i < $number_length; $i++) {
        $received_number_array[$i] = substr($number, $i, 1);
    }

    for ($i = 9 - $number_length, $j = 0; $i < 9; $i++, $j++) {
        $number_array[$i] = $received_number_array[$j];
    }

    $number_to_words_string = '';

    for ($i = 0, $j = 1; $i < 9; $i++, $j++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            if ($number_array[$j] == 0 || $number_array[$i] == '1') {
                $number_array[$j] = intval($number_array[$i]) * 10 + $number_array[$j];
                $number_array[$i] = 0;
            }
        }
    }

    $value = '';
    for ($i = 0; $i < 9; $i++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            $value = $number_array[$i] * 10;
        } else {
            $value = $number_array[$i];
        }
        if ($value != 0) {
            $number_to_words_string .= $words["$value"] . ' ';
        }
        if ($i == 1 && $value != 0) {
            $number_to_words_string .= 'Crores ';
        }
        if ($i == 3 && $value != 0) {
            $number_to_words_string .= 'Lakhs ';
        }
        if ($i == 5 && $value != 0) {
            $number_to_words_string .= 'Thousand ';
        }
        if ($i == 6 && $value != 0) {
            $number_to_words_string .= 'Hundred & ';
        }
    }
    if ($number_length > 9) {
        $number_to_words_string = 'Sorry This does not support more than 99 Crores';
    }
    return ucwords(strtolower($number_to_words_string) . ' Only');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9.5px;
            color: #333;
            padding: 1.5cm;
            line-height: 1.3;
        }
        .header, .footer {
            position: fixed;
            left: 1.5cm;
            right: 1.5cm;
            width: calc(100% - 3cm);
        }
        .header { top: 1.5cm; height: 2.5cm; }
        .footer { bottom: 1.5cm; height: 1.5cm; text-align: center; }
        .header-bg, .footer-bg { position: fixed; z-index: -10; left: 0; right: 0; width: 100%;}
        .header-bg { top: 0; height: 120px; }
        .footer-bg { bottom: 0; height: 100px; }

        table { width: 100%; border-collapse: collapse; }
        th, td { vertical-align: top; }
        th { text-align: left; font-weight: bold; }

        .invoice-meta { font-size: 0.9em; }
        .invoice-meta th {
            font-weight: normal;
            color: #555;
            width: 80px;
            padding: 0;
        }
        .invoice-meta td {
            font-weight: bold;
            padding: 0;
            white-space: nowrap;
        }

        .address-block { line-height: 1.25; }
        .address-block b { font-weight: bold; }
        .address-block .heading {
            font-size: 1.2rem;
            font-weight: bold;
            padding-bottom: 2px;
            color: #f54f25;
            line-height: normal;
        }

        .billing-card {
            background-color: #fcedea;
            padding: 12px;
            border-radius: 8px;
        }
        .billing-card table th, .billing-card table td { padding: 1.2px 0; }
        .payment-details th { width: 100px; }

        .items-table {
            margin-top: 15px;
            font-size: 0.8rem;
            border-radius: 15px;
        }
        .items-table thead { background-color: #f54f25; color: #fff; }
        .items-table th { padding: 8px; font-weight: bold; }
        .items-table tbody { background-color: #fcedea; }
        .items-table td { padding: 8px; }
        .items-table .right { text-align: right; }

        .totals-section { margin-top: 20px; }
        .totals-table td { padding: 2px 5px; text-align: right; }
        .totals-table tr.net-payable td {
            font-size: 12px;
            font-weight: bold;
            padding-top: 8px;
            padding-bottom: 8px;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
        }
        .totals-table tr.due-amount td { font-weight: bold; }
        .total-in-words {
            font-size: 0.9rem;
            vertical-align: bottom;
            padding: 10px 0;
        }

        /* NEW: Styles for the signature block */
        .signature-block {
            text-align: center;
        }
        .signature-block .signature-line {
            border-top: 1px solid #555;
            width: 80%;
            margin: 10px auto 5px auto;
        }
        .signature-block p {
            line-height: 1.2;
            margin: 0;
        }

        .signature-type {
        font-family: 'karstar';
        font-size: 18px;
    }

    </style>
</head>
<body>
    <img class="header-bg" src="{{ public_path('admin_new/images/header-bg.png') }}">
    <img class="footer-bg" src="{{ public_path('admin_new/images/footer-bg.png') }}">

    <div class="header">
        <table style="width: 100%;">
            <tr>
                <td style="width: 40%; text-align: right; vertical-align: middle;">
                    <img src="{{ public_path('admin_new/images/logo-full.png') }}" alt="Logo" style="max-height: 45px;">
                    <p style="font-weight: bold; font-size: 0.6rem; margin-top: 3px;">CIN: U72900BR2021PTC054492</p>
                </td>
            </tr>
        </table>
    </div>

    <main>
        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td style="width: 60%;">
                    <table class="invoice-meta">
                        <tr>
                            <td><h1 style="font-size: 2.2rem; margin: 0; color: #f54f25; font-weight: bold;">INVOICE</h1></td>
                        </tr>
                        <tr>
                            <th>Invoice No:</th>
                            <td>#ADZ/{{ $bill->created_at->year }}/{{ $bill->id }}</td>
                        </tr>
                        <tr>
                            <th>Invoice Date:</th>
                            <td>{{ date('d M Y', strtotime($bill->bill_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Due Date:</th>
                            <td>{{ date('d M Y', strtotime($bill->due_date)) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 40%;"></td>
            </tr>
        </table>

        <hr style="opacity: 0.2; border: 0.5px solid #ccc; margin: 10px 0;">

        <table style="width: 100%; border-spacing: 15px; border-collapse: separate;">
            <tr>
                <td class="billing-card" style="width: 50%;">
                    <div class="address-block">
                        <p class="heading">Billed By</p>
                        <p>
                            <b>{{ DB::table('company_details')->first()->brand_name }}</b><br>
                            A Unit of <b>{{ DB::table('company_details')->first()->company_name }}</b><br>
                            {{ DB::table('company_details')->first()->company_address_street ?? '' }}<br>
                            {{ DB::table('company_details')->first()->company_address_city ?? '' }} - {{ DB::table('company_details')->first()->company_address_pincode ?? '' }}<br>
                            {{ DB::table('company_details')->first()->company_address_state ?? '' }}, {{ DB::table('company_details')->first()->company_address_country ?? '' }}
                        </p>
                        <p style="margin-top: 6px;">
                            <b>Email:</b> {{ DB::table('company_details')->first()->company_email ?? '' }}<br>
                            <b>Phone:</b> {{ DB::table('company_details')->first()->company_phone ?? '' }}
                        </p>
                    </div>
                </td>
                <td style="width: 5%;"></td>
                <td class="billing-card" style="width: 50%;">
                    <div class="address-block">
                        <p class="heading">Billed To</p>
                        @php
                            $addressParts = array_filter([$customer?->city, $customer?->pincode, $customer?->state, $customer?->country]);
                            $addressString = implode(', ', $addressParts);
                        @endphp
                        <p>
                            <b>{{ $customer?->name }}</b><br>
                            <b>{{ $customer?->company_name }}</b><br>
                            @if($customer?->street) {{ $customer->street }}<br> @endif
                            @if(!empty($addressString))
                                {{ $addressString }}
                            @else
                                <span style="color: #999; font-style: italic;">No address information available.</span>
                            @endif
                        </p>
                        <p style="margin-top: 6px;">
                            <b>Email:</b> {{ $customer?->email }}<br>
                            <b>Phone:</b> {{ $customer?->phone }}
                        </p>
                    </div>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 10%;">Sr No.</th>
                    <th style="width: 40%;">Items</th>
                    <th style="width: 10%;" class="right">Quantity</th>
                    <th style="width: 20%;" class="right">Rate</th>
                    <th style="width: 20%;" class="right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php $_items = json_decode($bill->items) ?? []; @endphp
                @forelse ($_items as $key => $bill_item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $bill_item->bill_item_name ?? 'N/A' }}</td>
                        <td class="right">{{ $bill_item->bill_item_quantity ?? 'N/A' }}</td>
                        <td class="right">Rs. {{ number_format($bill_item->bill_item_price ?? 0, 2) }}</td>
                        <td class="right">Rs. {{ number_format($bill_item->bill_item_total ?? 0, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="padding: 20px; text-align: center; color: #777;">No items in this invoice.</td></tr>
                @endforelse
            </tbody>
        </table>

        <table class="totals-section">
            <tr>
                <td class="total-in-words">
                    @php $grandTotal = ($bill->total ?? 0) + ($bill->tax ?? 0) - ($bill->discount_amount ?? 0); @endphp
                    <b>Total in Words:</b> <span style="text-transform: uppercase;">{{ convertNumberToWordsForIndia((int) $grandTotal) }}</span>
                </td>
                <td style="width: 40%;">
                    <table class="totals-table">
                        <tr>
                            <td>Sub-Total:</td>
                            <td>Rs. {{ number_format($bill->total ?? 0, 2) }}</td>
                        </tr>
                        <!-- MODIFIED: GST breakdown -->
                        @if($bill->tax > 0)
                            @php
                                $taxPercentage = $bill->tax_percentage ?? 18;
                                $halfTaxPercentage = $taxPercentage / 2;
                                $halfTaxAmount = $bill->tax / 2;
                            @endphp
                            <tr>
                                <td>CGST ({{ $halfTaxPercentage }}%):</td>
                                <td>Rs. {{ number_format($halfTaxAmount, 2) }}</td>
                            </tr>
                            <tr>
                                <td>SGST ({{ $halfTaxPercentage }}%):</td>
                                <td>Rs. {{ number_format($halfTaxAmount, 2) }}</td>
                            </tr>
                        @endif
                        @if($bill->discount_amount > 0)
                            <tr>
                                <td>(-) Discount:</td>
                                <td>Rs. {{ number_format($bill->discount_amount, 2) }}</td>
                            </tr>
                        @endif
                        <tr class="net-payable">
                            <td>Net Payable:</td>
                            <td>Rs. {{ number_format($grandTotal, 2) }}</td>
                        </tr>
                        @if($bill->received_amount > 0)
                            <tr>
                                <td>(-) Received Amount:</td>
                                <td>Rs. {{ number_format($bill->received_amount, 2) }}</td>
                            </tr>
                            <tr class="due-amount">
                                <td>Due Amount:</td>
                                @php $dueAmount = $grandTotal - $bill->received_amount; @endphp
                                <td>Rs. {{ number_format($dueAmount, 2) }}</td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>

        <table style="margin-top: 25px;">
            <tr>
                <td class="billing-card payment-details" style="width: 50%;">
                     <p class="heading">Payment Details</p>
                     <table>
                         <tr><th>Account No:</th><td>{{ DB::table('payment_settings')->first()->company_account_number_inr ?? '' }}</td></tr>
                         <tr><th>Account Holder:</th><td>{{ DB::table('payment_settings')->first()->company_account_holder_inr ?? '' }}</td></tr>
                         <tr><th>IFSC Code:</th><td>{{ DB::table('payment_settings')->first()->company_account_ifsc_inr ?? '' }}</td></tr>
                         <tr><th>Bank Branch:</th><td>{{ DB::table('payment_settings')->first()->company_account_branch_inr ?? '' }}</td></tr>
                         <tr><th>VPA (UPI):</th><td>{{ DB::table('payment_settings')->first()->upi_payment_inr ?? '' }}</td></tr>
                         <tr><th>Payment Link:</th><td>{{ DB::table('payment_settings')->first()->payment_link_inr ?? '' }}</td></tr>
                     </table>
                </td>
                <!-- NEW: Authorized Signatory block -->
                <td style="width: 50%; vertical-align: bottom;">
                    <div class="signature-block">
                        <p class="signature-type" style="font-size: 16px;">Rekha Devi</p>
                        <div class="signature-line"></div>
                        <p><b>For {{ DB::table('company_details')->first()->brand_name }}</b></p>
                        <p>(Authorized Signatory)</p>
                    </div>
                </td>
            </tr>
        </table>

        @if (!is_null($bill->bill_note))
            <div style="margin-top: 20px;">
                <p><b>Note:</b> {{ $bill->bill_note }}</p>
            </div>
        @endif
    </main>

    <div class="footer">
        <p style="font-size: 0.8rem; margin:0;">Adzquare Powered by Makku Enterprises Pvt. Ltd</p>
        <p style="font-size: 0.7rem; color: #7d7d7d; margin-top: 4px;">This is an electronically generated document. No signature is required.</p>
    </div>
</body>
</html>
