<x-layout>
    @vite('resources/js/checkout.js')
    <div class="shpping parent flex items-center cursor-default w-fit mx-auto mt-12">
        <div class="number w-8 h-8 rounded-full bg-red-500 text-white font-semibold flex justify-center items-center mr-2"
            id='numberOne'>
            1</div>
        <span class=" w-72 h-[1px] bg-gray-200" id="number-1"></span>
        <div
            class="number w-8 h-8 rounded-full bg-gray-300 text-white font-semibold flex justify-center items-center mr-2 ml-2"id='number-2'>
            2</div>
        <span class=" w-72 h-[1px] bg-gray-200" id="num-2"></span>
        <div class="number w-8 h-8 rounded-full bg-gray-300 text-white font-semibold flex justify-center items-center ml-2"
            id="number-3">
            3</div>
    </div>
    <div class="w-1/2 mx-auto mt-12" id='shopping'>
        <form action="" class='w-full shadow-lg px-6 py-8 rounded-lg border-0 outline-0'>
            <div class="form-control">
                <label for="street" class="text-gray-500">Street</label>
                <input type="text" name="street" id="street"
                    class="focus:border-0 box-border rounded-sm focus:outline-0 border-0 mt-2 shadow-none bg-gray-200 focus:border-b border-red-500 w-full border-b-2">
                <x-input-error :messages="$errors->get('street')" />
            </div>
            <div class="form-control mt-4 ">
                <label for="address" class="text-gray-500">City</label>
                <input type="text" name="city" id="city"
                    class="focus:border-0 rounded-sm box-border focus:outline-0 border-0 mt-2 shadow-none bg-gray-200 focus:border-b border-red-500 w-full border-b-2">
            </div>
            <div class="form-control mt-4 ">
                <label for="address" class="text-gray-500">Country</label>
                <input type="text" name="country" id="country"
                    class="focus:border-0 rounded-sm box-border focus:outline-0 border-0 mt-2 shadow-none bg-gray-200 focus:border-b border-red-500 w-full border-b-2">
            </div>
            <div class="form-control mt-4 ">
                <label for="address" class="text-gray-500">Phone</label>
                <input type="number" name="phone" id="phone"
                    class="focus:border-0 rounded-sm box-border focus:outline-0 border-0 mt-2 shadow-none bg-gray-200 border-red-500 w-full border-b-2">
            </div>
            <div class="form-control mt-4 ">
                <label for="postal_code" class="text-gray-500">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code"
                    class="focus:border-0 rounded-sm focus:outline-0 border-0 mt-2 shadow-none bg-gray-200 focus:border-b border-red-500 w-full border-b-2">
            </div>
            <div class="form-control mt-4">
                <span type=""
                    class="font-bold address-information text-center cursor-pointer text-xl uppercase text-white bg-red-500 rounded-lg box-border border-2 border-red-500 hover:text-red-500 hover:bg-white transition block w-full py-3 mt-8">
                    shipping</span>
            </div>
        </form>
    </div>
    <div id="payment" class="p-12 shadow-lg w-[400px] mt-16 absolute top-8 -left-full transition-all ">
        <span class="text-3xl uppercase font-semibold block text-center">order summary</span>

        <div class=" mt-6">
            <div class="flex justify-between mb-4 capitalize">
                <div class="">subtotal</div>
                <div class="" id="subtotal"></div>
            </div>
            <div class="flex justify-between mb-4 capitalize">
                <div class="">tax</div>
                <div class="">$5</div>
            </div>
            <div class="flex justify-between mb-8 capitalize">
                <div class="">total</div>
                <div class="" id="total"></div>
            </div>
        </div>
        <form action="" id="form-to-pay" method="post">
            @csrf
            <button type="submit" id="pay-now"
                class="uppercase border-2 bg-red-500 w-full rounded-md border-red-500 text-white font-semibold py-2 hover:text-red-500 hover:bg-white transition block">Pay
                Now</button>
        </form>
    </div>
    <div id="thankyou" class="w-1/2 mx-auto mt-16 mb-16 hidden shadow-lg py-16 rounded-lg text-center">
        <div class="title text-2xl font-bold mb-4 ">Your order has been received</div>
        <i class="fa-solid fa-circle-check text-6xl text-green-500 mt-4 mb-4"></i>

        <span class="block text-2xl mb-4">Thank you for your purchase!</span>
        <a href="/"
            class="font-bold text-xl uppercase text-white bg-red-500 rounded-lg box-border border-2 border-red-500 hover:text-red-500 hover:bg-white transition inline-block px-6 mx-auto py-3 mt-4 ">continue
            shopping</a>

    </div>

    <script>
        const csrf_token = "{{ csrf_token() }}";
        // const success = "{{ Session::get('success') }}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        if ("{{ Session::has('success') }}") {
            $('#payment').removeClass('left-[450px]');
            $('#shopping').addClass('hidden');
            $('#payment').addClass('-left-full');
            $('#num-2').removeClass('bg-gray-200');
            $('#num-2').addClass('bg-red-500');
            $('#number-1').removeClass('bg-gray-200');
            $('#number-1').addClass('bg-red-500');
            $('#number-2').addClass('bg-red-500');
            $('#thankyou').removeClass('hidden');
            $('#numberOne').html('<i class="fa-solid fa-check"></i>');
            $('#number-2').html('<i class="fa-solid fa-check"></i>');
            $('#number-3').addClass('bg-red-500');
        }
    </script>
</x-layout>
{{-- 
     <i class="fa-solid fa-heart"></i>
     <i class="fa-solid fa-star"></i>
     <i class="fa-regular fa-star"></i>
     <i class="fa-solid fa-circle-check"></i>
     <i class="fa-solid fa-check"></i>
     
     
     
     
     
    
     <i class="fa-solid fa-envelope"></i>
     <i class="fa-solid fa-eye"></i>
     <i class="fa-solid fa-user"></i>
     <i class="fa-solid fa-truck"></i>
     --}}
