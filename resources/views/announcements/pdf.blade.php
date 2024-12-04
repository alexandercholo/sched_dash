<!-- resources/views/announcements/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Announcements Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #1f2937;
            line-height: 1.5;
        }
        .container {
            padding: 2rem;
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            font-size: 16px;
            color: #6b7280;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: #f3f4f6;
            border-radius: 0.5rem;
        }
        .stat-item {
            text-align: center;
        }
        .stat-label {
            font-size: 14px;
            color: #6b7280;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }
        th {
            background-color: #f3f4f6;
            padding: 0.75rem;
            text-align: left;
            font-weight: bold;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        td {
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">Announcements Report</div>
            <div class="subtitle">Generated on {{ now()->format('F d, Y') }}</div>
        </div>

        <div class="stats">
            <div class="stat-item">
                <div class="stat-label">Total Announcements</div>
                <div class="stat-value">{{ count($announcements) }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Active Announcements</div>
                <div class="stat-value">{{ $announcements->where('target_date', '>=', now())->count() }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Report Period</div>
                <div class="stat-value">{{ ucfirst(request('period', 'all')) }}</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Program</th>
                    <th>Posted Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ $announcement->program }}</td>
                    <td>{{ $announcement->created_at->format('M d, Y') }}</td>
                    <td>{{ $announcement->target_date >= now() ? 'Active' : 'Expired' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>This report was automatically generated by the Announcement System</p>
            <p>Page 1 of 1</p>
        </div>
    </div>
</body>
</html>