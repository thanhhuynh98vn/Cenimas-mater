$( document ).ready( function () {

    $( "#FormType" ).validate( {
        ignore: [],
        debug: false,
        rules: {
            name: {
                required: true,

            },
        },
        messages: {
            name: {
                required: "Vui lòng nhập vào đây!",

            },

        },
    });
});