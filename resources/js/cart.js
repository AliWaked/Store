
(function($){
    $('.remove-from-cart').on('click',function(e){
    parent = $(this).data('slug'),
        $.ajax({
            url: '/cart/shopping/delete-products/' + parent,
            method: 'delete',
            data : {
                size : $(this).data('size'),
                color: $(this).data('color'),
                // product: parent,
                _token : csrf_token,
            },
            success: function(response) {
                $(`#${parent}`).remove();
                $('#subtotal').empty();
                $('#subtotal').append(
                    '$' + response
                );
                $('#total').empty();
                $('#total').append(
                    '$' + (5 + +response) 
                );
                if(response == 0) {
                    $('#checkout').remove();
                }
                console.log(response);
            }
        });
    })
    // console.log($('.remove-from-cart'));
})(jQuery)