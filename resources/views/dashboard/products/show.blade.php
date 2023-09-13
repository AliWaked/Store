<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-2xl -mt-4">
        <a href="{{ route('dashboard.products.index') }}"
            class=" inline-block float-right mr-4 text-lg text-gray-500 border-2 border-gray-500 hover:bg-gray-500 hover:text-white transition px-4 py-1 rounded-md">Back</a>
    </div>
    <section class="show-product mt-12 ml-6 flex gap-x-12">
        <div class="product-image" style="max-width: 50%;">
            <img src="{{ asset('storage/' . $product->product_image) }}" alt="product image" class=" rounded-sm shadow-md">
        </div>
        <div class="product-content">
            <h3 class="product-name text-3xl font-bold mb-6">{{ $product->product_name }}</h3>
            <span class="product-price block text-red-500 font-semibold text-3xl">{{ $product->price }}</span>
            <div class="mt-4">
                <div class="color text-3xl font-semibold inline-block text-gray-700">Colors</div>
                <div class="size inline-block ml-14 font-semibold text-gray-700 text-3xl">Sizes</div>
                <div>
                    @php
                        $array = [];
                        foreach ($product->colors as $color) {
                            if (!in_array($name = $color->color_name, array_keys($array))) {
                                $array[$name] = [$color->pivot->size];
                            } else {
                                $array[$name][] = $color->pivot->size;
                            }
                        }
                    @endphp
                    @foreach ($array as $key => $value)
                        <div class="mt-4">
                            <span
                                class="inline-flex justify-center items-center w-20 rounded-xl mr-14 h-12 bg-gray-200 text-gray-700 capitalize text-lg font-semibold"
                                style="color:{{ $key }}">{{ $key }}</span>
                            @foreach ($value as $size)
                                <span
                                    class="inline-flex justify-center items-center uppercase w-12 h-12  bg-gray-200 ml-4 rounded-full"
                                    style="color:{{ $key }}">{{ $size }}</span>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-dashboard.layout>
