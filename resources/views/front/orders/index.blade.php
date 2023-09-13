<x-layout>
    <div class="w-10/12 mx-auto mt-12 mb-36">
        <h3 class="font-semibold mb-8 text-3xl">Orders</h3>
        <div class="content">
            <div class="header capitalize font-semibold grid grid-cols-7 w-full">
                <div class="col-span-1">order Id</div>
                <div class="col-span-2">Number of Items</div>
                <div class="col-span-1">Amount</div>
                <div class="col-span-1">Date</div>
                <div class="col-span-1">Status</div>
                <div class="col-span-1">action</div>
            </div>
            <hr class="mt-4 mb-4 bg-gray-400 ">
            @forelse ($orders as $order)
                <div class="header capitalize font-semibold grid grid-cols-7 w-full text-left mb-6">
                    <div class="col-span-1 h-16 my-auto text-gray-500 flex items-center">
                        {{ $order->number }}
                    </div>
                    <div class="col-span-2 h-16 flex items-center text-gray-500">
                        {{ $order->OrderItems()->count() }}
                    </div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 ml-4 " id="subtotal">
                        ${{ $order->orderitems()->get()->sum(function ($item) {
                                return $item->price;
                            }) }}
                    </div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500 ml-2">
                        {{ (new Carbon\Carbon())->isoFormat('ddd Do Y') }}
                    </div>
                    <div
                        class="col-span-1 h-16 flex items-center @if ($order->status == 'delivered') text-green-500 @else text-red-500 @endif">
                        {{ $order->status }}
                    </div>
                    <a href="{{ route('front.order.show', $order->id) }}"
                        class="col-span-1 h-12 remove-from-cart mt-2 text-gray-500 flex items-center rounded-md transition  cursor-pointer bg-orange-400 w-fit px-6">
                        <i class="fa-sharp fa-solid fa-eye text-white"></i>
                    </a>
                </div>
            @empty
            @endforelse
        </div>

    </div>
</x-layout>
