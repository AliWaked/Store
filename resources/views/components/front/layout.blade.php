<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/color.js')
</head>

<body>
    <nav class="navbar h-24 w-full z-50">
        <div class="flex justify-between py-5 shadow-lg px-8 fixed top-0 left-0 w-full bg-white">
            <div class="logo select-none font-bold text-3xl">Store</div>
            <div class="links font-semibold text-lg uppercase">
                <a href="/" class="inline-block mr-3 hover:text-red-500 transition ">home</a>
                <a href="{{ route('front.favourite') }}"
                    class="inline-block mr-3 hover:text-red-500 transition ">favourite</a>
                <a href="{{ route('front.cart.shopping') }}"
                    class="inline-block mr-3 hover:text-red-500 transition ">cart</a>
                <a href="{{ route('front.order.index') }}"
                    class="inline-block mr-3 hover:text-red-500 transition ">orders</a>
                @if (Auth::id())
                    <form action="{{ route('logout') }}" method='post' class="inline-block">
                        @csrf
                        <button type="submit"
                            class="inline-block mr-3 hover:text-red-500 transition uppercase ">logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-block mr-3 hover:text-red-500 transition ">login</a>
                @endif
            </div>
        </div>
    </nav>
    {{ $slot }}
    <footer class="w-full mt-12 bg-gray-900 py-12 text-white font-semibold ">
        <div class="flex justify-around">
            <div class="app-name w-1/4 ml-8">
                <div class="name mb-2 text-4xl">Store</div>
                <p>we help you find everthing you need easily</p>
            </div>
            <div class="w-1/4 ml-4">
                <div class="name text-2xl mb-4">Quick Links</div>
                <a href="" class="hover:text-red-500 w-fit transition block mb-2">Home</a>
                <a href="" class="hover:text-red-500 w-fit transition block mb-2">Shop</a>
                <a href="" class="hover:text-red-500 w-fit transition block">Cart</a>
            </div>
            <div class="w-1/4">
                <div class="name text-2xl mb-4">Social Media</div>
                <a href="" class="hover:text-red-500 w-fit transition block mb-2"><i
                        class="fa-brands fa-facebook mr-1 inline-block"></i> Facebook.com</a>
                <a href="" class="hover:text-red-500 w-fit transition block mb-2"><i
                        class="fa-brands fa-twitter mr-1 inline-block"></i> Twitter.com</a>
                <a href="" class="hover:text-red-500 w-fit transition block mb-2"> <i
                        class="fa-brands fa-instagram mr-1 inline-block"></i> Instagram.com</a>
                <a href="" class="hover:text-red-500 w-fit transition block"><i
                        class="fa-brands fa-linkedin mr-1 inline-block"></i> Linkedin.com</a>
            </div>
            <div class="w-1/4">
                <div class="name text-2xl mb-4">Contact Us</div>
                <a href="" class="hover:text-red-500 w-fit transition block mb-2"><i
                        class="fa-solid fa-phone mr-1 inline-block"></i> 123456789</a>
                <a href="" class="hover:text-red-500 w-fit transition block mb-2"><i
                        class="fa-solid fa-location-dot mr-1 inline-block"></i> XYZ, abc</a>
                <a href="" class="hover:text-red-500 w-fit transition block"><i
                        class="fa-solid fa-envelope mr-1"></i> xyz@gmail.com</a>
            </div>
        </div>
    </footer>
</body>

</html>
