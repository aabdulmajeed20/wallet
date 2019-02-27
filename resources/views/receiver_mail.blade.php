<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Dear {{$receiver_wallet->user()->first()->name}} </h2>

<div>
    <p>You have received a new transaction from {{$sender_wallet->user()->first()->name}}</p>
    <br>
    <h4>Amount: {{$transaction->amount}} </h4>
    <br/>
</div>

</body>
</html>