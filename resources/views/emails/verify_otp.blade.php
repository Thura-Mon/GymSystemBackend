<!DOCTYPE html>
<html>
<head>
    <title>Your OTP Code</title>
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 32px rgba(44, 62, 80, 0.13);
            padding: 38px 30px;
            border: 1px solid #e3e3e3;
        }
        .header {
            text-align: center;
            margin-bottom: 18px;
        }
        .header-icon {
            font-size: 5em;
            color: #25eb99ff;
            margin-bottom: 8px;
        }
        .header-title {
            font-size: 1.7em;
            color: #06c475ff;
            font-weight: 900;
            margin-bottom: 4px;
        }
        .greeting {
            text-align: center;
            color: #00ffa6ff;
            font-size: 1.1em;
            margin-bottom: 18px;
        }
        .otp-container {
            background: linear-gradient(90deg , #99eeb7ff 0%, #72f8a1ff 20%, #25eb6eff 100%);
            border-radius: 12px;
            color: white;
            font-size: 2.4em;
            font-weight: bold;
            letter-spacing: 10px;
            text-align: center;
            padding: 20px 0;
            margin: 24px 0;
            border: 1px solid #e2ffecff;
            box-shadow: 0 2px 20px hsla(125, 85%, 81%, 1.00);
        }
        .instructions {
            text-align: center;
            color: #000000ff;
            font-size: 1.05em;
            margin-bottom: 10px;
        }
        .expire {
            text-align: center;
            color: #ef4444;
            font-size: 1em;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 0.95em;
            margin-top: 32px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-icon">🔑</div>
            <div class="header-title">Verify Your Account</div>
        </div>
        <div class="otp-container">{{ $otp }}</div>
        <div class="instructions">Use this OTP to verify your account and continue your registration.</div>
        <div class="expire">This code will expire in 2 minutes.</div>
        <div class="footer">If you did not request this, please ignore this email.</div>
    </div>
</body>