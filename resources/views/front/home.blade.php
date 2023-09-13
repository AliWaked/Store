<x-layout>
    <section class="department -mt-5">
        <div class="home-image bg-gray-300 h-[500px] ">
            <img src="{{ asset('asset/image/clothes.png') }}" alt="home-image" class="w-full h-full">
        </div>
        <h2 class="header font-bold text-3xl text-center mt-12">
            Shop By Departments
        </h2>
        <div class=" w-7/12 mx-auto grid grid-cols-3 gap-x-12 mt-20">
            @foreach ($departments as $department)
                <div class="content flex justify-center items-center flex-col">
                    <img src="{{ asset('storage/'.$department['department-logo']) }}" alt=""
                        class="department-image h-[220px] w-[220px] rounded-full">
                    <form action="{{route('front.department.index',$department->slug)}}" method="get" class="department-name w-full mt-4"><button type="submit"
                            class="bg-gray-200 text-zinc-600 w-full h-8 hover:bg-red-500 hover:text-white transition uppercase">{{$department['department-name']}}</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
</x-layout>
