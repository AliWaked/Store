@props(['products', 'department_slug'])
@foreach ($products as $product)
    <div>
        <img src="{{ $product->image }}" alt="product image" class="h-[200px]">
        <div class="content text-center">
            <div class="name mt-2 text-gray-700 ">{{ $product->product_name }}</div>
            <div class="price mt-1 text-red-500 font-bold text-lg">${{ $product->price }}</div>
            <form action="{{ route('front.product.show', [$product->slug]) }}">
                <button type="submit"
                    class="text-red-500 box-border w-full h-12 uppercase text-lg font-semibold border-2 border-red-400 mt-4 rounded-md hover:text-white hover:bg-red-500 hover:border-red-500 transition">view</button>
            </form>
        </div>
    </div>
@endforeach
