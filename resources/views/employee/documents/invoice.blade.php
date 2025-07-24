<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <title>Invoico</title>
    <style>
        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }

        body {
            background: #F8F9FD;
            width: auto;
            height: 100%;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        a:focus,
        a {
            outline: none;
            text-decoration: none;
            color: #ffffff;
            cursor: pointer;
        }

        svg,
        img {
            vertical-align: middle;
        }

        section {
            padding: 50px 0;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .mtb-0 {
            margin-bottom: 0;
            margin-top: 0;
        }

        .medium-font {
            font-size: 16px;
            line-height: 24px;
        }

        .md-lg-font {
            font-size: 20px;
            line-height: 24px;
        }

        .sm-text {
            font-size: 18px;
            line-height: 24px;
        }

        .sm-md-text {
            font-size: 14px;
            line-height: 22px;
        }

        .b-text {
            color: #12151C;
        }

        .second-color {
            color: #888888;
        }

        .primary-color {
            color: #00BAFF;
        }

        /************************* 2.Header CSS **************************/

        .inter-400 {
            font-weight: 400;
        }

        .inter-700 {
            font-weight: 700;
        }

        .inter-500 {
            font-weight: 500;
        }

        .invoice-container {
            max-width: 880px;
            margin: 0 auto;
            padding: 30px 15px;
        }

        .content-min-width {
            background: #12151C;
            border-radius: 20px 20px 0 0;
            padding: 50px 50px 30px;
        }

        .logo img {
            height: 60px;
            width: auto;
        }

        .invoice-logo-content {
            display: flex;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: space-between;
            align-items: center;
        }

        .invo-head-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-content-wrap {
            background: #fff;
            position: relative;
            height: 100%;
            width: 100%;
        }

        .invo-num-title {
            width: 60%;
        }

        .invo-no {
            width: 50%;
            font-size: 16px;
            line-height: 24px;
        }

        .invo-num {
            color: #888888;
            padding-left: 20px;
            font-size: 16px;
            line-height: 24px;
        }

        .invo-head-wrap.invoi-date-wrap {
            margin-top: 20px;
        }

        .invo-cont-wrap {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
        }

        .invoice-header-contact {
            display: inline-flex;
            padding-top: 36px;
        }

        .invo-cont-wrap.invo-contact-wrap {
            margin-right: 30px;
        }

        .invo-social-name {
            padding-left: 10px;
        }

        .text-invoice {
            background-image: url('../images/header/back-img.svg');
            background-repeat: no-repeat;
            width: 100%;
            height: auto;
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            background-size: auto;
            background-position: bottom center;
        }


        /************************* 3.Invoice Content CSS **************************/

        .container {
            max-width: 850px;
            margin: 0 auto;
            padding: 0 50px;
        }

        .invo-to {
            color: #12151C;
        }

        .invo-to-owner {
            color: #00BAFF;
            margin: 10px 0;
        }

        .invoice-owner-conte-wrap {
            display: flex;
            justify-content: space-between;
            -webkit-box-pack: justify;
        }

        .invo-to-wrap {
            text-align: left;
        }

        .invo-pay-to-wrap {
            text-align: right;
        }

        .invo-owner-address {
            color: #888888;
        }

        .table-wrapper {
            padding: 50px 0 20px;
        }

        .invoice-table {
            border-collapse: collapse;
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
            white-space: nowrap;
            background-color: #ffffff;
        }

        .invoice-table td,
        .invoice-table th {
            text-align: left;
        }

        .invoice-table td {
            color: #888888;
            font-size: 14px;
            line-height: 22px;
            padding: 20px 0;
        }

        .invoice-table thead th {
            color: #12151C;
            padding: 10px 0;
        }

        .invo-tb-body .invo-tb-row {
            border-bottom: 1px solid #888888;
        }

        .invo-tb-body .invo-tb-row:last-child {
            border-bottom: none;
        }

        .invo-tb-body {
            border-bottom: 2px solid #12151C;
            border-top: 2px solid #12151C;
        }

        .serv-wid {
            width: 32%;
        }

        .desc-wid {
            width: 36%;
        }

        .qty-wid {
            width: 10%;
        }

        .pric-wid {
            width: 12%;
        }

        .tota-wid {
            width: 10%;
        }

        .invoice-table th.total-head,
        .invoice-table td.total-data {
            text-align: right;
        }

        .addi-info-title {
            color: #12151C;
            margin: 0 0 10px;
        }

        .add-info-desc {
            font-size: 14px;
            line-height: 22px;
            color: #888888;
        }

        .invo-total-price {
            font-weight: 500;
        }

        .invo-addition-wrap {
            display: flex;
        }

        .invo-add-info-content {
            width: 50%;
        }

        .invo-bill-total {
            width: 50%;
            position: relative;
        }

        .invo-bill-total table {
            width: 85%;
            border-collapse: collapse;
            white-space: nowrap;
            float: right;
        }

        .invo-total-table td.invo-total-data,
        .invo-total-table td.invo-total-price {
            text-align: right;
        }

        .tax-row.bottom-border,
        .disc-row.bottom-border {
            border-bottom: 2px solid #12151C;
        }

        .hotel-sub {
            padding-left: 70px !important;
        }

        .invo-total-table .tax-row td,
        .invo-grand-total td {
            padding: 20px 0;
        }

        /************************* 4.Bottom Content CSS **************************/

        .agency-bottom-content {
            background: #12151c;
            border-radius: 0px 0px 20px 20px;
            padding: 50px 0;
        }

        .invo-btns {
            display: inline-flex;
            align-items: center;
            margin: 0 1px;
        }

        .invo-buttons-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .invo-buttons-wrap .invo-btns .print-btn {
            background: #00BAFF;
            padding: 12px 24px;
            border-radius: 24px 0px 0px 24px;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
        }

        .invo-buttons-wrap .invo-btns .download-btn {
            background: #00D061;
            padding: 12px 24px;
            border-radius: 0px 24px 24px 0px;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
        }

        .invo-btns span {
            padding-left: 10px;
        }

        .invo-note-wrap,
        .note-title {
            display: flex;
            align-items: center;
        }

        .invo-note-wrap {
            padding-top: 30px;
        }

        .note-title span,
        .note-desc {
            padding-left: 10px;
        }

        /************************* 5.Hotel Booking CSS **************************/

        .item-wid {
            width: 18%;
        }

        .invoice-table th.rate-title,
        .invoice-table td.rate-data {
            text-align: center;
        }

        .invo-hotel-title,
        .invo-hotel-desc {
            font-size: 14px;
            line-height: 22px;
        }

        .detail-col {
            width: 247px;
            background: #F5F5F5;
            padding: 9px 10px;
        }

        .booking-content-wrap {
            display: flex;
            justify-content: space-between;
        }

        .booking-content-wrap.second-row {
            padding-top: 4px;
        }

        .invo-hotel-book-wrap {
            padding-top: 50px;
        }

        .payment-desc {
            font-size: 14px;
            line-height: 22px;
            padding: 20px 0 10px;
        }

        .payemnt-wid,
        .date-wid,
        .trans-wid,
        .amount-wid {
            width: 33.33%;
            text-align: left;
            padding: 10px 0;
        }

        .invo-payment-table {
            border-collapse: collapse;
        }

        .payment-table-wrap {
            padding: 10px 20px;
            background: #F5F5F5;
            margin-top: 35px;
            position: relative;
            z-index: 10;
        }

        .invo-paye-row {
            border-top: 2px solid #12151C;
        }

        /************************* 6.Restaurant Bill CSS **************************/

        .invoice-header.back-img-invoice {
            content: '';
            position: relative;
            background-image: url('../images/header/back-img-one.png');
            width: 100%;
            height: auto;
            top: 0;
            bottom: auto;
            left: 0;
            right: 0;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .invoice-header.back-img-invoice:before,
        .invoice-header.stadium-header:before {
            content: '';
            position: absolute;
            background-color: #12151C;
            opacity: 0.8;
            width: 100%;
            height: 100%;
            left: 0;
            right: 0;
            top: 0;
            border-radius: 20px 20px 0px 0px;
        }

        .back-img-invoice .invoice-logo-content,
        .back-img-invoice .invoice-header-contact {
            position: relative;
            z-index: 8;
        }

        .sno-wid {
            width: 14%;
        }

        .re-desc-wid {
            width: 22%;
        }

        .re-price-wid {
            width: 14%;
        }

        .re-qty-wid {
            width: 15%;
        }

        .discount-price {
            color: #00D061;
        }

        .disc-row td {
            padding-bottom: 20px;
        }

        .payment-wrap {
            border: 2px solid #12151C;
            padding: 0px 20px 0px 20px;
            display: inline-block;
        }

        .res-pay-table {
            border-collapse: collapse;
        }

        .pay-data {
            border-bottom: 1px solid #888888;
        }

        .pay-type {
            padding: 20px 20px 20px 0px;
        }

        .refund-days {
            padding: 20px 0 20px 0px;
        }

        .res-pay-table tbody .pay-data:last-child {
            border-bottom: none;
        }

        .rest-payment-bill {
            display: flex;
        }

        .sign-img img,
        .money-img img {
            width: 100%;
            height: auto;
        }

        .signature-wrap {
            text-align: center;
            align-items: center;
            position: relative;
            left: 19%;
            padding-top: 50px;
        }

        .manager-name {
            font-weight: 500;
            font-size: 14px;
            line-height: 22px;
        }

        .thank-you-content {
            text-align: center;
            padding-top: 50px;
            font-size: 14px;
            line-height: 22px;
        }

        /************************* 7. Bus Booking CSS **************************/

        .content-min-width.bus-header {
            padding: 20px 50px 0px;
        }

        .content-min-width.bus-header .invoice-logo {
            position: relative;
            top: -9px;
        }

        .bus-invo-no-date-wrap {
            background-color: #00BAFF;
            padding: 8px 50px;
            display: flex;
            justify-content: space-between;
        }

        .bus-invo-nnum,
        .bus-invo-ddate {
            padding-left: 10px;
        }

        .invoice-timing-wrap {
            display: flex;
            justify-content: flex-start;
        }

        .invo-time-col {
            width: 50%;
            display: inline-block;
            padding: 0 12px 0 18px;
            position: relative;
        }

        .booking-info p,
        .booking-info {
            position: relative;
        }

        .booking-info .circle:before {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50px;
            background-color: #00BAFF;
            left: -16px;
            top: 7px;
        }

        .booking-info:before {
            content: '';
            position: absolute;
            border-left: 2px solid #00baff;
            height: 39px;
            top: 12px;
            left: -13px;
        }

        .invoice-timing-wrap {
            padding: 26px 0 50px;
        }

        .bus-detail-col {
            display: inline-flex;
        }

        .bus-detail-col.border-bottom {
            border-bottom: 1px solid #888888;
            padding-bottom: 20px;
        }

        .bus-detail-wrap {
            display: grid;
            grid-column: 2;
            grid-template-columns: auto auto auto auto;
            gap: 20px 30px;
            grid-row: 2;
            grid-template-columns: repeat(2, 1fr);
            padding: 30px;
            border: 2px solid #12151C;
        }

        .bus-type,
        .invo-add-info-content.bus-term-cond-content,
        .invo-bill-total.bus-invo-total {
            width: 50%;
        }

        .term-con-list {
            padding: 0 0 0 16px;
            margin: 0;
        }

        .bus-conta-mail-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 30px 0 0;
        }

        .bus-contact a,
        .bus-mail a {
            vertical-align: middle;
        }

        /************************* 8. Money Exchange CSS **************************/

        .content-min-width.money-header {
            padding: 10px 50px 10px;
        }

        .money-detail-wrap {
            margin: 50px 0;
        }

        .transfer-title {
            border-bottom: 2px solid #12151C;
            padding-bottom: 10px;
        }

        .left-money-top-row {
            padding-right: 100px;
        }

        .left-money-bottom-row {
            padding-right: 50px;
        }

        .transfer-detail-wrap {
            display: flex;
            justify-content: space-between;
        }

        .tra-money {
            color: #12151C;
        }

        .tra-title {
            padding: 10px 0 5px 0;
        }

        .tra-money {
            padding: 5px 0 10px;
        }

        .money-tran-title-wrap {
            padding: 0 0 20px 0;
        }

        .right-money-block {
            display: flex;
            align-items: center;
        }

        .money-col-one {
            padding: 0 25px 0 0;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
        }

        .money-col-two {
            padding: 0 25px 0;
        }

        .money-col-three {
            padding: 0 0 0 25px;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
        }

        .money-content {
            text-transform: uppercase;
            padding-bottom: 10px;
        }

        .right-money-transfer {
            border: 2px solid #12151C;
            padding: 20px 20px 10px;
        }

        .mon-exchange-rate {
            padding-bottom: 20px;
        }

        .transfer-wrap {
            padding: 0 0 50px 0;
        }

        .mon-sent-content-wrap {
            display: flex;
            align-items: center;
            padding: 15px 0 0;
        }

        .mon-send-left-data {
            padding-right: 150px;
        }

        .mon-send-col-one,
        .mon-send-col-two {
            padding: 5px 0;
        }

        .paid-out-title-wrap {
            padding-top: 50px;
        }

        .mon-paid-left-data {
            padding-right: 120px;
        }

        /************************* 9. Money Exchange CSS **************************/

        .invo-tb-body.hosp-tb-body {
            border-bottom: none;
        }

        .hosp-invo-table {
            background-color: #F5F5F5;
        }

        .hosp-invo-table .invo-tb-header {
            background-color: #f5f5f5;
        }

        .invoice-table.hospital-table th.rate-title,
        .invoice-table.hospital-table td.rate-data {
            text-align: left
        }

        .invoice-table.hospital-table .sno-wid {
            width: 2%;
        }

        .invoice-table.hospital-table .re-price-wid {
            width: 20%;
        }

        .invoice-table.hospital-table .re-qty-wid,
        .invoice-table.hospital-table .tota-wid {
            width: 5%;
        }

        .hosp-back-img-one img {
            position: absolute;
            left: auto;
            right: 20px;
            top: 20px;
            z-index: 10;
        }

        .hospital-service-content .table-wrapper.patient-table-wrapper {
            z-index: 26;
            position: relative;
        }

        .hosp-back-img-two img {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: auto;
        }

        .table-wrapper.patient-detail-wrapper {
            padding-bottom: 0;
        }

        .hospital-table-wrap {
            margin-top: 50px;
        }

        .left-money-transfer {
            display: flex;
        }

        /************************* 10. Movie Ticket Booking CSS **************************/

        .movie-details-wrap {
            position: relative;
            display: flex;
            width: 100%;
            padding: 50px 0 0;
            column-gap: 30px;
            align-items: center;
        }

        .movie-col-left,
        .movie-col-right {
            width: 50%;
        }

        .movie-img img {
            border-radius: 10px;
            width: 100%;
            height: auto;
        }

        .movie-detail-col {
            display: inline-flex;
            align-items: center;
            padding: 10px 0;
        }

        .movie-col-right {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
        }

        .movie-detail-col .movie-name {
            width: 120px;
        }

        .invo-addition-wrap.movi-add-wrap {
            justify-content: flex-end;
        }

        .invo-addition-wrap.movi-add-wrap .invo-grand-total td {
            padding: 0;
        }

        .invoice-table.movie-table .re-desc-wid {
            width: 40%;
        }

        .invoice-table.movie-table .re-price-wid {
            width: 10%;
        }

        .invoice-table.movie-table .re-qty-wid {
            width: 10%;
        }

        .invoice-table.movie-table .re-tax-wid {
            width: 10%;
        }

        .invoice-table.movie-table .tota-wid {
            width: 15%
        }

        .invoice-table.movie-table th.rate-title,
        .invoice-table.movie-table td.rate-data,
        .invoice-table.movie-payment-table th.re-desc-wid,
        .invoice-table.movie-payment-table td.rate-data.movi-pay-card,
        .invoice-table.booker-table th.rate-title,
        .invoice-table.booker-table td.rate-data {
            text-align: left;
        }

        .invoice-table.movie-table th.re-qty-wid.rate-title,
        .invoice-table.movie-table th.re-tax-wid.rate-title,
        .invoice-table.movie-table .invo-tb-data.qty-data,
        .invoice-table.movie-table .invo-tb-data.tax-data,
        .invoice-table.booker-table .tota-wid,
        .invoice-table.booker-table .invo-tb-data.total-data {
            text-align: center;
        }

        .invo-addition-wrap.movi-add-wrap .hotel-sub {
            padding-left: 50px !important;
        }

        .invoice-table.movie-payment-table .invo-tb-row td {
            padding: 0;
        }

        .invoice-table.movie-payment-table .re-desc-wid {
            width: 12%;
        }

        .invoice-table.movie-payment-tabl .re-price-wid {
            width: 12%;
        }

        .must-read-desc {
            padding-top: 10px;
        }

        .movie-must-read-wrap {
            padding-top: 30px;
        }

        /************************* 11. Stadium Seat Booking CSS **************************/

        .invoice-header.stadium-header.content-min-width {
            padding: 50px;
        }

        .invoice-header.stadium-header .invoice-logo-content {
            justify-content: center;
        }

        .invoice-header.stadium-header {
            background-image: url('../images/header/back-img-two.png');
            width: 100%;
            height: auto;
            top: 0;
            bottom: auto;
            left: 0;
            right: 0;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            position: relative;
            content: '';
        }

        .invoice-header.stadium-header:before {
            opacity: 0.6;
        }

        .invoice-logo-content {
            position: relative;
        }

        .booker-title-wrap {
            padding: 0;
        }

        .booker-table-wrap {
            padding: 0;
        }

        .invoice-table.booker-table .sno-wid {
            width: 8%;
        }

        .invoice-table.booker-table .re-price-wid {
            width: 30%;
        }

        .invoice-table.booker-table .re-qty-wid,
        .invoice-table.booker-table .tota-wid {
            width: 6%;
        }

        .invo-addition-wrap.booking-grand-total {
            padding-top: 20px;
        }

        .invo-addition-wrap.booking-grand-total .hotel-sub {
            padding-left: 35px !important;
        }

        @media print {
            .d-print-none {
                display: none !important;
            }
        }

        /************************* 12. Dark Invoice CSS **************************/

        .invoice-dark {
            background-color: #000000;
        }

        .dark-invoice-content-wrap {
            background-color: #000000;
        }

        .dark-content-section {
            background-color: #21242B;
        }

        .w-text,
        .dark-table tr th {
            color: #ffffff;
        }

        .dark-table .invoice-table {
            background-color: #21242B;
        }

        .dark-table .invo-tb-body {
            border-bottom: 2px solid #ffffff;
            border-top: 2px solid #ffffff;
        }

        .invo-bill-total.dark-invo-bill .tax-row.bottom-border,
        .dark-invo-bill .disc-row.bottom-border {
            border-bottom: 2px solid #ffffff;
        }

        .dark-bus-detail-wrap,
        .dark-money-detail-wrap,
        .dark-money-exchange,
        .dark-payment-bill-wrap .payment-wrap,
        .dark-money-details-wrap {
            border: 2px solid #ffffff;
        }

        .payment-table-wrap.dark-table,
        .dark-payment-wrap,
        .dark-invo-book-wrap .detail-col,
        .dark-money-detail-wrap {
            background: #12151C;
        }

        .hospital-table-wrap.dark-table .invo-paye-row,
        .hotel-booking-wrap.dark-table .invo-paye-row,
        .dark-payment-wrap .invo-paye-row {
            border-top: 2px solid #ffffff;
        }

        .dark-title .transfer-title {
            border-bottom: 2px solid #ffffff;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../assets/css/media-query.css">
</head>

<body>
    <!--Invoice Wrap Start here -->
    <div class="invoice_wrap">
        <div class="invoice-container">
            <div class="invoice-content-wrap" id="download_section">
                <!--Header Start Here -->
                <header class="invoice-header text-invoice content-min-width" id="invo_header">
                    <div class="invoice-logo-content">
                        <div class="invoice-logo">
                            <a href="agency_service.html" class="logo"><img src="../assets/images/logo/logo.png"
                                    alt="this is a invoice logo"></a>
                        </div>
                        <div class="invo-head-content">
                            <div class="invo-head-wrap">
                                <div class="invo-num-title invo-no inter-700">Invoice No:</div>
                                <div class="invo-num inter-400">#DI56789</div>
                            </div>
                            <div class="invo-head-wrap invoi-date-wrap">
                                <div class="invo-num-title invo-date inter-700">Invoice Date:</div>
                                <div class="invo-num inter-400">30/11/2022</div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-header-contact">
                        <div class="invo-cont-wrap invo-contact-wrap">
                            <div class="invo-social-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_6_94)">
                                        <path
                                            d="M5 4H9L11 9L8.5 10.5C9.57096 12.6715 11.3285 14.429 13.5 15.5L15 13L20 15V19C20 19.5304 19.7893 20.0391 19.4142 20.4142C19.0391 20.7893 18.5304 21 18 21C14.0993 20.763 10.4202 19.1065 7.65683 16.3432C4.8935 13.5798 3.23705 9.90074 3 6C3 5.46957 3.21071 4.96086 3.58579 4.58579C3.96086 4.21071 4.46957 4 5 4"
                                            stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M15 7C15.5304 7 16.0391 7.21071 16.4142 7.58579C16.7893 7.96086 17 8.46957 17 9"
                                            stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M15 3C16.5913 3 18.1174 3.63214 19.2426 4.75736C20.3679 5.88258 21 7.4087 21 9"
                                            stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6_94">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="invo-social-name">
                                <a href="tel:12345678899" class="invo-hedaer-contact inter-400">+1 234 567 8899</a>
                            </div>
                        </div>
                        <div class="invo-cont-wrap">
                            <div class="invo-social-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_6_108)">
                                        <path
                                            d="M19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5Z"
                                            stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M3 7L12 13L21 7" stroke="#00BAFF" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6_108">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="invo-social-name">
                                <a href="mailto:contact@invoice.com"
                                    class="invo-hedaer-mail inter-400">contact@invoice.com</a>
                            </div>
                        </div>
                    </div>
                </header>
                <!--Header End Here -->
                <!--Invoice content start here -->
                <section class="agency-service-content" id="agency_service">
                    <div class="container">
                        <!--invoice owner name content -->
                        <div class="invoice-owner-conte-wrap">
                            <div class="invo-to-wrap">
                                <div class="invoice-to-content">
                                    <p class="invo-to inter-700 medium-font mtb-0">Invoice To:</p>
                                    <h1 class="invo-to-owner inter-700 md-lg-font">Jordon Smith</h1>
                                    <p class="invo-owner-address medium-font inter-400 mtb-0">121 E Parkview St, IN
                                        45240<br> Toronto, Ontario<br> Canada</p>
                                </div>
                            </div>
                            <div class="invo-pay-to-wrap">
                                <div class="invoice-pay-content">
                                    <p class="invo-to inter-700 medium-font mtb-0">Pay To:</p>
                                    <h2 class="invo-to-owner inter-700 md-lg-font">Digital Invoico</h2>
                                    <p class="invo-owner-address medium-font inter-400 mtb-0">4510 E Dolphine St, IN
                                        3526<br> Hills Road, New York<br> United States</p>
                                </div>
                            </div>
                        </div>
                        <!--Invoice Table Data Start here -->
                        <div class="table-wrapper agency-service-table">
                            <table class="invoice-table">
                                <thead>
                                    <tr class="invo-tb-header">
                                        <th class="invo-table-title serv-wid inter-700 medium-font">Service</th>
                                        <th class="invo-table-title desc-wid inter-700 medium-font">Description</th>
                                        <th class="invo-table-title qty-wid inter-700 medium-font">Qty</th>
                                        <th class="invo-table-title pric-wid inter-700 medium-font">Price</th>
                                        <th class="invo-table-title tota-wid inter-700 medium-font total-head">Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="invo-tb-body">
                                    <tr class="invo-tb-row">
                                        <td class="invo-tb-data">Marketing</td>
                                        <td class="invo-tb-data">Digital Marketing & SEO</td>
                                        <td class="invo-tb-data">2</td>
                                        <td class="invo-tb-data">$120</td>
                                        <td class="invo-tb-data total-data">$240.00</td>
                                    </tr>
                                    <tr class="invo-tb-row">
                                        <td class="invo-tb-data">Web Design & Development</td>
                                        <td class="invo-tb-data">Dektop & Mobile Web App Design</td>
                                        <td class="invo-tb-data">2</td>
                                        <td class="invo-tb-data">$250</td>
                                        <td class="invo-tb-data total-data">$500.00</td>
                                    </tr>
                                    <tr class="invo-tb-row">
                                        <td class="invo-tb-data">UI/UX Design</td>
                                        <td class="invo-tb-data">Mobile Adroid & iOS App Design</td>
                                        <td class="invo-tb-data">1</td>
                                        <td class="invo-tb-data">$80</td>
                                        <td class="invo-tb-data total-data">$80.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--Invoice Table Data End here -->
                        <!--Invoice additional info start here -->
                        <div class="invo-addition-wrap">
                            <div class="invo-add-info-content">
                                <h3 class="addi-info-title inter-700 medium-font">Additional Information:</h3>
                                <p class="add-info-desc inter-400 mtb-0">A ut vitae nullam risus at. Justo enim nisi
                                    elementum ac. Massa molestie metus vitae ornare turpis donec odio sollicitudin. Ac
                                    ut tellus eu donec dictum risus blandit. Quam diam dictum amet.</p>
                            </div>
                            <div class="invo-bill-total">
                                <table class="invo-total-table">
                                    <tbody>
                                        <tr>
                                            <td class="inter-700 medium-font b-text hotel-sub">Sub Total:</td>
                                            <td class="invo-total-data inter-400 medium-font second-color">$820.00</td>
                                        </tr>
                                        <tr class="tax-row bottom-border">
                                            <td class="inter-700 medium-font b-text hotel-sub">Tax <span
                                                    class="invo-total-data inter-700 medium-font second-color">(18%)</span>
                                            </td>
                                            <td class="invo-total-data inter-400 medium-font second-color">$147.60</td>
                                        </tr>
                                        <tr class="invo-grand-total">
                                            <td class="inter-700 sm-text primary-color hotel-sub">Grand Total:</td>
                                            <td class="sm-text b-text invo-total-price">$967.60</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--Invoice additional info end here -->
                    </div>
                </section>
                <!--Invoice content end here -->
            </div>

            <!--bottom content start here -->
            <section class="agency-bottom-content d-print-none" id="agency_bottom">
                <div class="container">
                    <!--print-download content start here -->
                    <div class="invo-buttons-wrap">
                        <div class="invo-print-btn invo-btns">
                            <a href="javascript:window.print()" class="print-btn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_5_313)">
                                        <path
                                            d="M14 3V7C14 7.26522 14.1054 7.51957 14.2929 7.70711C14.4804 7.89464 14.7348 8 15 8H19"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M17 21H7C6.46957 21 5.96086 20.7893 5.58579 20.4142C5.21071 20.0391 5 19.5304 5 19V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H14L19 8V19C19 19.5304 18.7893 20.0391 18.4142 20.4142C18.0391 20.7893 17.5304 21 17 21Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 7H10" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 13H15" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M13 17H15" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_5_313">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="inter-700 medium-font">Print</span>
                            </a>
                        </div>
                        <div class="invo-down-btn invo-btns">
                            <a class="download-btn" id="generatePDF">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_5_246)">
                                        <path
                                            d="M4 17V19C4 19.5304 4.21071 20.0391 4.58579 20.4142C4.96086 20.7893 5.46957 21 6 21H18C18.5304 21 19.0391 20.7893 19.4142 20.4142C19.7893 20.0391 20 19.5304 20 19V17"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7 11L12 16L17 11" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12 4V16" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_5_246">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="inter-700 medium-font">Download</span>
                            </a>
                        </div>
                    </div>
                    <!--print-download content end here -->
                    <!--Note content -->
                    <div class="invo-note-wrap">
                        <div class="note-title">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_8_240)">
                                    <path
                                        d="M14 3V7C14 7.26522 14.1054 7.51957 14.2929 7.70711C14.4804 7.89464 14.7348 8 15 8H19"
                                        stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M17 21H7C6.46957 21 5.96086 20.7893 5.58579 20.4142C5.21071 20.0391 5 19.5304 5 19V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H14L19 8V19C19 19.5304 18.7893 20.0391 18.4142 20.4142C18.0391 20.7893 17.5304 21 17 21Z"
                                        stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9 7H10" stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9 13H15" stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M13 17H15" stroke="#00BAFF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_8_240">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="inter-700 medium-font">Note:</span>
                        </div>
                        <h3 class="inter-400 medium-font second-color note-desc mtb-0">This is computer generated
                            receipt and does not require physical signature.</h3>
                    </div>
                </div>
            </section>
            <!--bottom content end here -->
        </div>
    </div>
</body>

</html>
