<x-dashboard.layout>
    <section class="add-department">
        <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">
            Add Department
        </div>

        <form action="{{ route('dashboard.departments.store') }}" method="post" class="w-1/3 ml-8 mt-8"
            enctype="multipart/form-data">
            @csrf
            <div class="relative">
                <span class=" absolute w-[144px] h-[3px] bg-white -top-[2px] left-3"></span>
                <x-input-label for="name" :value="__('Department Name *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="department_name"
                    :value="old('department_name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
            </div>
            <div class="relative">
                {{-- <span class=" absolute w-32 h-[3px] bg-white  left-3"></span> --}}
                <label for="department-image" class="mb-2 mt-6 block text-gray-400">Department Image:</label>
                <x-text-input id="image" class="block mt-1 w-full text-gray-400 border p-2" type="file"
                    accept='image/*' name="department_logo" :value="old('departemnt_logo')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('department_logo')" />
            </div>
            <img src="" id="department_image" alt="" class="">
            <button type="submit"
                class="box-border text-white bg-red-500 uppercase h-14 w-full mt-12 rounded-md hover:text-red-500 hover:border-2  hover:border-red-500 hover:bg-white transition font-semibold text-lg">Add
                New
                Department</button>
        </form>
    </section>
    <x-slot:script>
        <script>
            document.querySelector('input#image').onchange = function() {
                document.getElementById('department_image').classList.add('mt-4')
                document.getElementById('department_image').src = URL.createObjectURL(this.files[0]);
            }
        </script>
    </x-slot:script>
</x-dashboard.layout>
