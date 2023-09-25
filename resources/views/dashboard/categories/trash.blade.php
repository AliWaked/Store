<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-3xl mb-6 mt-6">Categories Trashed<a
            href="{{ route('dashboard.categories.index') }}"
            class=" inline-block float-right mr-4 text-lg text-gray-500 border-2 border-gray-500 hover:bg-gray-500 hover:text-white transition px-4 py-1 rounded-md">Back</a>
    </div>
    @if (count($categories) > 0)
        <section class="department-index ml-8">
            <table class=" w-[1080px] mb-12">
                <thead class="bg-red-500 text-white py-6 px-6 block rounded-tl-md rounded-tr-md">
                    <tr class="flex items-center justify-center text-center capitalize">
                        <th class="w-1/5 ">Category number</th>
                        <th class="w-1/5 ">Category name</th>
                        <th class="w-1/5 ">Category Parent</th>
                        <th class="w-1/5 ">status</th>
                        <th class="w-1/5 ">number of products</th>
                        <th class="w-[10%] ">edit</th>
                        <th class="w-[10%]">delete</th>
                    </tr>
                </thead>
                <tbody class=" block text-center ">
                    @php
                        $number = 0;
                    @endphp
                    @foreach ($categories as $category)
                        <tr
                            class="flex items-center justify-center text-gray-600 @if ($number++ % 2 == 0) bg-gray-100 @else bg-gray-50 @endif py-4 px-4 ">
                            <td class="w-1/5 ">{{ $category->id }}</td>
                            <td class="w-1/5 capitalize">{{ $category->name }}</td>
                            <td class="w-1/5 capitalize">{{ $category->parent_id }}</td>
                            <td
                                class="w-1/5 @if ($category->status === 'active') text-green-500 @else text-red-500 @endif text-lg ">
                                {{ $category->status }}</td>
                            <td class="w-1/5 ">adlkjfa</td>
                            <td class="w-[10%] ">
                                <form action="{{ route('dashboard.categories.restore', $category->id) }}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit"
                                        class="box-border inline-block w-[50px] hover:bg-orange-100 py-2 rounded-md"><i
                                            class="fa-solid fa-rotate text-yellow-500"></i></button>
                                </form>
                            </td>
                            <td class="w-[10%] box-border">
                                <form action="{{ route('dashboard.categories.force-delete', $category->id) }}"
                                    class="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="box-border inline-block w-[50px] hover:bg-red-100 py-2 rounded-md"><i
                                            class="fa-solid fa-trash text-red-500"></i></button>
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
            No Category Trash
        </section>
    @endif
    <div class="mx-8 mt-12">
        {{ $categories->withQueryString()->links() }}
    </div>
</x-dashboard.layout>
