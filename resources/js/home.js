import './bootstrap';

    Echo.join(`new.product`)
    .listen('.new.product',function (event) {
    // alert('hello');
    document.getElementById('new-product-add').innerHTML+=`
    <div>
        <img src="${event.image}" alt="product image" class="h-[200px]">
        <div class="content text-center">
        <div class="name mt-2 text-gray-700 ">${event.product_name }</div>
        <div class="price mt-1 text-red-500 font-bold text-lg">${ event.price }</div>
        <form action="${event.url}">
        <button type="submit"
        class="text-red-500 box-border w-full h-12 uppercase text-lg font-semibold border-2 border-red-400 mt-4 rounded-md hover:text-white hover:bg-red-500 hover:border-red-500 transition">view</button>
        </form>
        </div>
    </div>
    `;
});