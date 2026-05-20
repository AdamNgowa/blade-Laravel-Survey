<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-4">

        {{-- Success Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-800">
                Payment successful
            </h1>
            <p class="text-gray-500 mt-2">
                Your access codes have been generated successfully
            </p>
        </div>

        {{-- Purchase summary card --}}
        <div class="bg-white shadow rounded-lg p-6 mb-8 border">
            <h2 class="text-xl font-semibold mb-4">
                Purchase summary
            </h2>
            <div class="space-y-2 text-gray-700">
                <div class="flex justify-between">
                    <span>Quantity</span>
                    <span class="font-semibold">
                        {{ $purchase->quantity }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span>Total amount</span>
                    <span class="font-semibold">
                        KES {{ number_format($purchase->amount) }}
                    </span>
                </div>
            </div>

            {{-- Access Codes --}}
            <div class="bg-white shadow rounded-lg p-6 border">
                <h2 class="text-xl font-ssemibold mb-4">
                    Your access codes
                </h2>
                <p class="text-sm text-gray-500 mb-6">
                    Keep these codes safe. Each can only be used once.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($codes as $code )
                        <div class="border rounded-lg p-4 bg-gray-50 flex justify-between items-center">
                            <span class="font-mono text-lg tracking-wider">
                                {{ $code->code }}
                            </span>
                            <span class="text-xs text-gray-500">
                                UNUSED
                            </span>
                        </div>
                        
                    @endforeach
                </div>
            </div>
            {{-- CTA --}}
            <div class="text-center mt-10">
                <a href={{ route('landing') }} class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                    Go to survey
                </a>
            </div>
        </div>
    </div>
</x-app-layout>