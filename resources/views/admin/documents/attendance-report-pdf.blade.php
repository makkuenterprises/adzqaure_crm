<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Report - {{ $startDate->format('F Y') }}</title>
    <style>
        @page {
            margin: 1.2cm;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 8.5px; /* Compact print size to fit 31 days horizontally */
            color: #333;
            line-height: 1.2;
        }
        .header {
            margin-bottom: 15px;
            border-bottom: 2px solid #FF7A00;
            padding-bottom: 8px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            color: #FF7A00;
            margin: 0;
        }
        .subtitle {
            font-size: 10px;
            color: #666;
            margin: 2px 0 0 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px 2px;
            text-align: center;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .text-start {
            text-align: left;
            padding-left: 5px;
            font-weight: bold;
        }

        /* Circular badges inside PDF */
        .att-badge {
            display: inline-block;
            width: 15px;
            height: 15px;
            line-height: 15px;
            border-radius: 50%;
            text-align: center;
            font-size: 8px;
            font-weight: bold;
            color: #fff;
        }
        .bg-present { background-color: #2bc155; }
        .bg-absent { background-color: #f72b50; }
        .bg-halfday { background-color: #ffaa2b; }
        .bg-leave { background-color: #1ea1f2; }
        .bg-holiday { background-color: #888888; }
        .bg-none { background-color: #f0f0f0; color: #ccc; }

        .legend {
            margin-top: 20px;
            font-size: 8px;
        }
        .legend-item {
            display: inline-block;
            margin-right: 15px;
        }
        .legend-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 4px;
        }
    </style>
</head>
<body>

    <div class="header">
        <p class="title">Monthly Attendance Report</p>
        <p class="subtitle">Period: {{ $startDate->format('F Y') }} | Makku Enterprises Pvt. Ltd.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-start" style="width: 140px;">Employee</th>
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    <th style="width: 18px;">{{ $day }}</th>
                @endfor
                <th style="color: #2bc155; width: 18px;">P</th>
                <th style="color: #f72b50; width: 18px;">A</th>
                <th style="color: #ffaa2b; width: 18px;">HD</th>
                <th style="color: #1ea1f2; width: 18px;">PL</th>
                <th style="color: #888888; width: 18px;">H</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                @php
                    $pCount = 0; $aCount = 0; $hdCount = 0; $plCount = 0; $hCount = 0;
                @endphp
                <tr>
                    <td class="text-start">{{ $employee->name }}</td>

                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $key = $employee->id . '_' . $day;
                            $status = $attendances->has($key) ? $attendances->get($key)->status : null;
                        @endphp
                        <td>
                            @if ($status == 'Present')
                                @php $pCount++; @endphp
                                <span class="att-badge bg-present">P</span>
                            @elseif ($status == 'Absent')
                                @php $aCount++; @endphp
                                <span class="att-badge bg-absent">A</span>
                            @elseif ($status == 'Half-Day')
                                @php $hdCount++; @endphp
                                <span class="att-badge bg-halfday">HD</span>
                            @elseif ($status == 'Leave_Paid')
                                @php $plCount++; @endphp
                                <span class="att-badge bg-leave">L</span>
                            @elseif ($status == 'Holiday')
                                @php $hCount++; @endphp
                                <span class="att-badge bg-holiday">H</span>
                            @else
                                <span style="color: #ccc;">-</span>
                            @endif
                        </td>
                    @endfor

                    <td><b>{{ $pCount }}</b></td>
                    <td><b>{{ $aCount }}</b></td>
                    <td><b>{{ $hdCount }}</b></td>
                    <td><b>{{ $plCount }}</b></td>
                    <td><b>{{ $hCount }}</b></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="legend">
        <p style="font-weight: bold; margin-bottom: 5px;">Legend:</p>
        <span class="legend-item"><span class="legend-dot bg-present"></span> Present (P)</span>
        <span class="legend-item"><span class="legend-dot bg-absent"></span> Absent (A)</span>
        <span class="legend-item"><span class="legend-dot bg-halfday"></span> Half-Day (HD)</span>
        <span class="legend-item"><span class="legend-dot bg-leave"></span> Paid Leave (L)</span>
        <span class="legend-item"><span class="legend-dot bg-holiday"></span> Holiday (H)</span>
    </div>

</body>
</html>
