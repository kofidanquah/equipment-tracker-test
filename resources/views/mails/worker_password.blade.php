<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Your Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .email-container {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            margin-top: 3rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .email-header {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            border-radius: 6px 6px 0 0;
            text-align: center;
        }

        .email-body {
            background-color: white;
            padding: 2rem;
            border-radius: 0 0 6px 6px;
        }

        .password-box {
            font-size: 1.5rem;
            background-color: #e9ecef;
            padding: 1rem;
            text-align: center;
            border-radius: 6px;
            margin: 1rem 0;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .footer {
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Welcome to Our System</h2>
        </div>
        <div class="email-body">
            <p>Hello,</p>
            <p>Your account has been created successfully. Below is your temporary password:</p>

            <div class="password-box">{{ $password }}</div>

            <p>Please use this password to log in and make sure to change it after your first login.</p>
            <p>If you have any questions, feel free to contact support.</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Login</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Equipment Tracker. All rights reserved.
        </div>
    </div>
</body>

</html>
