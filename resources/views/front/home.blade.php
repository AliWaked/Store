<x-layout>
    <section class="department -mt-5">
        <div class="home-image bg-gray-300 h-[500px] ">
            <img src="{{ asset('asset/image/home.jpg') }}" alt="home-image" class="w-full h-full">
        </div>
        <h2 class="header font-bold text-3xl text-center mt-12">
            {{ __('Shop By Departments') }}
        </h2>
        <div class=" w-7/12 mx-auto grid grid-cols-3 gap-x-12 mt-20">
            @foreach ($departments as $department)
                <div class="content flex justify-center items-center flex-col">
                    {{-- @dd($department->image); --}}
                    <img src="{{ $department->image }}" alt=""
                        class="department-image h-[220px] w-[220px] rounded-full">
                    <form action="{{ route('front.product.index', $department->slug) }}" method="get"
                        class="department-name w-full mt-4"><button type="submit"
                            class="bg-gray-200 text-zinc-600 w-full h-8 hover:bg-red-500 hover:text-white transition uppercase">{{ $department->department_name }}</button>
                    </form>
                </div>
            @endforeach

        </div>
    </section>
    <div class="products mt-24 mb-24">
        <h1 class=" text-center text-4xl my-8 text-red-500" style="letter-spacing: 6px">New Interval</h1>
        <div class="grid grid-cols-6 gap-x-4 gap-y-8" id="new-product-add">
            <x-product :products="$products" department_slug="{{ $department->slug }}" />
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @vite('resources/js/home.js')
</x-layout>
