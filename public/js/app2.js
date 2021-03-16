$('document').ready(function () {
    function regexstr(str) {

        str = str.toLowerCase().trim();

        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");

        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ.+/g,"e");

        str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");

        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ.+/g,"o");

        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");

        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");

        str = str.replace(/đ/g,"d");

        str = str.replace(/ /g, "-");

        str = str.replace(/\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\_|\+|\=|\[|\{|\]|\}|\\|\||\;|\:|\'|\"|\,|\<|\.|\>|\/|\?/g, "-");

        return str;

    }
    $("#title").keyup(function(){
        var Text = $(this).val();
        Text =  regexstr(Text)+'.html';
        $("#slug").val(Text);
    });
// load Vote value

    $(document).on('click', '.loadValue tr td a', function(event) {
        var idRead = $(this).attr('id');
        var token=$("input[name='_token']").val();
        if(idRead > 0){
            $.ajax({
                url: '/votes/load',
                type: 'POST',
                dataType: 'json',
                data: {"_token":token,idRead: idRead},
            })
                .done(function(data) {
                    if (data.status) {
                        console.log(data.html);
                        $("#ajax").html(data.html);
                    }
                })
        }
    });


});

