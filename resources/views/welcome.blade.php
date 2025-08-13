<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .welcome-container {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .welcome-title {
            color: #333;
            font-size: 32px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .welcome-subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .links-container {
            display: grid;
            gap: 20px;
        }

        .welcome-link {
            display: block;
            text-decoration: none;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 30px;
            color: inherit;
        }

        .welcome-link:hover {
            background: #e9ecef;
            border-color: #007bff;
        }

        .welcome-link h2 {
            color: #333;
            font-size: 20px;
            font-weight: normal;
            margin-bottom: 8px;
        }

        .welcome-link p {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }

        .welcome-link:hover h2 {
            color: #007bff;
        }

        @media (max-width: 480px) {
            .welcome-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .welcome-title {
                font-size: 28px;
            }

            .welcome-link {
                padding: 25px 20px;
            }

            .welcome-link h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1 class="welcome-title">Welcome</h1>
        <p class="welcome-subtitle">Please choose an option to continue</p>
        
        <div class="links-container">
            <a href="{{ route('register.customer.form') }}" class="welcome-link">
                <h2>Customer Registration</h2>
                <p>Register as a customer.</p>
            </a>
            <a href="{{ route('register.admin.form') }}" class="welcome-link">
                <h2>Admin Registration</h2>
                <p>Register as an admin.</p>
            </a>
            <a href="{{ route('login.admin.form') }}" class="welcome-link">
                <h2>Admin Login</h2>
                <p>Login for admins only.</p>
            </a>
        </div>
    </div>
</body>
</html>