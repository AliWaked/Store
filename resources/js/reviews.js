import './bootstrap';
import Echo from 'laravel-echo';
(function($){
    var product_id;
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
                    // $('#reviews').empty();
                    // product_id = response.data.;
                    $('#reviews').prepend(`
                    <div class="name font-bold mt-4 mb-1">${response.data.user_name}</div>
                    <div class=" text-base text-yellow-400 cursor-default mt-2 mb-2">
                        ${stars(response.data.reviews)}
                    </div>
                    <div class="date text-gray-500 mt-3">
                         ${response.data.updated_at}</div>
                    <div class="content bg-cyan-200 p-2 rounded-md mt-3">
                        ${response.data.comment}
                    </div>
                    `);
                    // $('#comment-add').html('');
                    $('#send-review').remove();
            }
        })
    });
    // Echo.join(`user.comment.product.${product_id}`)
    // .listen('user-add-new-comment',function (event) {
    //     $('#reviews').append(`
    //     <div class="name font-bold">${event.user_name}</div>
    //     <div class=" text-base text-yellow-400 cursor-default mt-2 mb-2">
    //         ${stars(event.rating)}
    //     </div>
    //     <div class="date text-gray-500 mt-3">
    //          ${event.send_at}</div>
    //     <div class="content bg-cyan-200 p-2 rounded-md mt-3">
    //         ${event.content}
    //     </div>
    //     `);
    // });
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
})(jQuery)
