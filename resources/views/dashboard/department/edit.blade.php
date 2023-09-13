<x-dashboard.layout>
    <section class="add-department">
        <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">
            Update Department
            <a href="{{ route('dashboard.departments.index') }}"
                class=" inline-block float-right mr-4 text-lg text-gray-500 border-2 border-gray-500 hover:bg-gray-500 hover:text-white transition px-4 py-1 rounded-md">Back</a>
        </div>

        <form action="{{ route('dashboard.departments.update', $department->id) }}" method="post" class="w-1/3 ml-8 mt-8"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="relative">
                <span class=" absolute w-[144px] h-[3px] bg-white -top-[2px] left-3"></span>
                <x-input-label for="name" :value="__('Department Name *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="department-name"
                    :value="old('department-name', $department['department-name'])" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('department-name')" class="mt-2" />
            </div>
            <div class="relative">
                {{-- <span class=" absolute w-32 h-[3px] bg-white  left-3"></span> --}}
                <label for="department-image" class="mb-2 mt-6 block text-gray-400">Department Image:</label>
                <x-text-input id="image" class="block mt-1 w-full text-gray-400 border p-2" type="file"
                    name="department-logo" :value="old('departemnt-logo')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('department-logo')" />
            </div>
            <div class="mt-4">
                <img src="{{ asset('storage/' . $department['department-logo']) }}" alt="" class="rounded-md">
                {{ $department['department-logo'] }}
            </div>
            <button type="submit"
                class="box-border text-white bg-red-500 uppercase h-14 w-full mt-12 rounded-md hover:text-red-500 hover:border-2  hover:border-red-500 hover:bg-white transition font-semibold text-lg">
                Update
                The Department</button>
        </form>
    </section>
</x-dashboard.layout>
{{-- uploads/Departments/Ml6SfRukQQvrynNQIdvqUOrGJwSV3OZ4SGDkG2jG.png --}}
{{-- uploads/Departments/FgQIi93yZZpMfBoZxkL5hc9H2AnQpvLQBC8PnJnI.png --}}