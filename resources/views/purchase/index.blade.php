<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Access Codes</title>
</head>
<body>
    <form action="{{ route('purchase.checkout') }}" method="post">
        @csrf
        <label >Number of access codes</label>
        <input type="number" name="quantity" min="1" max="100" required>

        <button type="submit">
            Continue to payment
        </button>

    </form>
</body>
</html>