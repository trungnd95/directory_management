<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            You had been added to become administrator at Directory.dev
            Your password is <strong>{{ $password}}</strong>
            If you wanna change old password to your password.Please follow the link below to verify your email address
            <strong>{{ URL::to('administration/register/verify/' . $confirmation_code) }}.</strong><br/>

        </div>

    </body>
</html>