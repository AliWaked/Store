<x-dashboard.layout>
    @vite('resources/js/order.js')
    <div class=" w-11/12 mx-auto mt-4">
        <a href="{{ route('dashboard.orders.index') }}"
            class="font-semibold inline-block mb-16 px-4 py-2 bg-slate-800 text-white mt-4 hover:bg-white border-2 border-slate-800 hover:bg-transparent transition hover:text-slate-800 rounded-md">
            Back To Orders</a>
        <div class="info flex  gap-x-12 mb-16">
            <div class="flex w-1/3">
                <i
                    class="fa-solid fa-user text-red-500 text-xl h-12 w-12 rounded-full bg-red-100 flex justify-center items-center"></i>
                <p class="text-gray-500 ml-4">
                    <span class="text-black font-bold">Customer</span>
                    <br>
                    {{ $order->user->name }}
                    <br>
                    {{ $order->user->email }}
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
                    {{ 'Total Price: $' . $order->total_price + 5 }}
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
            <div class="header capitalize font-semibold grid grid-cols-12 w-full ">
                <div class="col-span-4 border-b border-gray-200 pb-4">product</div>
                <div class="col-span-1 border-b border-gray-200 pb-4">color</div>
                <div class="col-span-1 border-b border-gray-200 pb-4">size</div>
                <div class="col-span-1 border-b border-gray-200 pb-4">price</div>
                <div class="col-span-1 border-b border-gray-200 pb-4">quantity</div>
                <div class="col-span-1 border-b border-gray-200 pb-4">total</div>
                <button id="delivered" data-order="{{ $order->id }}"
                    class="block col-span-3 ml-8 font-semibold uppercase py-2 bg-slate-800 text-white hover:bg-white border-2 border-slate-800 hover:bg-transparent transition hover:text-slate-800 rounded-lg">delivered</button>
            </div>
            @forelse ($order->orderItems()->get() as $orderItem)
                <div class="header capitalize font-semibold grid grid-cols-12 w-full text-left mb-6 text-gray-500">
                    <div class="col-span-4 h-16 my-auto border-b flex items-center border-gray-200">
                        <img src="{{ asset('storage/' . $orderItem->product->product_image) }}" class="h-4/6 mr-2">
                        <span class="">{{ $orderItem->product_name }}</span>
                    </div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 border-b border-gray-200">
                        {{ $orderItem->color }}
                    </div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 border-b border-gray-200 pl-2 "
                        id="subtotal">
                        {{ $orderItem->size }}</div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 border-b border-gray-200">
                        ${{ $orderItem->price }}</div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 border-b pl-2 border-gray-200">
                        {{ $orderItem->quantity }}</div>
                    <div
                        class="col-span-1 h-16 remove-from-cart  text-gray-500 border-b border-gray-200 flex items-center">
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

        </div>
    </div>
    <script>
        const csrf_token = "{{ csrf_token() }}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</x-dashboard.layout>
