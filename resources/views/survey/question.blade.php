<x-guest-layout>
    <div class="w-full max-w-2xl mx-auto">

        {{-- Progress --}}
        <div class="text-sm text-gray-500 mb-4 text-center">
            Question {{ $index }} of {{ $total }}
        </div>

        {{-- Card --}}
        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">
                {{ $question->question }}
            </h2>

            <form method="POST" action="{{ route('survey.answer', $attempt) }}">
                @csrf

                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <input type="hidden" name="index" value="{{ $index }}">

                <div class="space-y-3">
                    @foreach($question->answers as $answer)
                        <label class="flex items-center border rounded-lg p-3 cursor-pointer hover:bg-gray-50">
                            <input
                                type="radio"
                                name="answer_id"
                                value="{{ $answer->id }}"
                                class="mr-3"
                                required
                            >
                            <span class="text-gray-700">
                                {{ $answer->answer }}
                            </span>
                        </label>
                    @endforeach
                </div>

                <button
                    type="submit"
                    class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded"
                >
                    {{ $index == $total ? 'Finish Survey' : 'Next Question' }}
                </button>
            </form>

        </div>
    </div>
</x-guest-layout>