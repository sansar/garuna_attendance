<!DOCTYPE html>
<html>
<head>
    <title>{{ $mailData['title'] }}</title>
</head>
<body>
<h1>please scan QR code this attachment</h1>
<img src="{{ $mailData['body']}}" width="300" height="300">
</body>
</html>
