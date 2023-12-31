@props(['departments', 'value' => '','name'])
<select name="{{ $name }}" id=""
    class="w-full text-gray-500 rounded-lg border-gray-300 cursor-pointer capitalize category-select"
    data-department="{{ $department->id ?? '0' }}">
    <option value="">Select Department</option>
    @foreach ($departments as $department)
    {{-- {{dd($department)}} --}}
    {{-- @dd($department->id == $value,'is'); --}}
        <option value="{{ $department->id }}" @selected($department->id == $value)>
            {{ $department['department_name'] }}</option>
    @endforeach
</select>
