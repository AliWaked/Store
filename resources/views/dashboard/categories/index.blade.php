<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-3xl mb-6 mt-6">Categories <a
            href="{{ route('dashboard.categories.trash') }}"
            class=" inline-block float-right mr-4 text-lg text-gray-500 border-2 border-gray-500 hover:bg-gray-500 hover:text-white transition px-4 py-1 rounded-md">Trash</a>
    </div>
    {{-- <x-alert :alerts="['success' => ['text-green-500', 'outline-green-500'], 'delete' => ['text-red-500', 'outline-red-500']]" /> --}}

    @if (count($categories) > 0)
        <section class="department-index ml-8">
            <table class=" w-[1080px] mb-12">
                <thead class="bg-red-500 text-white py-6 px-6 block rounded-tl-lg rounded-tr-lg">
                    <tr class="flex items-center justify-center text-center capitalize">
                        {{-- <th class="w-1/6 ">Category logo</th> --}}
                        <th class="w-1/6 ">Category number</th>
                        <th class="w-1/6 ">Category name</th>
                        <th class="w-1/6 ">Category Parent</th>
                        <th class="w-1/6 ">status</th>
                        <th class="w-1/6 ">number of products</th>
                        <th class="w-1/12 ">edit</th>
                        <th class="w-1/12">delete</th>
                    </tr>
                </thead>
                <tbody class=" block text-center ">
                    @php
                        $number = 0;
                    @endphp
                    @foreach ($categories as $category)
                        <tr
                            class="flex items-center justify-center text-gray-600 @if ($number++ % 2 == 0) bg-gray-100 @else bg-gray-50 @endif py-4 px-4 ">
                            {{-- <td class="w-1/6 ">
                                <img src="{{ asset('storage/' . $category->category_logo) }}" alt="category image"
                                    class="w-20 h-20 rounded-lg mx-auto">
                            </td> --}}
                            <td class="w-1/6 ">{{ $category->id }}</td>
                            <td class="w-1/6 capitalize">{{ $category->name }}</td>
                            <td class="w-1/6 capitalize">{{ $category->parent->name }}</td>
                            <td
                                class="w-1/6 @if ($category->status->value === \App\Enums\CategoryStatus::ACTIVE->value) text-green-500 @else text-red-500 @endif text-lg ">
                                {{ $category->status }}</td>
                            <td class="w-1/6 ">{{ $category->products->count() }}</td>
                            <td class="w-1/12 ">
                                <form action="{{ route('dashboard.categories.edit', $category->slug) }}" class="">
                                    <button type="submit"
                                        class="box-border inline-block w-[50px] hover:bg-orange-100 py-2 rounded-md"><i
                                            class="fa-solid fa-pen text-yellow-500"></i></button>
                                </form>
                            </td>
                            <td class="w-1/12 box-border">
                                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" class=""
                                    method="post">
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
            No Categories
        </section>
    @endif
    <div class="mx-8 mt-12">
        {{ $categories->withQueryString()->links() }}
    </div>
</x-dashboard.layout>
