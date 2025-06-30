<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Invoice is Ready – Proceed to Payment</title>
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
            background-color: #6772e5;
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
    <h1>Hello {{ $invoice->customer->name }},</h1>

    <p>
        Your invoice titled <strong>{{ $invoice->title ?? 'Invoice Ppayment' }}</strong> has been marked as <strong>sent</strong>.
    </p>

    <p>
        The total amount due is <strong>${{ number_format($invoice->amount, 2) }}</strong>. Please click the button below to proceed with secure payment via Stripe.
    </p>

    <a href="{{ $paymentUrl }}" class="cta-button" target="_blank">Pay Invoice Now</a>

    <div class="footer">
        If you have any questions, feel free to reply to this email or contact our support team.
    </div>
</div>
</body>
</html>
