<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">Users
    </div>
    <x-alert :alerts="['success' => ['text-green-500', 'outline-green-500'], 'delete' => ['text-red-500', 'outline-red-500']]" />

    @if (count($users) > 0)
        <section class="department-index ml-8">
            <table class=" w-[1080px] mb-12">
                <thead class="bg-red-500 text-white py-6 px-6 block rounded-tl-xl rounded-tr-xl">
                    <tr class="flex items-center justify-evenly text-center">
                        <th class="w-2/6 ">id</th>
                        <th class="w-1/6 ">Name</th>
                        <th class="w-2/6 ">Email</th>
                    </tr>
                </thead>
                <tbody class=" block text-center ">
                    @php
                        $number = 0;
                    @endphp
                    @foreach ($users as $user)
                        <tr
                            class="flex items-center justify-evenly @if ($number++ % 2 == 0) bg-gray-200 @endif py-8 px-6 ">
                            <td class="w-2/6 ">{{ $user->id }}</td>
                            <td class="w-1/6 capitalize">{{ $user->name }}</td>
                            <td class="w-2/6 capitalize">{{ $user->email }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </section>
    @else
        <section
            class="department-index flex justify-center items-center min-w-full h-[400px] font-semibold text-4xl text-red-400">
            No Users
        </section>
    @endif
    <div class="mx-8 mt-12">
        {{ $users->withQueryString()->links() }}
    </div>
</x-dashboard.layout>
