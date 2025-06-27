<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Admin CRM</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            padding: 30px;
            color: #1a202c;
        }
        .email-container {
            max-width: 620px;
            margin: auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        h1 {
            color: #2d3748;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .cta-button {
            margin-top: 30px;
            display: inline-block;
            background-color: #1a73e8;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 500;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #718096;
        }
    </style>
</head>
<body>
<div class="email-container">
    <h1>Welcome, {{ $user->name }}</h1>
    <p>
        You have been successfully registered as an <strong>Administrator</strong> in the CRM system.
    </p>

    <p>
        As an admin, you now have full access to manage users, monitor activity, and configure system settings to ensure smooth operation of your organization.
    </p>

    <a href="{{ url('http://localhost:8000/dashboard') }}" class="cta-button">Access Admin Dashboard</a>

    <div class="footer">
        Need help? Reach out to our support team or reply to this email.
    </div>
</div>
</body>
</html>
