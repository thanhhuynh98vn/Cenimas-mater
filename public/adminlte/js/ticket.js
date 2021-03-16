$(function () {
    $('#example1').DataTable({
    });
});
var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();
$(document).on('keyup','.quantity',function () {
    var token=$("input[name='_token']").val();
    var quantity = $(this).val();
    var id_user = $(this).parent( ".id-user" ).data('id');
    var id_fim = $('.id-film').val();
    delay(function(){
        $.ajax({
            url: '/votes/ajaxTicket',
            type: 'POST',
            dataType: 'json',
            data: {"_token":token,id_user: id_user,quantity:quantity,vote_value_id:id_fim},
    })
    .done(function(data) {
            console.log(data);
        });
    }, 2000 );
});
$(document).ready(function () {
    var sum = 0;
    $("input[class *= 'quantity']").each(function(){
        sum += +$(this).val();
    });
    $(".total").html(sum);
});