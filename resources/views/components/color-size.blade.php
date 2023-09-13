@props(['colors' => [], 'sizes' => [], 'name' => 'size[]', 'color_size'])
{{-- {{ dd($sizes) }} --}}
<div class="">
    <div class="flex capitalize text-lg text-gray-400">
        <span class="block mb-2 -ml-1 w-1/12">Sizies :</span>
        <span class="block mb-2 ml-6">colors :</span>
    </div>
    @foreach ($sizes as $size)
        <div class="flex items-center  mb-2">
            <div class="flex items-center mr-6 cursor-pointer w-1/12">
                <input type="checkbox" name="size[{{ $size }}]" id="{{ $size }}" value="{{ $size }}"
                    @checked(in_array($size, array_keys($color_size))) class=" border-gray-400 cursor-pointer">
                <label for="{{ $size }}"
                    class=" inline-block text-gray-400 ml-2 uppercase cursor-pointer">{{ $size }}</label>
            </div>
            @foreach ($colors as $color)
                <div class="flex items-center mr-6 cursor-pointer">
                    <input type="checkbox" name="color[{{ $size }}][{{ $color }}]"
                        id="{{ $color . $size }}" value="{{ $color }}" class=" border-gray-400 cursor-pointer"
                        @checked(in_array($color, $color_size[$size] ?? []))>
                    <label for="{{ $color . $size }}"
                        class=" inline-block text-gray-400 ml-2 uppercase cursor-pointer">{{ $color }}</label>
                </div>
            @endforeach
        </div>
    @endforeach

</div>
