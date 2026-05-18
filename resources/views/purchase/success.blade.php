<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Success</title>
</head>
<body>
    <h1>Payment Successful</h1>

    <p>Quantity: {{$purchase->quantity}}</p>
    <p>Amount: {{number_format($purchase->amount)}}</p>
    
    
</body>
</html>