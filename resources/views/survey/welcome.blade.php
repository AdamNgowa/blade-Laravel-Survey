<x-guest-layout>
    <div class="w-full">
        <h1 class="text-2xl font-bold text-center mb-6">
            Financial Survey
        </h1>
        <p class="text-gray-600 text-center mb-6">
            Enter access code to start the survey.
        </p>
        <form 
        action={{ route('survey.start') }} 
        method="post"
        >
        @csrf

        <div>
            <input 
            type="text" 
            name="access_code" 
            placeholder="Enter Access Code"
            class="w-full rounded border-x-gray-300"
            required>
        </div>

        @error('access_code')
            <p class="text-red-500 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

        <button
            type="submit"
            class="w-full mt-4 bg-blue-600 text-white py-2 rounded"
        >Start Survey
    </button>
    </form>

    <a 
    href={{ route('purchase.index') }} 
    class="block text-center mt-6 bg-green-600 text-white py-2 rounded">
     Buy access codes
    </a>

    @guest
        <div class="text-center mt-6">
            <a 
            href={{ route('login') }} 
            class="text-blue-600">
        Login
    </a>

    <span class="mx-2">|</span>

    <a 
    href={{ route('register') }} 
    class="text-blue-600">Register</a>
        </div>
    @endguest
    </div>
</x-guest-layout>