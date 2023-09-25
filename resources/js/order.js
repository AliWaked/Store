(function($){
    $('#delivered').on('click',function(e){
        $.ajax({
            url: '/dashboard/orders/'+ $(this).data('order'),
            method: 'put',
            data: {
                _token: csrf_token,
            },
            success: function(response) {
                // this.removeClass('bg-gray-900');
                // this.addClass('bg-green-500');
                // this.text = 'delivered';
            //     $(this).removeClass('bg-slate-800');
            //     $(this).addClass('bg-green-500');
            //     $(this).text('delivered');
            //     console.log(response);
            window.location.href = response.url;
            // console.log(response.bool);
            },
        })
    })
})(jQuery)