<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <title>Admin Registration</title>
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

        .registration-container {
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background: white;
        }

        input[type="text"]:focus,
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
            margin-bottom: 20px;
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

        .customer-link {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .customer-link a {
            color: #007bff;
            text-decoration: none;
        }

        .customer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .registration-container {
                padding: 30px 20px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h1>Admin Registration</h1>
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register.admin') }}">
            @csrf
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}">
                <div class="client-field-error" data-for="first_name"></div>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}">
                <div class="client-field-error" data-for="last_name"></div>
            </div>
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
            <button type="submit">Register</button>
        </form>
        <p class="customer-link">
            Already have an admin account? <a href="{{ route('login.admin.form') }}">Login here</a>
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
                const firstName = $.trim($form.find('input[name="first_name"]').val());
                const lastName = $.trim($form.find('input[name="last_name"]').val());
                const email = $.trim($form.find('input[name="email"]').val());
                const password = $.trim($form.find('input[name="password"]').val());
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!firstName) { setError('first_name', 'First name is required.'); hasErrors = true; }
                if (!lastName) { setError('last_name', 'Last name is required.'); hasErrors = true; }
                if (!email) { setError('email', 'Email is required.'); hasErrors = true; }
                else if (!emailRegex.test(email)) { setError('email', 'Please enter a valid email address.'); hasErrors = true; }
                if (!password) { setError('password', 'Password is required.'); hasErrors = true; }
                else if (password.length < 8) { setError('password', 'Password must be at least 8 characters.'); hasErrors = true; }
                if (hasErrors) e.preventDefault();
            });
		});
	</script>
</body>
</html>