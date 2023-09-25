@props(['values', 'departments' => [], 'name' => 'department[]'])
<div class="flex items-center department-checkbox">
    @foreach ($values as $key => $value )
        <div class="flex items-center mr-6 cursor-pointer overflow-hidden flex-1">
            <input type="checkbox" name="{{ $name }}" id="{{ $value }}" value="{{ $key }}"
                class=" border-gray-400 cursor-pointer" @checked(in_array($key, array_keys($departments)))>
            <label for="{{ $value }}"
                class=" inline-block text-gray-400 ml-2 overflow-hidden text-ellipsis uppercase cursor-pointer text-sm" style="text-wrap:nowrap">{{ $value }}</label>
        </div>
    @endforeach
</div>
