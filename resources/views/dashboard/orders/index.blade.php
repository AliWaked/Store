<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">Orders
    </div>
    <x-alert :alerts="['success' => ['text-green-500', 'outline-green-500'], 'delete' => ['text-red-500', 'outline-red-500']]" />

    @if (count($orders) > 0)
        <section class="department-index ml-8">
            <table class=" w-[1080px] mb-12">
                <thead class="bg-red-500 text-white py-6 px-6 block rounded-tl-md rounded-tr-md capitalize">
                    <tr class="flex text-left">
                        <th class="w-2/12 ">Name</th>
                        <th class="w-4/12 ">Email</th>
                        <th class="w-1/12 ">total price</th>
                        <th class="w-2/12 ml-4 relative left-4">date</th>
                        <th class="w-2/12 relative left-6">status</th>
                        <th class="w-1/12 ">action</th>
                    </tr>
                </thead>
                <tbody class=" block ">
                    @php
                        $number = 0;
                    @endphp
                    @foreach ($orders as $order)
                        <tr
                            class="flex items-center text-gray-600 @if ($number++ % 2 == 0) bg-gray-100 @else bg-gray-50 @endif py-4 px-4 ">
                            <td class="w-2/12 ">
                                {{ $order->user->name }}
                            </td>
                            <td class="w-4/12 ">{{ $order->user->email }}</td>
                            <td class="w-1/12 ">
                                ${{ $order->total_price }}
                            </td>
                            <td class="w-2/12 ">{{ (new Carbon\Carbon($order->created_at))->isoFormat('MMM Do Y') }}
                            </td>
                            <td class="w-2/12 capitalize">
                                <span
                                    class="@if ($order->status->value == 'delivered') bg-green-500 @else bg-gray-900 @endif capitalize text-white font-semibold h-8 w-[120px] flex justify-center items-center rounded-md"
                                    style="text-wrap:nowrap">{{ $order->status }}</span>
                            </td>
                            <td class="w-1/12 ">
                                <form action="{{ route('dashboard.orders.show', $order->id) }}" class="">
                                    <button type="submit"
                                        class="box-border inline-block w-[50px] hover:bg-red-100 py-2 rounded-md"><i
                                            class="fa-sharp fa-solid fa-eye text-red-500"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </section>
    @else
        <section
            class="department-index flex justify-center items-center min-w-full h-[400px] font-semibold text-4xl text-red-400">
            No Orders
        </section>
    @endif
    <div class="mx-8 mt-12">
        {{ $orders->withQueryString()->links() }}
    </div>
</x-dashboard.layout>
