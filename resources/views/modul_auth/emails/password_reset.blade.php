<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #3b82f6;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reset Your Password</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Click the button below to reset your password:</p>
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </div>
            <p>This password reset link will expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Regards,<br>Concrete Plant Management System</p>
            <hr>
            <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
            <p style="word-break: break-all;"><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Concrete Plant Management System. All rights reserved.
        </div>
    </div>
</body>
</html>