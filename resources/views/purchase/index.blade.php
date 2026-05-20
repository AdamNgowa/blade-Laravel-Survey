<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">
            Purchase Access Code
        </h1>

        {{-- Pricing cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            {{-- Starter package --}}
            <div class="bg-white shadow rounded-lg p-6 border">
                <h2 class="text-xl font-bold mb-4">
                    Starter Package
                </h2>
                <p class="text-gray-600 mb-2">
                    1-5 codes
                </p>
                <p class="text-2xl font-bold text-blue-600">
                    Kes 2000
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    Per code
                </p>
            </div>
            {{-- Business Package --}}
            <div class="bg-white shadow rounded-lg p-6 border">

                <h2 class="text-xl font-bold mb-4">
                    Business Package
                </h2>

                <p class="text-gray-600 mb-2">
                    6 - 20 Access Codes
                </p>

                <p class="text-2xl font-bold text-green-600">
                    KES 1500
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Per code
                </p>

            </div>

            <!-- Enterprise Package -->

            <div class="bg-white shadow rounded-lg p-6 border">

                <h2 class="text-xl font-bold mb-4">
                    Enterprise Package
                </h2>

                <p class="text-gray-600 mb-2">
                    21 - 100 Access Codes
                </p>

                <p class="text-2xl font-bold text-purple-600">
                    KES 1000
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Per code
                </p>

            </div>

        </div>

        <div class="bg-white shadow rounded-lg p-6 border">
            <form 
            action={{ route('purchase.checkout') }} 
            method="post">

            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Number of access codes
                </label>
                <input 
                id="quantity"
                type="number"
                name="quantity"
                min="1"
                max="100"
                required
                class="w-full border-gray-300 rounded-md shadow-md"
                >
            </div>

            {{-- Total Amount --}}
            <div class="mb-6">
                <p class="text-lg font-semibold">
                    Total Amount:
                    <span id="totalAmount">
                        KES 0
                    </span>
                </p>
            </div>

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-md">
                Pay with Paypal
            </button>

        </form>
        </div>
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');
        const totalAmount = document.getElementById('totalAmount');

        quantityInput.addEventListener('input',function () {
            let quantity = parseInt(this.value) || 0;
            let price = 0;
            if(quantity >= 1 && quantity <= 5){
                price = 2000;
            } else if(quantity>=6 && quantity<= 20){
                price = 1500;
            }else if(quantity >= 21 && quantity<=100){
                price = 1000;
            }

            let total = quantity * price;
            totalAmount.textContent  = 'KES' + total.toLocaleString();
            
        })
    </script>
</x-app-layout>