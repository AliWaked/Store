(function($) {
var order = '';
    $('.address-information').on('click',function(e){
        $.ajax({
            url: '',
            method: 'post',
            headers: {
                accept:'application/json',
            },
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
                if(response.message == 'success') {
                    order=response.order;
                    document.getElementById('form-to-pay').action = `/payment/${order.id}`;
                    $('#payment').removeClass('-left-full');
                    $('#payment').addClass('left-[450px]');
                    $('#number-1').removeClass('bg-gray-200');
                    $('#number-1').addClass('bg-red-500');
                    $('#shopping').addClass('hidden');
                    $('#numberOne').html('<i class="fa-solid fa-check"></i>');
                    $('#subtotal').html(`${response.total_price}`);
                    $('#total').html(`${response.total_price + 5}`);
                    $('#number-2').addClass('bg-red-500');
                    window.sessionStorage.setItem('order','success');
                }
            }
        })
    })
    
//     $('#pay-now').on('click',function(e){
//         $.ajax({
//             url: `/payment/${order.id}`,
//             method: 'post',
//             headers: {
//                 accept:'application/json',
//             },
//             data: {
//                 // countiry:$('[name="country"]').val(),
//                 // city: $('[name="city"]').val(),
//                 // street: $('[name="street"]').val(),
//                 // phone_number: $('[name="phone"]').val(),
//                 // postal_code: $('[name="postal_code"]').val(),
//                 _token: csrf_token,
//             },
//             success: function(response) {
//                 console.log( response);
//                 if(response.message == 'success') {
//                     $('#payment').removeClass('left-[450px]');
//                     $('#payment').addClass('-left-full');
//                     $('#num-2').removeClass('bg-gray-200');
//                     $('#num-2').addClass('bg-red-500');
//                     $('#thankyou').removeClass('hidden');
//                     $('#number-2').html('<i class="fa-solid fa-check"></i>');
//                     $('#number-3').addClass('bg-red-500');
//                 }
//             }
//         })
    // })
   
})(jQuery)
// if(window.sessionStorage.getItem('order') == 'success');
// onclick="document.getElementById('payment').classList.remove('hidden');document.getElementById('shopping').style.display='none'; document.getElementById('numberOne').innerHTML ='<i class=\'fa-solid fa-check\'></i>';document.getElementById('number-2').classList.add('bg-red-500')