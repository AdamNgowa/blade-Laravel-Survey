<!DOCTYPE html>
<html>
<head>
    <title>Survey Question</title>
</head>
<body>

    <h2>
        Question {{ $index }} of {{ $total }}
    </h2>

    <p>
        <strong>{{ $question->question }}</strong>
    </p>

    <form method="POST" action="{{ route('survey.answer', $attempt) }}">
        @csrf

        <input
            type="hidden"
            name="question_id"
            value="{{ $question->id }}"
        >

        <input
            type="hidden"
            name="index"
            value="{{ $index }}"
        >

        @foreach($question->answers as $answer)

            <div style="margin-bottom: 10px;">

                <label>

                    <input
                        type="radio"
                        name="answer_id"
                        value="{{ $answer->id }}"
                        required
                    >

                    {{ $answer->answer }}

                </label>

            </div>

        @endforeach

        <button type="submit">
            {{ $index == $total ? 'Finish Survey' : 'Next Question' }}
        </button>

    </form>

</body>
</html>