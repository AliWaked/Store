(function($){
    $('#favourite').on('click',function(e){
    $.ajax({
        url: '/shopping/add-favourite/' + product_slug,
        method: 'post',
        data: {
            _token: csrf_token,
        },
    })
    })
    $('#favour').on('click',function(e){
        $.ajax({
            url: '/shopping/remove-favourite/' + product_slug,
            method: 'post',
            data: {
                _token: csrf_token,
            }
        })
    })
    $('#remove-from-favourite').on('click',function(){
        $.ajax({
            url: '/shopping/remove-favourite/' + $(this).data('slug'),
            method: 'post',
            data: {
                _token: csrf_token,
            },
            success: (response)=> $(`#${$(this).data('slug')}`).remove()
            
        })
    })
})(jQuery)