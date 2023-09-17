<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    <h4>Dear {{$data['user_name']}}</h4>
    <h4>You have successfully purchased the {{$data['product_name']}} that has price ${{$data['price']}}.</h4>
    <p>You have made the transaction using card <b>{{$data['card_type']}}</b> and last 4 digits of the card {{$data['last_four']}}</p>

    @if(isset($data['password']))
    <p><b>Your account password is {{ $data['password'] }}</b></p>
    @endif
</body>
</html>