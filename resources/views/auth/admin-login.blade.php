<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <title>Admin Login</title>
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

        .login-container {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: normal;
        }

        .status-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            font-size: 14px;
        }

        .error-messages {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .error-messages ul {
            list-style: none;
        }

        .error-messages li {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: normal;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background: white;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .client-field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .invalid-input {
            border-color: #dc2626 !important;
        }

        .register-link {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 15px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        @if (session('status'))
            <div class="status-message">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login.admin') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
                <div class="client-field-error" data-for="email"></div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
                <div class="client-field-error" data-for="password"></div>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="register-link">
            Don't have an admin account? <a href="{{ route('register.admin.form') }}">Register here</a>
        </p>
    </div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(function() {
            $('form').on('submit', function(e) {
                const $form = $(this);
                function clearErrors() {
                    $form.find('.client-field-error').text('');
                    $form.find('.invalid-input').removeClass('invalid-input');
                }
                function setError(name, message) {
                    $form.find('[name="'+name+'"]').addClass('invalid-input');
                    $form.find('.client-field-error[data-for="'+name+'"]').text(message);
                }

                clearErrors();
                let hasErrors = false;
                const email = $.trim($form.find('input[name="email"]').val());
                const password = $.trim($form.find('input[name="password"]').val());
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) { setError('email', 'Email is required.'); hasErrors = true; }
                else if (!emailRegex.test(email)) { setError('email', 'Please enter a valid email address.'); hasErrors = true; }
                if (!password) { setError('password', 'Password is required.'); hasErrors = true; }
                if (hasErrors) e.preventDefault();
            });
		});
	</script>
</body>
</html>