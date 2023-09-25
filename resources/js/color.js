var categoryId = 0 ;
var sizes = [];
(function($) {
    $('.category-select22').on('change',function(e){
     categoryId = $(this).val();
        $.ajax({
        url: "/shopping/" + $(this).data('department') ,
        method:'get',
        data: {
            category: categoryId,
        },
        success: function(reponse) {
        console.log(reponse);
            $('#colors22').empty();
            $('#colors22').append('<option value="">All</option>');
            $('#sizes22').empty();
            $('#sizes22').append('<option value="">All</option>');
          reponse.forEach(size => {
          console.log(size);
            $('#sizes22').append(
                `<option value="${size}">${size}</option>`
            )
          });
        }
    });
})
})(jQuery);

// set color

(function($) {
    $('.select-size22').on('change',function(e){
        $.ajax({
            url: "/shopping/" + $(this).data('department'),
            method: 'get',
            data: {
                category: categoryId,
                size: $(this).val(),
                _token : csrf_token,
            },
            success: function(response){
            console.log(response);
            $('#colors22').empty()
            $('#colors22').append('<option value="">All</option>')
                response.forEach(color => {
                    $('#colors22').append(
                        `<option value="${color}">${color}</option>`
                    )
                })
            },
        });
    })
})(jQuery)


