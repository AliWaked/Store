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
    <div class="left-side min-h-screen w-1/6 hidden lg:block">
        <span class="block border-b border-gray-300 h-16 w-full"></span>
        <x-nav />
    </div>
    <div class="right-side flex-1">
        <nav
            class="navbar h-16 flex justify-between shadow-sm px-8  w-full bg-white items-center uppercase font-semibold">
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
    <div id="alert">

    </div>
    <script>
        if ("{{ Session::has('success') }}") {
            document.getElementById('alert').innerHTML = `
            <div
                class=" fixed capitalize bottom-1 w-fit gap-3 text-sm bg-green-500 flex justify-between items-center py-3 px-8 pr-12 text-white rounded-md left-1">
                <i class="fa-solid fa-circle-check"></i>
                <span>
                    {{ Session::get('success') }}
                </span>
            </div>
        `;
            setTimeout(() => {
                document.getElementById('alert').innerHTML = '';
            }, 5000);
        }
    </script>
    {{ $script ?? '' }}
</body>

</html>
