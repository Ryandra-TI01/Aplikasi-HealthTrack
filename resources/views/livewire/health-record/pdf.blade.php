<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Health Monitoring Results</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            margin: 40px;
            background-color: #ffffff;
            color: #333;
        }

        h1 {
            background-color: #2D805A;
            color: #ffffff;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        h2 {
            margin-top: 40px;
            color: #1C5B3E;
            border-bottom: 2px solid #2D805A;
            padding-bottom: 5px;
        }

        p {
            margin: 10px 0;
        }

        strong {
            color: #1C5B3E;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 25px;
            font-size: 12px;
        }

        th {
            background-color: #2D805A;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        em {
            color: #777;
        }
    </style>
</head>
<body>

    <h1>Health Monitoring Results</h1>
    <p><strong>Period:</strong> {{ $start_date }} Up To {{ $end_date }}</p>

    @foreach ($data as $item)
        <h2>{{ $item['type']->name }} ({{ $item['type']->unit }})</h2>
        @if ($item['records']->count())
            @if ($item['chart_base64'])
                <img src="{{ $item['chart_base64'] }}" style="width: 100%; max-height: 300px; object-fit: contain; margin-bottom: 15px;">
            @endif

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Value</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item['records'] as $record)
                        <tr>
                            <td>{{ $record->recorded_at }}</td>
                            <td>{{ $record->value ?? $record->raw_value }}</td>
                            <td>{{ $record->notes ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p><em>No data available.</em></p>
        @endif
    @endforeach

</body>
</html>
