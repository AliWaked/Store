<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">Dashboard </div>
    <div class="ml-8 flex gap-x-12 mt-8 text-gray-500   ">
        <div class="w-1/3 border-b border-gray-300 flex pb-2 gap-x-2 number-of-user shadow-sm px-4">
            <i
                class="fa-solid fa-user text-blue-500 text-xl h-12 w-12 rounded-full bg-blue-100 flex justify-center items-center"></i>
            <span class="block">
                Total Users
                <br>
                {{ App\Models\User::all()->count() }}
            </span>
        </div>
        <div class="w-1/3 border-b border-gray-300 flex pb-2 gap-x-2 number-of-orders shadow-sm px-4">
            <i
                class="fa-solid fa-cart-shopping text-green-500 text-xl h-12 w-12 rounded-full bg-green-100 flex justify-center items-center"></i>
            <span class="block">
                Total Orders
                <br>
                {{ App\Models\Order::all()->count() }}
            </span>
        </div>
        <div class="w-1/3 border-b border-gray-300 flex pb-2 gap-x-2 number-of-products shadow-sm px-4">
            <i
                class="fa-solid fa-bag-shopping text-red-500 text-xl h-12 w-12 rounded-full bg-red-100 flex justify-center items-center"></i>
            <span class="block">
                Total Products
                <br>
                {{ App\Models\Product::all()->count() }}
            </span>
        </div>
    </div>
    <div class="ml-8 mt-12  text-gray-500 flex gap-x-12">
        <div class="cart w-1/3">
            <div class="title font-semibold text-xl">Top Departments
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="order-info w-2/3 shadow-md pb-12 pt-6 px-8 rounded-lg">
            <div class="titel font-semibold text-xl">Latest transactions</div>
            <div class="grid grid-cols-4 mt-6 border border-gray-200">
                <div class="col-span-1 font-semibold border-b border-gray-200 pb-2 px-4 py-4">Customer</div>
                <div class="col-span-1 font-semibold border-b border-gray-200 pb-2 px-4 py-4">Total Price</div>
                <div class="col-span-1 font-semibold border-b border-gray-200 pb-2 px-4 py-4">Date</div>
                <div class="col-span-1 font-semibold border-b border-gray-200 pb-2 px-4 py-4">Status</div>
                @forelse ($orders as $order)
                    <div class="col-span-1 border-b border-gray-200 py-4 px-4">
                        {{ App\Models\User::where('id', $order->user_id)->first()->name }}</div>
                    <div class="col-span-1 border-b border-gray-200 py-4 px-4">
                        {{ $order->orderItems()->get()->sum(function ($item) {return $item->price;}) }}</div>
                    <div class="col-span-1 border-b border-gray-200 py-4 px-4">
                        {{ (new Carbon\Carbon($order->created_at))->isoFormat('MMM Do Y') }}</div>
                    <div class="col-span-1 border-b border-gray-200 py-4 px-4"><a href=""
                            class="@if ($order->status == 'delivered') bg-green-500 @else bg-gray-900 @endif capitalize text-white font-semibold h-8 w-24 flex justify-center items-center rounded-md">{{ $order->status }}</a>
                    </div>
                @empty
                    <div class="text-red-500 col-span-4 mt-12 uppercase text-center font-extrabold text-4xl">no orders
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div>
    </div>
<x-slot:script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        const ctx = document.getElementById('myChart');
        department = "{{ $dept_name }}";
        // console.log(department)
        department = department.split(",");
        department.pop()
        count = "{{ $count }}";
        color = [];
        for (let i = 0; i < department.length; i++) {
            // color.push(i);
            color.push(`rgb(${getRandomInt(255)}, ${getRandomInt(255)}, ${getRandomInt(255)})`)
        }
        console.log(getRandomInt(5), color, department.length, department);

        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }


        const data = {
            labels: department,
            datasets: [{
                label: department,
                data: count.split(','),
                backgroundColor: [
                    ...color
                ],
                hoverOffset: 4
            }]
        };
        new Chart(ctx, {
            type: 'doughnut',
            data,
            // options: {
                //     scales: {
                    //         y: {
                        //             beginAtZero: true
                        //         }
                        //     }
                        // }
                    });
                    </script>

</x-slot:script>
</x-dashboard.layout>
