<!DOCTYPE html>
<html>
<head>
    <title>Financial Survey</title>
    <style>
        /* Apply border-box globally to fix layout spacing issues */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9; /* Soft background color for the screen */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Centers the form perfectly on the screen */
            margin: 0;
        }

        .welcome-form {
            background: #ffffff; /* Swapped the dark gray for a clean white card */
            width: 100%;
            max-width: 400px; /* Prevents it from getting awkwardly wide */
            border-radius: 12px;
            padding: 30px; /* Generous breathing room inside */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Fixed broken box-shadow syntax */
            text-align: center; /* Centers the heading text */
        }

        .welcome-form h1 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #333;
            font-size: 24px;
        }

        /* Group form items nicely */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Creates clean, automatic gaps between input, error, and button */
        }

        .form-input {
            border: 2px solid #ccc; /* Subdued the harsh blue border */
            border-radius: 6px;
            height: 45px; /* Slightly taller for a modern, touch-friendly feel */
            padding: 0 15px; /* Keeps placeholder text away from the edges */
            font-size: 16px;
            width: 100%; /* Spans full width of the container */
            outline: none;
            transition: border-color 0.2s;
        }

        /* Changes border color when the user clicks inside */
        .form-input:focus {
            border-color: #0056b3; 
        }

        .srt-survey-btn {
            background-color: #0056b3; /* Darker, professional blue fill */
            color: white;
            border: none;
            border-radius: 6px;
            height: 45px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s;
        }

        .srt-survey-btn:hover {
            background-color: #004085; /* Darkens slightly when hovered */
            box-shadow:2px 2px #0056b3;
        }
    </style>
</head>
<body>

    <div class="welcome-form">
        <h1>Financial Survey</h1>
        
        <form method="POST" action="{{ route('survey.start') }}">
            @csrf

            <input
                class="form-input"
                type="text"
                name="access_code"
                placeholder="Enter Access Code"
            >

            @error('access_code')
                <p style="color:red; margin: 0; font-size: 14px; text-align: left;">
                    {{ $message }}
                </p>
            @enderror

            <button class="srt-survey-btn" type="submit">
                Start Survey
            </button>
        </form>
    </div>

</body>
</html>