(function($) {
    $('.address-information').on('click',function(e){
        $.ajax({
            url: '',
            method: 'post',
            data: {
                countiry:$('[name="country"]').val(),
                city: $('[name="city"]').val(),
                street: $('[name="street"]').val(),
                phone_number: $('[name="phone"]').val(),
                postal_code: $('[name="postal_code"]').val(),
                _token: csrf_token,
            },
            success: function(response) {
                console.log( response);
                if(response == 'success') {
                    $('#payment').removeClass('hidden');
                    $('#shopping').addClass('hidden');
                    $('#numberOne').html('<i class="fa-solid fa-check"></i>');
                    $('#number-2').addClass('bg-red-500');
                }
            }
        })
    })
})(jQuery)
// onclick="document.getElementById('payment').classList.remove('hidden');document.getElementById('shopping').style.display='none'; document.getElementById('numberOne').innerHTML ='<i class=\'fa-solid fa-check\'></i>';document.getElementById('number-2').classList.add('bg-red-500')