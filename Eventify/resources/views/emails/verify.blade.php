<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f2f4f6; color: #333333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { text-align: center; font-size: 24px; font-weight: bold; color: #333333; }
        .message { font-size: 16px; color: #51545e; margin: 20px 0; }
        .button-container { text-align: center; margin: 20px 0; }
        .button { display: inline-block; padding: 12px 24px; font-size: 16px; color: #ffffff; background-color: #333333; border-radius: 5px; text-decoration: none; }
        .footer { font-size: 12px; color: #777777; text-align: center; margin-top: 20px; }
        .footer a { color: #333333; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Eventify</div>

        <p class="message"><strong>Hello!</strong></p>
        <p class="message">Please click the button below to verify your email address.</p>

        <div class="button-container">
            <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
        </div>

        <p class="message">
            If you did not create an account, no further action is required.
        </p>

        <p class="message">Regards,<br>Eventify</p>

        <hr>

        <p class="footer">
            If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
            <br>
            <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
        </p>
    </div>
</body>
</html>
