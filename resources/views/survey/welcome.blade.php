<!DOCTYPE html>
<html>
<head>
    <title>Financial Survey</title>
</head>
<body>

    <h1>Financial Survey</h1>

    <form method="POST" action="{{ route('survey.start') }}">
        @csrf

        <input
            type="text"
            name="access_code"
            placeholder="Enter Access Code"
        >

        @error('access_code')
            <p style="color:red">
                {{ $message }}
            </p>
        @enderror

        <button type="submit">
            Start Survey
        </button>
    </form>

</body>
</html>