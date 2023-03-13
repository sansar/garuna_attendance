<!DOCTYPE html>
<html>
<head>
<title>{{ $mailData['title'] }}</title>
<style>
    @font-face{
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src:url('{{ storage_path("fonts/ArialMon.ttf")}}');
}
body,body>h1 {
font-family: ipag;
}
</style>
</head>
<body>
<h1>Сайн байна уу?</h1>
<div>Танхимд орохдоо доорх QR кодыг уншуулж орно уу.</div>
<img src="{{ $mailData['body']}}" width="300" height="300">
</body>
</html>
