@props(['products', 'department_slug'])
@foreach ($products as $product)
    <div>
        <img src="{{ asset('storage/' . $product->product_image) }}" alt="product image" class="h-[200px]">
        <div class="content text-center">
            <div class="name mt-2 text-gray-700 text-2xl">{{ $product->product_name }}</div>
            <div class="price mt-4 font-bold text-2xl">{{ $product->product_price }}</div>
            <form action="{{ route('front.product.show', [$product->slug]) }}">
                <button type="submit"
                    class="text-red-500 box-border w-full h-12 uppercase text-lg font-semibold border-2 border-red-200 mt-4 rounded-lg hover:text-white hover:bg-red-500 hover:border-red-500 transition">view</button>
            </form>
        </div>
    </div>
@endforeach
