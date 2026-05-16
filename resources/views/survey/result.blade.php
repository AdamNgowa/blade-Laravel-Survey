<!DOCTYPE html>
<html>
<head>
    <title>Survey Result</title>
</head>
<body>

    <h1>Survey Completed</h1>

    <h2>
        Your Score:
        {{ $percentage }}%
    </h2>

    <h3>
        {{ $message }}
    </h3>

    <a href="{{ route('landing') }}">
        Return Home
    </a>

</body>
</html>