@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:outline-none rounded-md shadow-sm focus:bg-gray-200',
    // 'class' => 'border-gray-300  focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm focus:bg-gray-200',
]) !!}>
