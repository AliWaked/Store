<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashbaord</title>
    @vite('resources/css/app.css')
    @vite('resources/js/department.js')
</head>

<body class="flex">
    <div class="left-side min-h-screen w-1/6">
        <span class="block border-b border-gray-300 h-16 w-full"></span>
        <x-nav />
    </div>
    <div class="right-side flex-1">
        <nav
            class="navbar h-16 flex justify-between shadow-lg px-8  w-full bg-white items-center uppercase font-semibold">
            <a href="" class="inline-block  text-red-500 ">Admin</a>
            <form action="{{ route('logout') }}" method="post" class="inline-block  text-red-500 ">
            @csrf
                <button type="submit" class=" uppercase">logout</button>
            </form>
        </nav>
        <div class="content">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
