<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <title>Verify Account</title>
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

        .verification-container {
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
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background: white;
        }

        input[type="email"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }

        input[readonly] {
            background-color: #f8f9fa;
            color: #6c757d;
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
            margin-bottom: 20px;
        }

        button:hover {
            background: #0056b3;
        }

        .admin-login-link {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .admin-login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .admin-login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .verification-container {
                padding: 30px 20px;
                margin: 10px;
            }
        }

        .client-field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }
        .invalid-input { border-color: #dc2626 !important; }
    </style>
</head>
<body>
    <div class="verification-container">
        <h1>Verify Your Account</h1>
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
        <form method="POST" action="{{ route('verification.verify') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ session('verifying_email') }}" readonly>
            </div>
            <div class="form-group">
                <label>Verification Code</label>
                <input type="text" name="code" maxlength="6">
                <div class="client-field-error" data-for="code"></div>
            </div>
            <button type="submit">Verify</button>
        </form>
        @if (session('verifying_role') === 'admin')
            <p class="admin-login-link">
                Go to <a href="{{ route('login.admin.form') }}">Admin Login</a>
            </p>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function(){
            $('form').on('submit', function(e){
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
                const code = $.trim($form.find('input[name="code"]').val());
                if (!code) { setError('code', 'Verification code is required.'); hasErrors = true; }
                else if (!/^\d{6}$/.test(code)) { setError('code', 'Verification code must be 6 digits.'); hasErrors = true; }
                if (hasErrors) e.preventDefault();
            });
        });
    </script>
</body>
</html>