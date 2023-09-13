<x-dashboard.layout>
    {{-- <section class="add-category">
        <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">
            Add Product
            <a href="{{ route('dashboard.products.index') }}"
                class=" inline-block float-right mr-4 text-lg text-gray-500 border-2 border-gray-500 hover:bg-gray-500 hover:text-white transition px-4 py-1 rounded-md">Back</a>
        </div>

        <form action="{{ route('dashboard.products.update',$product->id) }}" method="post" class="w-1/3 ml-8 mt-8"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="relative">
                <span class=" absolute w-[113px] h-[3px] bg-white -top-[2px] left-3"></span>
                <x-input-label for="name" :value="__('Product Name *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="product_name"
                    :value="old('product_name', $product->product_name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
            </div>
            <div class="relative mt-6">
                <span class=" absolute w-[50px] h-[3px] bg-white -top-[2px] left-3"></span>
                <x-input-label for="name" :value="__('price *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="number" name="price" :value="old('price', $product->price)"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            @php
                $array = [];
                foreach ($product->colors as $color) {
                    if (!in_array($name = $color->color_name, array_keys($array))) {
                        $array[$name] = [$color->pivot->size];
                    } else {
                        $array[$name][] = $color->pivot->size;
                    }
                }
                $colors = implode(',', array_keys($array));
                $sizes = array_pop($array);
            @endphp
            <div class=" mt-2">
                <span class="block mb-2 capitalize text-lg text-gray-400">Color "max 4" :</span>
                <input id='input-custom-dropdown' name="color"
                    class='some_class_name h-11 w-full rounded-lg focus:bg-gray-200' placeholder='Color'
                    value="{{ $colors }}">
                <x-input-error :messages="$errors->get('color')" class="mt-2" />
            </div>
            <div class="relative mt-2">
                <span class="block mb-2 capitalize text-lg text-gray-400">Size :</span>
                <x-checkbox :values="['xl', 'l', 'm', 's']" :size="$sizes" />
                <x-input-error :messages="$errors->get('size')" class="mt-2" />
            </div>
            <div class="relative mt-2">
                <span class="block mb-2 capitalize text-lg text-gray-400">Category :</span>
                <x-select :categories="$categories" name='category_id' :main="false" :value="old('category_id', $product->category_id)" />
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
            @php
                $departments = [];
                foreach()
            @endphp
            <div class="relative mt-2">
                <span class="block mb-2 capitalize text-lg text-gray-400">Departments :</span>
                <x-checkbox :values="[...$departments]" name="department[]" />
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>
            <div class="relative">
                <label for="category-image" class="mb-2 mt-6 block text-gray-400">Product Image :</label>
                <x-text-input id="image" class="block mt-1 w-full text-gray-400 border p-2" type="file"
                    name="product_image" value="{{ $product->product_image }}" autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('product_image')" />
            </div>
            <div class="mt-4">
                <img src="{{ asset('storage/' . $product->product_image) }}" alt="" class="rounded-md">
            </div>
            <button type="submit"
                class="box-border text-white bg-red-500 uppercase h-14 w-full mt-12 rounded-md hover:text-red-500 hover:border-2  hover:border-red-500 hover:bg-white transition font-semibold text-lg">Add
                New
                Product</button>
        </form>

    </section> --}}
    @php
        $route = 'dashboard.products.update';
        $put = true;
    @endphp
    @include('dashboard.products._form',[])
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <script>
        var input = document.querySelector('input[id="input-custom-dropdown"]'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                whitelist: ['red', 'blue', 'green', 'yellow', 'black', 'white', 'orange', 'gray'],
                maxTags: 4,
                dropdown: {
                    maxItems: 20, // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0, // <- show suggestions on focus
                    closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
                }
            })
    </script>
</x-dashboard.layout>
