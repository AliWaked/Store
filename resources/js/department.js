// (function($) {
//     $('.category-select').on('change',function(e){
//         $.ajax({
//         url: "/products/"+$('.category-select').val() ,
//         method:'get',
//         data: {
//             _token: csrf_token
//         },
//         success: function(response) {
//         $('.department-checkbox').empty()
//         // response.forEach(element => {
//         console.log(response);
//         for(let i = 0; i< response.length; i++ ){
//             $('.department-checkbox').append(`
//                 <div class="flex items-center mr-6 cursor-pointer department-checkbox">
//                     <input type="checkbox" name="department[]" id="${response[i]}" value="${response[i]}" 
//                     class=" border-gray-400 cursor-pointer" @checked(in_array($value,$departments))>
//                     <label for="${response[i]}"
//                     class=" inline-block text-gray-400 ml-2 uppercase cursor-pointer">${response[i]}</label>
//                 </div>
//             `);
//         }
//         }
//     });
// })
// })(jQuery);
