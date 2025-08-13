<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #007bff;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: normal;
        }

        .logout-form button {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-form button:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .content {
            padding: 40px;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .welcome-section h2 {
            color: #333;
            font-size: 28px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .welcome-section p {
            color: #666;
            font-size: 16px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .dashboard-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
        }

        .dashboard-card h3 {
            color: #333;
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .dashboard-card .card-icon {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 15px;
        }

        .stats-section {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .stats-section h3 {
            color: #333;
            font-size: 20px;
            font-weight: normal;
            margin-bottom: 20px;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            display: block;
        }

        .stat-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .content {
                padding: 20px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <form class="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
        
        <div class="content">
            <div class="welcome-section">
                <h2>Welcome to Admin Panel</h2>
            </div>
        </div>
    </div>
</body>
</html>