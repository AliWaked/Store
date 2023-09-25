<x-layout>
    <section class="show w-[80%] mx-auto mt-4">
        <div class="title font-semibold text-3xl uppercase">{{ $department->department_name }}</div>
        <form action="{{ URL::current() }}" method="get">
            <div class=" flex gap-x-4 mt-8">
                <div class="relative w-full">
                    <span class=" absolute w-[64px] h-[3px] bg-white -top-[2px] left-3"></span>
                    {{-- {{dd($values['category'])}} --}}
                    <x-input-label for="name" :value="__('category')" class=" capitalize -mt-[2px]" />
                    <select name="category_name" id=""
                        class="w-full text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize category-select22"
                        data-department="{{ $department->id }}">
                        <option value="">All</option>
                        @foreach ($categories as $category)
                            @if ($category->products()->first())
                                <option value="{{ $category->id }}" @selected($values['category'] ?? 0 == $category->id)>
                                    {{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="relative w-full">
                    <span class=" absolute w-[30px] h-[3px] bg-white -top-[2px] left-3"></span>
                    <x-input-label for="name" :value="__('size')" class=" capitalize -mt-[2px]" />
                    <select name="size_name" id="sizes22"
                        class="w-full text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize select-size22"
                        data-department="{{ $department->id }}">

                        <option value="">All </option>
                        @if ($values['size'] ?? [])
                            <option value="{{ $values['size'] }}" selected>{{ $values['size'] }} </option>
                        @endif
                    </select>
                </div>
                <div class="relative w-full">
                    <span class=" absolute w-[40px] h-[3px] bg-white -top-[2px] left-3"></span>
                    <x-input-label for="name" :value="__('color')" class=" capitalize -mt-[2px]" />
                    <select name="color_name" id="colors22"
                        class="w-full text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize "
                        data-department="{{ $department->id }}">
                        <option value="">All </option>
                        @if ($values['color'] ?? [])
                        <option value="{{ $values['color'] }}" selected>{{ $values['color'] }} </option>
                    @endif
                    </select>
                </div>
                <button type="submit"
                    class="bg-red-500 text-white box-border w-[700px] h-11 rounded-md hover:bg-white border-2 border-red-500 hover:text-red-500 transition text-lg"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        @if ($products->first())
            <div class="products mt-8">
                <div class="grid grid-cols-6 gap-x-4">
                    <x-product :products="$products" department_slug="{{ $department->slug }}" />
                </div>
            </div>
        @else
            <section
                class="department-index flex justify-center items-center min-w-full h-[400px] font-semibold text-4xl text-red-400">
                No Products
            </section>
        @endif
    </section>
    <script>
        const csrf_token = "{{ csrf_token() }}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</x-layout>
