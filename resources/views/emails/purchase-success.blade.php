<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Access codes</title>
</head>
<body>    
    <div style="font-family: Arial, sans-serif; max-width:600px; margin:auto; padding:20px; border:1px solid #eee; border-radius:10px;">

    <h1 style="text-align:center; color:#16a34a;">
        Payment Successful
    </h1>

    <p style="text-align:center; color:#555;">
        Your access codes are ready.
    </p>

    <hr>

    <h3>Purchase Summary</h3>

    <p><strong>Quantity:</strong> {{ $purchase->quantity }}</p>
    <p><strong>Total:</strong> KES {{ number_format($purchase->amount) }}</p>
    <p><strong>Status:</strong> {{ $purchase->status }}</p>

    <hr>

    <h3>Your Access Codes</h3>

    @foreach($codes as $code)
        <div style="padding:10px; margin:8px 0; background:#f9f9f9; border:1px solid #ddd; border-radius:6px;">
            <strong style="font-family:monospace; font-size:16px;">
                {{ $code->code }}
            </strong>
        </div>
    @endforeach

</div>
</body>
</html>