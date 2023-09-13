(function($){
    $('#send-review').on('click',function(e){
        $.ajax({
            url: '/shopping/add-review/' + product_slug,
            method: 'post',
            data: {
                comment: $('[name="comment"]').val(),
                stars: $('[name="stars"]').val(),
                _token: csrf_token,
            },
            success: function(response) {
                console.log(response);
            }
        })
    })
    $('#send-review').on('click',function(e){
        $.ajax({
            url: '/shopping/add-review/' + product_slug,
            method: 'post',
            data: {
                comment: $('[name="comment"]').val(),
                stars: $('[name="stars"]').val(),
                _token: csrf_token,
            },
            success: function(response) {
                response.forEach(array => {
                    $('#reviews').empty();
                    
                    $('#reviews').append(`
                    <div class="name font-bold">${array[0]}</div>
                    <div class=" text-base text-yellow-400 cursor-default mt-2 mb-2">
                        ${stars(array[1])}
                    </div>
                    <div class="date text-gray-500 mt-3">
                         ${array[3]}</div>
                    <div class="content bg-cyan-200 p-2 rounded-md mt-3">
                        ${array[2]}
                    </div>
                    `)
                });
                $('#send-review').addClass('hidden')
            }
        })
    })
})(jQuery)
function stars (number) {
let star = '';
    for (let i = 0; i < 5; i++){
        if (i < number)
        star = star + ' <i class="fa-solid fa-star "></i> '
        else
        star = star + ' <i class="fa-regular fa-star text-gray-400"></i> '
    }
    return star;
}