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
            method: 'delete',
            data: {
                _token: csrf_token,
            }
        })
    })
    let elements = $('.remove-from-favourite');
    for(let i = 0; i<elements.length; i++) {
        elements[i].onclick = function(){
            $.ajax({
                url: '/shopping/remove-favourite/' + $(this).data('slug'),
                method: 'delete',
                data: {
                    _token: csrf_token,
                },
                success: (response)=> $(`#${$(this).data('slug')}`).remove()
                
            })
        }
    }
})(jQuery)