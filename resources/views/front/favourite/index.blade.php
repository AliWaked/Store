<x-layout>
    @vite('resources/js/favourite.js')
    <div class="w-10/12 mx-auto mt-12 mb-36">
        <h3 class="font-semibold mb-8 text-3xl">Your Favourite</h3>
        <div class="content">
            <div class="header capitalize font-semibold grid grid-cols-6 w-full">
                <div class="col-span-1">iamge</div>
                <div class="col-span-3">title</div>
                <div class="col-span-1">price</div>
                <div class="col-span-1">action</div>
            </div>
            <hr class="mt-4 mb-4 bg-gray-400">
            @forelse ($products as $product)
                <div class="header capitalize font-semibold grid grid-cols-6 w-full text-left mb-6"
                    id="{{ $product->slug }}">
                    <div class="col-span-1 h-16 my-auto">
                        <img src="{{ $product->image }}" alt="{{ $product->product_iamge }}" class="h-full">
                    </div>
                    <div class="col-span-3 h-16 flex items-center text-gray-500 cursor-pointer transition hover:text-red-600 "
                        onclick="showProduct(this)" data-url="{{ route('front.product.show', $product->slug) }}">
                        {{ $product->product_name }}</div>
                    <div class="col-span-1 h-16 flex items-center text-gray-500">{{ $product->price }}</div>
                    <div class="col-span-1 remove-from-favourite h-12 mt-2 text-gray-500 flex items-center rounded-md transition hover:text-red-500 cursor-pointer hover:bg-red-100 w-fit px-6"
                        id="remove-from-favourite" data-slug="{{ $product->slug }}">
                        {{-- {{ dd($product->slug)}} --}}
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <script>
        const csrf_token = "{{ csrf_token() }}";

        function showProduct(e) {
            let a = document.createElement('a');
            a.href = e.dataset.url;
            a.click();
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</x-layout>
