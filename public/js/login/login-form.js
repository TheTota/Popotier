$(function() {

    const email = $('#inputEmail');
    const password = $('#inputPassword');
    const submit = $('#submit');

    enableOrDisableSubmit();

    email.on('input', enableOrDisableSubmit);
    password.on('input', enableOrDisableSubmit);

    function enableOrDisableSubmit() {

        if(email.val() == '' || password.val() == ''){
            submit.prop('disabled', true);
        }else{
            submit.prop('disabled', false);
        }
    }
});


