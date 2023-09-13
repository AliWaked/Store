@props(['radioes', 'name', 'value' => 'active'])
@foreach ($radioes as $radio)
    <div class="mb-4 text-gray-600">
        <input type="radio" name="{{ $name }}" id="{{ $radio }}" value="{{ $radio }}"
            @checked($radio == $value)>
        <label for="{{ $radio }}" class="capitalize ml-2 cursor-pointer">{{ $radio }}</label>
    </div>
@endforeach
