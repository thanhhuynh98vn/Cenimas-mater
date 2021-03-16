$(document).on('click','.items',function () {
    if ($(this).hasClass('active-film')) {
        $(this).removeClass('active-film');
    }else {
        $(this).addClass('active-film');
    }
});
$(document).on('click','#submit',function () {
    var token=$("input[name='_token']").val();
    var list = [];

    $('.active-film').each(function(){
        var term = $(this).data('id');
        list.push(term);
    });
    $.ajax({
        url: '/getIdVote',
        type: 'POST',
        dataType: 'json',
        data: {"_token":token,id: list},
})
.done(function(data) {
        console.log(data);
    })
});

$(document).ready(function () {
    var token=$("input[name='_token']").val();

    var id = $('#id-user').data('id');
    $.ajax({
        url: '/checkVote',
        type: 'POST',
        dataType: 'json',
        data: {"_token":token,id: id},
})
.done(function(data) {
        if (data.length > 0) {
            data.forEach( function(element, valua) {
                $('.items').each(function(){
                    var te= $(this).data('id');
                    if ((te == element)){
                        $(this).addClass('active-film');
                    }
                });
            });
        }
    })
});