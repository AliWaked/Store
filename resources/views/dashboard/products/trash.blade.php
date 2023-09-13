<x-dashboard.layout>
    <div class="title ml-8 font-semibold text-2xl mb-4 mt-4">Products Trashed<a
            href="{{ route('dashboard.products.index') }}"
            class=" inline-block float-right mr-4 text-lg text-gray-500 border-2 border-gray-500 hover:bg-gray-500 hover:text-white transition px-4 py-1 rounded-md">Back</a>
    </div>
    @if (count($products) > 0)
        <section class="department-index ml-8">
            <table class=" w-[1080px] mb-12">
                <thead class="bg-red-500 text-white py-6 px-6 block rounded-tl-xl rounded-tr-xl">
                    <tr class="flex items-center justify-center text-center capitalize">
                        <th class="w-1/6 ">product image</th>
                        <th class="w-1/6 ">product number</th>
                        <th class="w-1/6 ">product name</th>
                        <th class="w-1/6 ">price</th>
                        <th class="w-1/6 ">Category </th>
                        <th class="w-1/12 ">edit</th>
                        <th class="w-1/12">delete</th>
                    </tr>
                </thead>
                <tbody class=" block text-center ">
                    @php
                        $number = 0;
                    @endphp
                    @foreach ($products as $product)
                        <tr
                            class="flex items-center justify-center @if ($number++ % 2 == 0) bg-gray-200 @endif py-8 px-6 ">
                            <td class="w-1/6 ">
                                <img src="{{ asset('storage/' . $product->product_image) }}" alt="category image"
                                    class="w-20 h-20 rounded-lg mx-auto">
                            </td>
                            <td class="w-1/6 ">{{ $product->id }}</td>
                            <td class="w-1/6 capitalize">{{ $product->product_name }}</td>
                            <td class="w-1/6 text-lg ">
                                {{ $product->price }}</td>
                            <td class="w-1/6 capitalize">{{ $product->category?->name ?? 'trashed' }}</td>
                            <td class="w-1/12 ">
                                <form action="{{ route('dashboard.products.restore', $product->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit"
                                        class="box-border inline-block w-4/6 hover:bg-orange-200 py-2 rounded-md"><i
                                            class="fa-solid fa-rotate text-yellow-600"></i></button>
                                </form>
                            </td>
                            <td class="w-1/12 box-border">
                                <form action="{{ route('dashboard.products.force-delete', $product->id) }}"
                                    class="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="box-border inline-block w-4/6 hover:bg-red-200 py-2 rounded-md"><i
                                            class="fa-solid fa-trash text-red-700"></i></button>
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
            No product Trash
        </section>
    @endif
    <div class="mx-8 mt-12">
        {{ $products->withQueryString()->links() }}
    </div>
</x-dashboard.layout>