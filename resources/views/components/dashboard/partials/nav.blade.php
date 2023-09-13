<div class="nav-links shadow-lg h-full">
    <ul class=" list-none">
        @foreach ($links as $link)
            <li
                class=" text-gray-600 flex py-3 hover:text-red-500 transition  {{ !Route::is($link['active']) ?: ' bg-red-500 text-white hover:text-white' }}">
                <div class="icon w-5"><i class="{{ $link['icon'] }}  ml-4 text-lg"></i></div>
                <form action="{{ route($link['route']) }}" method="get"><button type="submit"
                        class="text-lg ml-12">{{ $link['title'] }}</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
