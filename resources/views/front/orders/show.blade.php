<x-layout>
    <div class="w-10/12 mx-auto mt-4 mb-36">
        <a href="{{ route('front.favourite') }}"
            class="font-semibold inline-block mb-16 px-4 py-2 bg-slate-800 text-white hover:bg-white border-2 border-slate-800 hover:bg-transparent transition hover:text-slate-800 rounded-lg">Your
            Favourite</a>
        <div class="info flex  gap-x-12 ml-4 mb-16">
            <div class="flex w-1/3">
                <i
                    class="fa-solid fa-user text-red-500 text-xl h-12 w-12 rounded-full bg-red-100 flex justify-center items-center"></i>
                <p class="text-gray-500 ml-4">
                    <span class="text-black font-bold">Customer</span>
                    <br>
                    {{ Auth::user()->name }}
                    <br>
                    {{ Auth::user()->email }}
                </p>
            </div>
            <div class="flex w-1/3">
                <i
                    class="fa-solid fa-truck  text-red-500 text-xl h-12 w-12 rounded-full bg-red-100 flex justify-center items-center"></i>
                <p class="text-gray-500 ml-4">
                    <span class="text-black font-bold">Order Info</span>
                    <br>
                    {{ 'Postal Code: ' . $order->address->postal_code }}
                    <br>
                    {{ 'Total Price: ' . $order->total_price + 5 }}
                </p>
            </div>
            <div class="flex w-1/3">
                <i
                    class="fa-solid fa-location-dot text-red-500 text-xl h-12 w-12 rounded-full bg-red-100 flex justify-center items-center"></i>
                <p class="text-gray-500 ml-4">
                    <span class="text-black font-bold">Deleiver to</span>
                    <br>
                    {{ $order->address->street }}
                    <br>
                    {{ $order->address->city }}
                    <br>
                    {{ $order->address->countiry }}
                </p>
            </div>



        </div>
        <div class="content">
            <div class="header capitalize font-semibold grid grid-cols-9 w-full">
                <div class="col-span-4">product</div>
                <div class="col-span-1">color</div>
                <div class="col-span-1">size</div>
                <div class="col-span-1">price</div>
                <div class="col-span-1">quantity</div>
                <div class="col-span-1">total</div>
            </div>
            <hr class="mt-4 mb-4 bg-gray-400">
            @forelse ($order->orderItems()->get() as $orderItem)
                <div class="header capitalize font-semibold grid grid-cols-9 w-full text-left mb-6 text-gray-500">
                    <div class="col-span-4 h-16 my-auto">
                        <span>{{ $orderItem->product_name }}</span>
                    </div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500">{{ $orderItem->color }}
                    </div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 ml-4 " id="subtotal">
                        {{ $orderItem->size }}</div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 ml-2">
                        ${{ $orderItem->price }}</div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500">
                        {{ $orderItem->quantity }}</div>
                    <div class="col-span-1 h-12 remove-from-cart mt-2 text-gray-500 flex items-center">
                        {{ $orderItem->price * $orderItem->quantity }}
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="p-12 shadow-lg w-[250px] mt-16 ml-auto capitalize">
            {{-- <span class="text-3xl uppercase font-semibold block text-center">order summary</span> --}}
            <p class="text-right text-gray-700">
                sub total: $ {{ $order->total_price }}
                <br>
                tax: $5
                <br>
                total price: ${{ $order->total_price + 5 }}
            </p>

            {{-- <div class=" mt-6">
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
            @endif --}}
        </div>
    </div>
</x-layout>
