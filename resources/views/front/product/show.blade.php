{{-- {{dd($product->colors()->get()->groupBy('color_name')->toArray())}} --}}
<x-layout>
    @vite('resources/js/favourite.js')
    @vite('resources/js/reviews.js')
    <div class="show-product flex w-10/12 mx-auto mt-4">
        <div class="product-image  w-1/2 h-[calc(100vh-200px)]">
            <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="h-full">
        </div>
        <div class="product-content w-1/2 ml-8">
            <form action="{{ route('front.cart.add', $product->id) }}" method="post" class="">
                @csrf
                <div class="w-4/6">
                    <span class="block font-bold text-3xl capitalize">{{ $product->product_name }}</span>
                    <div class="price font-bold text-2xl text-red-500 mt-4">{{ $product->price }}</div>
                    <div class=" w-full mt-4">
                        <select name="color_name" id=""
                            class="w-full h-14 text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize">
                            <option value="">Color</option>
                            @foreach ($product->colors()->get()->groupBy('color_name')->toArray() as $color => $array)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('color_name')" class="mt-2" />
                        <select name="size_name" id=""
                            class="w-full h-14 text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize mt-6">
                            <option value="">Size</option>
                            @foreach ($sizes as $size => $array)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('size_name')" class="mt-2" />

                        <input type="number" name="quantity" id="" placeholder="Quantity"
                            class=" w-24 h-14 text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize mt-6">
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />

                    </div>
                    <div class="button flex items-center">
                        <button type="submit"
                            class="uppercase text-white transition hover:text-red-500 border-2 border-red-500 text-lg font-bold w-full bg-red-500 hover:bg-white h-12 mt-8 rounded-full">add
                            to cart</button>
                        @auth
                            <span
                                class="rounded-full border hover:bg-gray-200 hover:border-gray-200 transition border-red-200 w-12 h-10 mt-6 ml-6 flex justify-center items-center cursor-pointer"
                                onclick="document.getElementById('favour').classList.toggle('hidden');document.getElementById('favourite').classList.toggle('hidden')"><span>
                                    <i id='favour' class="fa-solid fa-heart text-red-500 hidden text-lg"></i> <i
                                        id='favourite' data-product="{{ $product->id }}"
                                        class="fa-regular fa-heart text-lg text-red-500 hidden"></i></span></span>
                        @endauth
                    </div>
                    <div class="comment">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="show-product flex w-10/12 mx-auto mt-12 gap-x-12">
        <div class="product-image  w-1/2 ">
            <div class="title uppercase text-gray-500 mt-12 font-semibold text-xl">reviews</div>
            {{-- {{ dd($product->users()->orderBy('updated_at', 'desc')->take(3)->first()->pivot->reviews) }} --}}
            @foreach ($product->users()->orderBy('updated_at', 'desc')->take(3)->get() as $user)
                @if ($user?->pivot->reviews)
                    <div class="review text-lg bg-gray-100 px-2 py-4 rounded-lg mt-8" id='reviews'>
                        <div class="name font-bold">{{ $user->name }}</div>
                        <div class=" text-base text-yellow-400 cursor-default mt-2 mb-2">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $user->pivot->reviews)
                                    <i class="fa-solid fa-star "></i>
                                @else
                                    <i class="fa-regular fa-star text-gray-400"></i>
                                @endif
                                {{-- <i class="fa-solid fa-star"></i> --}}
                                {{-- <i class="fa-solid fa-star"></i> --}}
                            @endfor
                        </div>

                        {{-- {{dd($user->pivot->updated_at)}} --}}
                        <div class="date text-gray-500 mt-3">
                            {{ Carbon\Carbon::parse($user->pivot->updated_at)->diffForHumans() }}</div>
                        <div class="content bg-cyan-200 p-2 rounded-md mt-3">
                            {{ $user->pivot->comment }}
                        </div>
                    </div>
                @else
                    <div class="review text-lg mt-4 rounded-lg ">
                        <div class="content bg-cyan-200 p-2 py-4 rounded-md font-semibold mt-3">
                            No Reviews
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="w-1/2">
            @auth
                <span class="block uppercase text-gray-500 mt-12 font-semibold text-xl">write a customer review</span>
                <div class="rating mt-8 font-bold text-lg">Rating</div>
                <div class="mt-4 text-gray-400">
                    <input type="hidden" name="stars" value="0">
                    {{-- <i class="fa-solid fa-star"></i> --}}
                    <span class=" hover:text-yellow-400 transition"><i
                            class="fa-regular fa-star cursor-pointer star-1 stars"onclick="fun(1)"></i></span>
                    <span class=" hover:text-yellow-400 transition"><i
                            class="fa-regular fa-star cursor-pointer star-1 stars" onclick="fun(2)"></i></span>
                    <span class=" hover:text-yellow-400 transition"><i
                            class="fa-regular fa-star cursor-pointer star-1 stars" onclick="fun(3)"></i></span>
                    <span class=" hover:text-yellow-400 transition"><i
                            class="fa-regular fa-star cursor-pointer star-1 stars" onclick="fun(4)"></i></span>
                    <span class=" hover:text-yellow-400 transition"><i
                            class="fa-regular fa-star cursor-pointer star-1 stars" onclick="fun(5)"></i></span>
                </div>
                <div class="font-bold text-lg mt-8">Comment</div>
                <form action="{{ URL::current() }}">
                    <textarea name="comment" class="comment h-24 bg-gray-100 rounded-md resize-none border-none mt-2 w-[calc(100%-50px)]"></textarea>
                    <span id="send-review"
                        class=" uppercase font-bold block text-lg h-8 border-2 border-red-500 rounded-md  w-[calc(100%-50px)] bg-red-500 text-white text-center cursor-pointer hover:text-red-500 hover:bg-white transition">save</span>
                </form>
            @endauth
        </div>
    </div>
    @auth

        <script>
            const csrf_token = "{{ csrf_token() }}";
            const product_slug = "{{ $product->slug }}";
            let favourite = "{{ $product->users()->where('user_id', auth()->user()->id)->first()?->pivot->favourite }}";
            if (favourite == 'yes') {
                regular = document.getElementById('favour').classList.toggle('hidden');
            } else {
                solid = document.getElementById('favourite').classList.toggle('hidden');
            }
            stars = document.getElementsByClassName('stars');
            stars_number = document.getElementsByName('stars')[0].value;
            textarea = document.getElementsByName('comment')[0].value;

            function fun(number) {
                for (let i = 0; i < 5; i++) {
                    stars[i].classList.remove('text-yellow-400');
                    stars[i].classList.remove('fa-regular');
                    stars[i].classList.remove('fa-solid');
                    stars[i].classList.add('fa-regular');
                }
                for (let i = 0; i < number; i++) {
                    stars[i].classList.toggle('fa-regular');
                    stars[i].classList.toggle('fa-solid');
                    stars[i].classList.toggle('text-yellow-400');
                }
                document.getElementsByName('stars')[0].value = number;
            }
        </script>
    @endauth
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</x-layout>
