<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $site }} — {{ $title }} report</title>
    <style>
        @page { margin: 26mm 14mm 18mm 14mm; }
        body { font-family: "DejaVu Sans", sans-serif; font-size: 9.5px; color: #1f2937; }

        /* Repeating header / footer on every page */
        .page-head { position: fixed; top: -18mm; left: 0; right: 0; height: 12mm; border-bottom: 2px solid #1f5fae; }
        .page-head td { vertical-align: bottom; padding-bottom: 6px; }
        .brand { font-size: 13px; font-weight: bold; color: #1f5fae; letter-spacing: .3px; }
        .doc-title { font-size: 11px; color: #6b7280; text-align: right; }
        .page-foot { position: fixed; bottom: -11mm; left: 0; right: 0; height: 7mm; font-size: 8px; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 4px; }
        .page-foot .right { text-align: right; }
        .pagenum:before { content: counter(page); }

        h1 { font-size: 19px; margin: 0 0 3px; }
        .scope { color: #6b7280; font-size: 10px; margin-bottom: 12px; }

        /* Summary tiles */
        .tiles { width: 100%; border-collapse: separate; border-spacing: 6px 0; margin: 0 -6px 14px; }
        .tile { background: #f5f8fc; border: 1px solid #dbe6f3; border-radius: 6px; padding: 7px 9px; }
        .tile .n { font-size: 15px; font-weight: bold; color: #1f5fae; }
        .tile .l { font-size: 8px; color: #6b7280; text-transform: uppercase; letter-spacing: .4px; }

        /* Data table */
        table.data { width: 100%; border-collapse: collapse; }
        table.data thead { display: table-header-group; }
        table.data th { background: #1f5fae; color: #fff; font-weight: bold; text-align: left; padding: 6px 7px; font-size: 8.5px; text-transform: uppercase; letter-spacing: .3px; }
        table.data td { padding: 5px 7px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
        table.data tr { page-break-inside: avoid; }
        table.data tbody tr:nth-child(even) td { background: #f8fafc; }
        .c { text-align: center; }
        .muted { color: #9ca3af; }
        .pill { display: inline-block; padding: 1px 6px; border-radius: 8px; font-size: 8px; font-weight: bold; }
        .pill-green { background: #dcfce7; color: #166534; }
        .pill-red { background: #fee2e2; color: #991b1b; }
        .pill-yellow { background: #fef3c7; color: #92400e; }
        .empty { padding: 30px; text-align: center; color: #6b7280; border: 1px dashed #d1d5db; border-radius: 6px; }
    </style>
</head>
<body>
    <table class="page-head" width="100%">
        <tr>
            <td class="brand">{{ $site }}</td>
            <td class="doc-title">{{ $title }} report</td>
        </tr>
    </table>
    <table class="page-foot" width="100%">
        <tr>
            <td>Generated {{ now()->format('d M Y, H:i') }} · {{ $scope }}</td>
            <td class="right">Page <span class="pagenum"></span></td>
        </tr>
    </table>

    <h1>{{ $title }} report</h1>
    <div class="scope">{{ $scope }} · sorted by name</div>

    <table class="tiles">
        <tr>
            @foreach ($summary as $label => $value)
                <td class="tile">
                    <div class="n">{{ number_format($value) }}</div>
                    <div class="l">{{ $label }}</div>
                </td>
            @endforeach
        </tr>
    </table>

    @if (count($rows))
        <table class="data">
            <thead>
                <tr>
                    @foreach ($headers as $i => $h)
                        <th class="{{ in_array($i + 1, $numeric) ? 'c' : '' }}">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        @foreach ($row as $i => $cell)
                            @php $h = $headers[$i]; @endphp
                            <td class="{{ in_array($i + 1, $numeric) ? 'c' : '' }} {{ $cell === '—' ? 'muted' : '' }}">
                                @if ($h === 'Status')
                                    <span class="pill {{ $cell === 'Disabled' ? 'pill-red' : 'pill-green' }}">{{ $cell }}</span>
                                @elseif ($h === 'Applied to teach' && $cell === 'Yes')
                                    <span class="pill pill-yellow">Yes</span>
                                @elseif ($h === 'Joined' && $cell !== '—')
                                    {{ \Illuminate\Support\Carbon::parse($cell)->format('d M Y') }}
                                @else
                                    {{ $cell }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty">No records match this export.</div>
    @endif
</body>
</html>
