<x-layout>
    @vite('resources/js/cart.js')
    <div class="w-10/12 mx-auto mt-12 mb-36">
        <h3 class="font-semibold mb-8 text-3xl">Your Favourite</h3>
        <div class="content">
            <div class="header capitalize font-semibold grid grid-cols-7 w-full">
                <div class="col-span-1">iamge</div>
                <div class="col-span-2">title</div>
                <div class="col-span-1">total price</div>
                <div class="col-span-1">size</div>
                <div class="col-span-1">color</div>
                <div class="col-span-1">action</div>
            </div>
            <hr class="mt-4 mb-4 bg-gray-400">
            @forelse ($products as $product)
                {{-- {{ dd() }} --}}
                <div class="header capitalize font-semibold grid grid-cols-7 w-full text-left mb-6"
                    id="{{ $product->product->slug }}">
                    <div class="col-span-1 h-16 my-auto">
                        <img src="{{ asset('storage/' . $product->product->product_image) }}"
                            alt="{{ $product->product->product_image }}" class="h-full">
                    </div>
                    <div class="col-span-2 h-16 flex items-center text-gray-500">{{ $product->product->product_name }}
                    </div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 ml-4 " id="subtotal">
                        ${{ $product->quantity * $product->product->price }}</div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 ml-2">
                        {{ $size = $product->options['size'] }}</div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500">
                        {{ $color = $product->options['color'] }}</div>
                    <div class="col-span-1 h-12 remove-from-cart mt-2 text-gray-500 flex items-center rounded-md transition hover:text-red-500 cursor-pointer hover:bg-red-200 w-fit px-6"
                        id="remove-from-cart" data-slug="{{ $product->product->slug }}" data-size="{{ $size }}"
                        data-color="{{ $color }}">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="p-12 shadow-lg w-[400px] mt-16">
            <span class="text-3xl uppercase font-semibold block text-center">order summary</span>

            <div class=" mt-6">
                <div class="flex justify-between mb-4 capitalize">
                    <div class="">subtotal</div>
                    <div class="" id="subtotal">${{ $total }}</div>
                </div>
                <div class="flex justify-between mb-4 capitalize">
                    <div class="">tax</div>
                    <div class="">$5</div>
                </div>
                <div class="flex justify-between mb-8 capitalize">
                    <div class="">total</div>
                    <div class="" id="total">${{ $total + 5 }}</div>
                </div>
            </div>
            @if ($products->count())
                <form action="{{ route('checkout') }}" method="get">
                    <button type="submit" id="checkout"
                        class="uppercase border-2 bg-red-500 w-full rounded-md border-red-500 text-white font-semibold py-2 hover:text-red-500 hover:bg-white transition block">checkout</button>
                </form>
            @endif
        </div>
    </div>
    <script>
        const csrf_token = "{{ csrf_token() }}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</x-layout>
