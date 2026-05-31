<x-guest-layout>
    <div class="w-full max-w-xl mx-auto">

        <div class="bg-white shadow rounded-lg p-8 text-center">

            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Survey Completed
            </h1>

            <div class="text-5xl font-bold text-blue-600 mb-4">
                {{ $percentage }}%
            </div>

            <p class="text-lg text-gray-700 mb-6">
                {{ $message }}
            </p>

            {{-- Simple status badge --}}
            <div class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm mb-6">
                Financial Health Score
            </div>

            <div class="space-y-3">

                <a
                    href="{{ route('landing') }}"
                    class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded"
                >
                    Take Another Survey
                </a>

                <a
                    href="{{ route('purchase.index') }}"
                    class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded"
                >
                    Buy More Access Codes
                </a>

            </div>

        </div>

    </div>
</x-guest-layout>