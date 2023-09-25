<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-3xl mb-6 mt-6">Departments Trashed<a
            href="{{ route('dashboard.departments.index') }}"
            class=" inline-block float-right mr-4 text-lg text-gray-500 border-2 border-gray-500 hover:bg-gray-500 hover:text-white transition px-4 py-1 rounded-md">Back</a>
    </div>
    @if (count($departments) > 0)
        <section class="department-index ml-8">
            <table class=" w-[1080px] mb-12">
                <thead class="bg-red-500 text-white py-5 px-4 block rounded-tl-md rounded-tr-md">
                    <tr class="flex items-center justify-center text-center capitalize">
                        {{-- <th class="w-1/6 ">department image</th> --}}
                        <th class="w-1/5 ">department number</th>
                        <th class="w-1/5 ">department name</th>
                        <th class="w-1/5 ">number of categories</th>
                        <th class="w-1/5 ">number of products</th>
                        <th class="w-[10%] ">restore</th>
                        <th class="w-[10%]">force-delete</th>
                    </tr>
                </thead>
                <tbody class=" block text-center ">
                    @php
                        $number = 0;
                    @endphp
                    @foreach ($departments as $department)
                        <tr
                            class="flex text-gray-700 items-center justify-center @if ($number++ % 2 == 0) bg-gray-100 @else bg-gray-50 @endif py-4 px-4 ">
                            {{-- <td class="w-1/6 ">
                                <img src="{{ asset('storage/' . $department['department-logo']) }}"
                                    alt="department image" class="w-20 h-20 rounded-lg mx-auto">
                            </td> --}}
                            <td class="w-1/5 ">{{ $department->id }}</td>
                            <td class="w-1/5 capitalize">{{ $department->department_name }}</td>
                            <td class="w-1/5 ">{{ $department->categories_count }}</td>
                            <td class="w-1/5 ">{{ $department->products_count }}</td>
                            <td class="w-[10%] ">
                                <form action="{{ route('dashboard.departments.restore', $department->id) }}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit"
                                        class="box-border inline-block w-[50px] hover:bg-orange-100 py-2 rounded-md"><i
                                            class="fa-solid fa-rotate text-yellow-500"></i></button>
                                </form>
                            </td>
                            <td class="w-[10%] box-border">
                                <form action="{{ route('dashboard.departments.force-delete', $department->id) }}"
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
            No Department Trash
        </section>
    @endif
</x-dashboard.layout>
