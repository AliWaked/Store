<x-dashboard.layout>
    @php
        $product = new App\Models\Product();
        $route = 'dashboard.products.store';
    @endphp
    @include('dashboard.products._form', [$product,$route])
    {{-- <x-color-size :colors="['red', 'blue', 'green', 'yellow', 'black', 'white', 'orange', 'gray']" :sizes="['xl', 'l', 'm', 's']" /> --}}










    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <script>
        var input = document.querySelector('input[id="input-custom-dropdown"]'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                whitelist: ['red', 'blue', 'green', 'yellow', 'black', 'white', 'orange', 'gray'],
                maxTags: 4,
                dropdown: {
                    maxItems: 20, // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0, // <- show suggestions on focus
                    closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
                }
            })
    </script>
</x-dashboard.layout>
