<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Access codes</title>
</head>
<body>
    <h1>Payment Successful</h1>
    <p>
        Thank you for your purchase
    </p>

    <p>
        Quantity:
        {{ $purchase->quantity }}
    </p>
    <p>
        Amount: 
        {{ number_format($purchase->amount) }}
    </p>
    <h2>Your access codes</h2>
    @foreach ($codes as $code )

    <div>
        <strong>
            {{ $code->code }}
        </strong>
    </div>
        
    @endforeach

    <hr>
    <p>
        Each code can only be used once
    </p>
    
</body>
</html>