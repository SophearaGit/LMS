<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Course Sales Report</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #1a1a1a;
            background: #fff;
        }

        .wrap {
            width: 720px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Header */
        .header-table {
            width: 100%;
            margin-bottom: 6px;
        }

        .icon-box {
            width: 32px;
            height: 32px;
            background: #E6F1FB;
            border-radius: 8px;
            text-align: center;
            vertical-align: middle;
            padding: 6px;
        }

        .title-text {
            font-size: 20px;
            font-weight: bold;
            color: #1a1a1a;
            vertical-align: middle;
            padding-left: 10px;
        }

        .subtitle {
            font-size: 12px;
            color: #888;
            margin-bottom: 28px;
        }

        /* Summary cards — side by side via table */
        .cards-table {
            width: 100%;
            margin-bottom: 28px;
            border-spacing: 12px 0;
            border-collapse: separate;
        }

        .card {
            width: 50%;
            background: #f5f5f5;
            border-radius: 8px;
            padding: 14px 16px;
        }

        .card-label {
            font-size: 11px;
            color: #888;
            margin-bottom: 6px;
        }

        .card-value {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a1a;
        }

        .card-value.blue {
            color: #185FA5;
        }

        /* Data table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
        }

        .data-table thead tr {
            background: #f9f9f9;
        }

        .data-table th {
            padding: 10px 14px;
            font-size: 10px;
            font-weight: bold;
            color: #999;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border-bottom: 1px solid #e5e5e5;
            text-align: left;
        }

        .data-table th.r {
            text-align: right;
        }

        .data-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f0f0f0;
            color: #1a1a1a;
            vertical-align: middle;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .data-table td.r {
            text-align: right;
        }

        .data-table td.rev {
            text-align: right;
            font-weight: bold;
            color: #185FA5;
            white-space: nowrap;
        }

        /* Rank badge */
        .badge {
            margin: 0px 5px 5px 0px;
            display: inline-block;
            width: 22px;
            height: 22px;
            line-height: 22px;
            border-radius: 50%;
            background: #f0f0f0;
            border: 1px solid #e0e0e0;
            font-size: 11px;
            font-weight: bold;
            color: #888;
            text-align: center;
        }

        /* Inline bar — table inside td */
        .bar-wrap {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
            width: 70px;
        }

        .bar-track {
            width: 70px;
            height: 4px;
            background: #e5e5e5;
            border-radius: 4px;
        }

        .bar-fill {
            height: 4px;
            background: #378ADD;
            border-radius: 4px;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 11px;
            color: #bbb;
            text-align: right;
        }
    </style>
</head>

<body>
    @php
        $totalStudents = $report->sum('total_students');
        $totalRevenue = $report->sum('revenue');
        $maxRevenue = $report->max('revenue') ?: 1;
    @endphp

    <div class="wrap">

        {{-- HEADER --}}
        <table class="header-table">
            <tr>
                <td class="icon-box" style="width:32px;">
                    <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="9" width="3" height="6" rx="1" fill="#378ADD" />
                        <rect x="6" y="5" width="3" height="10" rx="1" fill="#378ADD" opacity="0.7" />
                        <rect x="11" y="1" width="3" height="14" rx="1" fill="#378ADD" opacity="0.45" />
                    </svg>
                </td>
                <td class="title-text">Course sales report</td>
            </tr>
        </table>
        <div class="subtitle">Year: {{ $year }}</div>

        {{-- SUMMARY CARDS --}}
        <table class="cards-table">
            <tr>
                <td class="card">
                    <div class="card-label">Total students</div>
                    <div class="card-value">{{ $totalStudents }}</div>
                </td>
                <td class="card">
                    <div class="card-label">Total revenue</div>
                    <div class="card-value blue">
                        {{ config('settings.site_currency_icon') }} {{ number_format($totalRevenue, 2) }}
                    </div>
                </td>
            </tr>
        </table>

        {{-- DATA TABLE --}}
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Course</th>
                    <th class="r" style="width:90px;">Students</th>
                    <th class="r" style="width:200px;">Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $index => $item)
                    @php $barPx = (int) round(($item->revenue / $maxRevenue) * 70); @endphp
                    <tr>
                        <td><span class="badge">{{ $index + 1 }}</span></td>
                        <td>{{ $item->course_name }}</td>
                        <td class="r">{{ $item->total_students }}</td>
                        <td class="rev">
                            {{ config('settings.site_currency_icon') }} {{ number_format($item->revenue, 2) }}
                            {{-- <span class="bar-wrap">
                                <div class="bar-track">
                                    <div class="bar-fill" style="width:{{ $barPx }}px;"></div>
                                </div>
                            </span> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- FOOTER --}}
        <div class="footer">Generated on: {{ now()->format('d M Y H:i') }}</div>

    </div>
</body>

</html>
