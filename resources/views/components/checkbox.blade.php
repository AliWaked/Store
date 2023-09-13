@props(['values', 'departments' => [], 'name' => 'department[]'])
<div class="flex items-center department-checkbox">
    @foreach ($values as $value)
        <div class="flex items-center mr-6 cursor-pointer">
            <input type="checkbox" name="{{ $name }}" id="{{ $value }}" value="{{ $value }}"
                class=" border-gray-400 cursor-pointer" @checked(in_array($value, $departments))>
            <label for="{{ $value }}"
                class=" inline-block text-gray-400 ml-2 uppercase cursor-pointer">{{ $value }}</label>
        </div>
    @endforeach
</div>
