<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>{{ $mailData['title'] }}</title>
    <style>
        @font-face {
            font-family: arialmon;
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path("fonts/ArialMon.ttf")}}');
        }
        body, body > h1 {
            font-family: arialmon;
        }
    </style>
</head>
<body>
<p style="font-size: 16px">Сайн байна уу?</p>
<div>Танхимд орохдоо доорх QR кодыг уншуулж орно уу.</div>
<img src="{{ $mailData['body']}}" width="400" height="400">
</body>
</html>
