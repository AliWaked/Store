@props(['categories', 'name', 'value' => '', 'main' => true, 'title' => 'Main Category', 'department'])
<select name="{{ $name }}" id=""
    class="w-full text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize category-select"
    data-department="{{ $department->id ?? '0' }}">
    @if ($main)
        <option value="">{{ $title }}</option>
    @endif
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" @selected($category->id == $value) data-id="{{ $category->id }}">
            {{ $category->name }}</option>
    @endforeach
</select>
