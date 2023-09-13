    <section class="add-category">
        <div class="title ml-8 font-semibold capitalize text-2xl mb-4 mt-4">
            {{ $title }}
        </div>

        <form action="{{ route($route, $category->id) }}" method="post" class="w-1/3 ml-8 mt-8"
            enctype="multipart/form-data">
            @csrf
            @if (isset($put))
                @method('put')
            @endif
            <div class="relative">
                <span class=" absolute w-[125px] h-[3px] bg-white -top-[2px] left-3"></span>
                <x-input-label for="name" :value="__('Category Name *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name)"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="relative">
                {{-- <span class=" absolute w-32 h-[3px] bg-white  left-3"></span> --}}
                <label for="category-image" class="mb-2 mt-6 block text-gray-400">Category Logo :</label>
                <x-text-input id="image" class="block mt-1 w-full text-gray-400 border p-2" type="file"
                    name="category_logo" :value="old('category_logo', $category->category_logo)" required autofocus />
                <x-input-error :messages="$errors->get('category_logo')" />
            </div>
            @if ($category->category_logo)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $category->category_logo) }}" alt="" class="rounded-md">
                </div>
            @endif
            <div class="relative mt-6">
                <span class="block mb-2 capitalize text-lg text-gray-400">Parent Category :</span>
                <x-select :categories="$categories" name='parent_id' :value="$category->parent_id" />
                <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
            </div>
            <div class="relative mt-2">
                <span class="block mb-2 capitalize text-lg text-gray-400">Departments :</span>
                <x-checkbox :values="[...$departments]" name="department[]" :departments="$departmentCategory ?? []" />
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>
            <div class="relative -mb-8 mt-6">
                <span class="block mb-4 capitalize text-gray-400 text-xl">status:</span>
                <x-radio name='status' :radioes="['active', 'archive']" :value="$category->status" />
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>
            <button type="submit"
                class="box-border text-white bg-red-500 uppercase h-14 w-full mt-12 rounded-md hover:text-red-500 hover:border-2  hover:border-red-500 hover:bg-white transition font-semibold text-lg">
                {{ $button }}</button>
        </form>
    </section>
