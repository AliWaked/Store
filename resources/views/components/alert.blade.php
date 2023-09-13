@props(['alerts'])
@foreach ($alerts as $key => $value)
    @php
        $value = implode(' ', $value);
    @endphp
    @if (session()->has($key))
        <div
            class="py-4 text-center outline-dashed px-2 text-xl font-semibold w-2/3 mx-auto mb-4 rounded-xl capitalize {{ $value }}">
            {{ session($key) }}
        </div>
    @endif
@endforeach
