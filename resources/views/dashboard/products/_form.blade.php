    <section class="add-category">
        <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">
            Add Product
        </div>
        <form action="{{ route($route, $product->id) }}" method="post" class="w-1/3 ml-8 mt-8"
            enctype="multipart/form-data">
            @csrf
            @if (isset($put))
                @method('put')
            @endif
            <div class="relative">
                <span class=" absolute w-[113px] h-[3px] bg-white -top-[2px] left-3"></span>
                <x-input-label for="name" :value="__('Product Name *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="product_name"
                    :value="old('product_name', $product->product_name)" required autofocus />
                <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
            </div>
            <div class="relative mt-6">
                <span class=" absolute w-[50px] h-[3px] bg-white -top-[2px] left-3"></span>
                <x-input-label for="name" :value="__('price *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="number" name="price" :value="old('price', $product->price)"
                    required autofocus />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <div class="relative w-[250%] mt-4 mb-2">
                <x-color-size :colors="['red', 'blue', 'green', 'yellow', 'black', 'white', 'orange', 'gray']" :sizes="['xl', 'l', 'm', 's']" :color_size="$color_size ?? []" />
            </div>
            <div class="relative mt-2">
                <span class="block mb-2 capitalize text-lg text-gray-400">Category :</span>
                <x-select :categories="$categories" name='category_id' :main="false" :value="old('category_id', $product->category_id)" />
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
            <div class="relative mt-2">
                <span class="block mb-2 capitalize text-lg text-gray-400">Departments :</span>
                <x-checkbox :values="[...$departments]" name="department[]" :departments="old('department', $productDepartment ?? [])" />
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>
            <div class="relative">
                {{-- <span class=" absolute w-32 h-[3px] bg-white  left-3"></span> --}}
                <label for="category-image" class="mb-2 mt-6 block text-gray-400">Product Image :</label>
                <x-text-input id="image" class="block mt-1 w-full text-gray-400 border p-2" type="file"
                    name="product_image" :value="old('product_image')" autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('product_image')" />
            </div>
            @if ($product->product_image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="" class="rounded-md">
                </div>
            @endif
            <button type="submit"
                class="box-border text-white bg-red-500 uppercase h-14 w-full mt-12 rounded-md hover:text-red-500 hover:border-2  hover:border-red-500 hover:bg-white transition font-semibold text-lg">Add
                New
                Product</button>
        </form>
    </section>
    <script>
        const csrf_token = "{{ csrf_token() }}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
