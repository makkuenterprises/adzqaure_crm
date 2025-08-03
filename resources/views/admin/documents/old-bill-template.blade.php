<?php
function convertNumberToWordsForIndia($number)
{
    $number = (string) $number;

    $words = [
        '0' => '',
        '1' => 'one',
        '2' => 'two',
        '3' => 'three',
        '4' => 'four',
        '5' => 'five',
        '6' => 'six',
        '7' => 'seven',
        '8' => 'eight',
        '9' => 'nine',
        '10' => 'ten',
        '11' => 'eleven',
        '12' => 'twelve',
        '13' => 'thirteen',
        '14' => 'fouteen',
        '15' => 'fifteen',
        '16' => 'sixteen',
        '17' => 'seventeen',
        '18' => 'eighteen',
        '19' => 'nineteen',
        '20' => 'twenty',
        '30' => 'thirty',
        '40' => 'fourty',
        '50' => 'fifty',
        '60' => 'sixty',
        '70' => 'seventy',
        '80' => 'eighty',
        '90' => 'ninty',
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Invoice</title>

    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        main {
            height: auto;
            width: 100%;
            background-color: #fff;
        }

        section {
            border-radius: 5px;
            box-shadow: 0px 0px 7px #c4c6c7;
            background-color: #fff;
            padding: 35px;
        }

        th {
            text-align: left;
        }

        /* ======================================= */
/* CSS for the "PAID" stamp */
/* ======================================= */
.paid-stamp {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-20deg);
    color: #008000;
    border: 7px solid #008000;
    padding: 10px 30px;
    border-radius: 10px;
    font-size: 5rem;
    font-weight: bold;
    opacity: 0.2; /* Makes it semi-transparent */
    z-index: 99;  /* Ensures it's on top of other content */
    pointer-events: none; /* Makes the stamp un-clickable */
}
    </style>


</head>

<body>
    <main>

        <section style="position: relative;">
            @php
                $dueAmount = $bill->total + $bill->tax - $bill->received_amount - $bill->discount_amount;
            @endphp
            @if ($bill->payment_status === 'Paid' || $dueAmount <= 0)
                <div class="paid-stamp">PAID</div>
            @endif
            <div>
                <div>
                    <h2 style="font-size: 2.5rem; margin-bottom: 0px; color: #6738C7; font-weight: bold;">Invoice</h1>
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    <table class="ignore" style="font-size: 0.8rem;">
                                        <tr>
                                            <th style="width: 100px; padding-bottom: 5px; color: #5a5a5a;">Invoice No.
                                            </th>
                                            <td style="padding-bottom: 5px;  color: #000; font-weight: bolder;">
                                                #ADZ/{{ $bill->created_at->year }}/{{ $bill->id }}</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 100px; padding-bottom: 5px; color: #5a5a5a;">Invoice Date:
                                            </th>
                                            <td style="padding-bottom: 5px; color: #000; font-weight: bolder;">
                                                {{ date('d M Y', strtotime($bill->bill_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 100px; color: #5a5a5a;">Payment Due Date:</th>
                                            <td style="color: #000; font-weight: bolder;">
                                                {{ date('d M Y', strtotime($bill->due_date)) }}</td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- <td style="text-align: right;">
                                    <img src="admin/images/logo.png" alt="logo"
                                        style="height: 140px; width: auto
                            ; margin-left: auto;">
                                </td> --}}

                                <?php
                                $company_details = DB::table('company_details')->first();
                                ?>
                                <td style="text-align: right;">
                                    @if (!empty($company_details->brand_logo))
                                        <img src="{{ asset('admin/brand_logo/' . $company_details->brand_logo) }}"
                                            alt="brand_logo" style="height: 140px; width: auto; margin-left: auto;">
                                    @elseif (!empty($company_details->company_logo))
                                        <img src="{{ asset('admin/company_logo/' . $company_details->company_logo) }}"
                                            alt="company_logo" style="height: 140px; width: auto; margin-left: auto;">
                                    @else
                                    @endif
                                    <div style="font-weight: bold;">CIN: U72900BR2021PTC054492</div>
                                    <div>Since 2021</div>
                                </td>

                            </tr>
                        </table>
                </div>
                <hr style="opacity: 0.6; border: 0.5px solid #ccc;">
                <br>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%; padding-right: 10px;">
                            <div style="border-radius: 5px; overflow: hidden;">
                                <div style="padding: 20px; background-color: #f2ebfc;">
                                    <p style="font-size: 1.3rem; padding-bottom: 10px; color: #6738C7;"><b>Billed By</b>
                                    </p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;"><b
                                            style="color: #000;">{{ DB::table('company_details')->first()->brand_name }}</b>
                                    </p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;">A Unit of <b style="color: #000;">{{ DB::table('company_details')->first()->company_name }}</b></p>

                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;">
                                        {{ DB::table('company_details')->first()->company_address_street ?? '' }},
                                        </< /p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;">
                                        {{ DB::table('company_details')->first()->company_address_city ?? '' }} -
                                        {{ DB::table('company_details')->first()->company_address_pincode ?? '' }},
                                        {{ DB::table('company_details')->first()->company_address_state ?? '' }},
                                        {{ DB::table('company_details')->first()->company_address_country ?? '' }}
                                    </p>

                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;"><b
                                            style="color: #000;">Email</b> :
                                        {{ DB::table('company_details')->first()->company_email ?? '' }}
                                    </p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;"><b
                                            style="color: #000;">Phone</b> :
                                        {{ DB::table('company_details')->first()->company_phone ?? '' }}
                                    </p>

                                </div>
                            </div>
                        </td>
                        <td style="width: 50%; padding-left: 10px;">
                            <div style="border-radius: 5px; overflow: hidden;">
                                <div style="padding: 20px; background-color: #f2ebfc;">
                                    <p style="font-size: 1.3rem; padding-bottom: 10px; color: #6738C7;"><b>Billed To</b>
                                    </p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;"><b
                                            style="color: #000;">{{ $customer?->name }}</b></p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;"><b
                                            style="color: #000;">{{ $customer?->company_name }}</b></p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;">
                                        {{ $customer?->street }},</p>
                                    @php
                                        // Create an empty array to hold the parts of the address
                                        $addressParts = [];

                                        // Check each part of the address. If it exists, add it to the array.
                                        if ($customer?->city) {
                                            $addressParts[] = $customer->city;
                                        }
                                        if ($customer?->pincode) {
                                            $addressParts[] = $customer->pincode;
                                        }
                                        if ($customer?->state) {
                                            $addressParts[] = $customer->state;
                                        }
                                        if ($customer?->country) {
                                            $addressParts[] = $customer->country;
                                        }

                                        // Join the existing parts together with a comma and space
                                        $addressString = implode(', ', $addressParts);
                                    @endphp

                                    {{-- Now, check if the address string we built has any content --}}
                                    @if (!empty($addressString))
                                        {{-- IF an address exists, display it --}}
                                        <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;">
                                            {{ $addressString }}
                                        </p>
                                    @else
                                        {{-- ELSE, display a fallback message --}}
                                        <p style="font-size: 0.8rem; padding-bottom: 5px; color: #999; font-style: italic;">
                                            No address information available.
                                        </p>
                                    @endif
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;"><b
                                            style="color: #000;">Email</b> : {{ $customer?->email }},</p>
                                    <p style="font-size: 0.8rem; padding-bottom: 5px; color: #5a5a5a;"><b
                                            style="color: #000;">Phone</b> : {{ $customer?->phone }},</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: center; font-size: 1rem;"><b>Country of Supply</b>: India</td>
                        <td style="text-align: center; font-size: 1rem;"><b>Place of Supply</b>: Bihar</td>
                    </tr>
                </table>
                <br>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <div style="border-radius: 5px; overflow: hidden;">
                                <div style="padding: 0px;">
                                    <table style="width: 100%;" cellspacing="0" cellpadding="300">
                                        <thead style="background-color: #6738C7; border-color: #6738C7; color: #fff;">
                                            <tr>
                                                <th
                                                    style="width: 10%; padding: 12px; font-size: 0.8rem; text-align: left;">
                                                    Sr. No.</th>
                                                <th
                                                    style="width: 44%; padding: 12px; font-size: 0.8rem; text-align: left;">
                                                    Items</th>
                                                <th
                                                    style="width: 9%; padding: 12px; font-size: 0.8rem; text-align: left;">
                                                    Quantity</th>
                                                <th
                                                    style="width: 18%; padding: 12px; font-size: 0.8rem; text-align: right;">
                                                    Rate</th>
                                                <th
                                                    style="width: 19%; padding: 12px; font-size: 0.8rem; text-align: right;">
                                                    Amount</th>
                                            </tr>
                                        </thead>
                                       <tbody style="background-color: #f2ebfc;">
                                            {{-- Safer JSON decoding --}}
                                            @php
                                                $_items = json_decode($bill->items) ?? [];
                                            @endphp

                                            @if (!empty($_items))
                                                @foreach ($_items as $key => $bill_item)
                                                    <tr style="border-bottom: 1px solid #e0e0e0;">
                                                        <td style="width: 10%; padding: 12px; font-size: 0.8rem; text-align: left;">
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td style="width: 44%; padding: 12px; font-size: 0.8rem; text-align: left;">
                                                            {{ $bill_item->bill_item_name ?? 'N/A' }}
                                                        </td>
                                                        <td style="width: 9%; padding: 12px; font-size: 0.8rem; text-align: left;">
                                                            {{ $bill_item->bill_item_quantity ?? 'N/A' }}
                                                        </td>
                                                        <td style="width: 18%; padding: 12px; font-size: 0.8rem; text-align: right;">
                                                            Rs. {{ number_format($bill_item->bill_item_price ?? 0, 2) }}
                                                        </td>
                                                        <td style="width: 19%; padding: 12px; font-size: 0.8rem; text-align: right;">
                                                            Rs. {{ number_format($bill_item->bill_item_total ?? 0, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                        <tfoot style="margin-top: 20px;">
                                            {{-- Define the grand total once for consistency --}}
                                            @php
                                                $grandTotal = ($bill->total ?? 0) + ($bill->tax ?? 0) - ($bill->discount_amount ?? 0);
                                            @endphp

                                            {{-- Sub-Total Row (Optional but good practice) --}}
                                            <tr>
                                                <td style="padding: 12px; font-size: 0.8rem; text-align: right;" colspan="4">
                                                    Sub-Total:
                                                </td>
                                                <td style="padding: 12px; font-size: 0.8rem; text-align: right;">
                                                    Rs. {{ number_format($bill->total ?? 0, 2) }}
                                                </td>
                                            </tr>

                                            {{-- FIXED: Use a separate @if for Tax, so it always shows when present --}}
                                            @if($bill->tax > 0)
                                                <tr>
                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right;" colspan="4">
                                                        GST ({{ $bill->tax_percentage ?? '18' }}%):
                                                        {{-- Note: It's better to pass the tax percentage from your controller as $bill->tax_percentage --}}
                                                    </td>
                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right;">
                                                        Rs. {{ number_format($bill->tax, 2) }}
                                                    </td>
                                                </tr>
                                            @endif

                                            {{-- FIXED: Use a separate @if for Discount, so it always shows when present --}}
                                            @if($bill->discount_amount > 0)
                                                <tr>
                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right;" colspan="4">
                                                        (-) Discount:
                                                    </td>
                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right;">
                                                        Rs. {{ number_format($bill->discount_amount, 2) }}
                                                    </td>
                                                </tr>
                                            @endif



                                            {{-- Final Grand Total Row --}}
                                            <tr>
                                                <td colspan="3" style="padding: 12px; font-size: 0.8rem; text-align: left; font-weight: bold;">
                                                    {{-- FIXED: Calculate words on the final Grand Total --}}
                                                    Total in Words : <span style="text-transform: uppercase;">{{ convertNumberToWordsForIndia((int) $grandTotal) }}</span>
                                                </td>
                                                <th style="padding: 12px; font-size: 1rem; text-align: right; border-top: 2px solid #000; border-bottom: 2px solid #000;" colspan="1">
                                                    Net Payable:
                                                </th>
                                                <th style="padding: 12px; font-size: 1rem; text-align: right; border-top: 2px solid #000; border-bottom: 2px solid #000;">
                                                    {{-- FIXED: Use the consistent Grand Total variable --}}
                                                    Rs. {{ number_format($grandTotal, 2) }}
                                                </th>
                                            </tr>
                                             @if($bill->received_amount > 0)
                                                <tr>
                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right;" colspan="4">
                                                        (-) Received Amount:
                                                    </td>
                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right;">
                                                        Rs. {{ number_format($bill->received_amount, 2) }}
                                                    </td>

                                                </tr>
                                            @endif
                                            @if($bill->received_amount > 0)
                                                <tr>
                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right;" colspan="4">
                                                        Due Amount:
                                                    </td>

                                                    <td style="padding: 12px; font-size: 0.8rem; text-align: right; font-weight: bold;" {{ ($bill->net_payable - $bill->received_amount) > 0 ? 'text-danger' : 'text-success' }}">
                                                        Rs.{{ number_format($bill->total + $bill->tax - $bill->received_amount - $bill->discount_amount, 2) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%; padding-right: 10px;">
                            <div style="border-radius: 5px; overflow: hidden;">
                                <div style="padding: 20px; background-color: #f2ebfc;">
                                    <p style="font-size: 1.1rem; padding-bottom: 12px; color: #6738C7;"><b>Payment
                                            Details</b></p>
                                    <table>
                                        <tr>
                                            <th
                                                style="font-size: 0.8rem; padding-bottom: 5px; color: #000; padding-right: 10px;">
                                                Account No. </th>
                                            <td style="font-size: 0.8rem; padding-bottom: 5px; color: #000;">
                                                {{ DB::table('company_details')->first()->company_account_no ?? '' }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th
                                                style="font-size: 0.8rem; padding-bottom: 5px; color: #000; padding-right: 10px;">
                                                Account Holder </th>
                                            <td style="font-size: 0.8rem; padding-bottom: 5px; color: #000;">
                                                {{ DB::table('company_details')->first()->company_account_holder ?? '' }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th
                                                style="font-size: 0.8rem; padding-bottom: 5px; color: #000; padding-right: 10px;">
                                                IFCS Code </th>
                                            <td style="font-size: 0.8rem; padding-bottom: 5px; color: #000;">
                                                {{ DB::table('company_details')->first()->company_account_ifsc ?? '' }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th
                                                style="font-size: 0.8rem; padding-bottom: 5px; color: #000; padding-right: 10px;">
                                                Bank Branch </th>
                                            <td style="font-size: 0.8rem; padding-bottom: 5px; color: #000;">
                                                {{ DB::table('company_details')->first()->company_account_branch ?? '' }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th
                                                style="font-size: 0.8rem; padding-bottom: 5px; color: #000; padding-right: 10px;">
                                                VPA (UPI) </th>
                                            <td style="font-size: 0.8rem; padding-bottom: 5px; color: #000;">
                                                {{ DB::table('company_details')->first()->company_account_vpa ?? '' }}
                                            </td>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </td>
                        <td style="width: 50%; padding-left: 10px;">

                        </td>
                    </tr>
                </table>
                <br>
                <hr style="opacity: 0.6; border: 0.5px solid #ccc;">
                @if (!is_null($bill->bill_note))
                    <br>
                    <div>
                        <p style="padding-bottom: 5px; font-size: 0.9rem;">Note : </p>
                        <p style="padding-bottom: 5px; font-size: 0.8rem; color:#2d2d2d; line-height: 1.2rem;">
                            {{ $bill->bill_note }}</p>
                    </div>
                @endif


            </div>
        </section>
    </main>


    <div style="text-align: center; position: absolute; bottom: 5px; left: 50%; transform: translate(-50%,-50%);">
        <p>Adzquare Powered by Makku Enterprises Pvt. Ltd</p>
        <p style="font-size: 0.6rem; color: #7d7d7d; margin-top: 10px;">This is electronically generated document. No
            signature is
            required.</p>
    </div>


</body>

</html>
