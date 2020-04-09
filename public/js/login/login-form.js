// JS that handle the behaviour of the login form

$(() => {

    const email = $('#inputEmail');
    const password = $('#inputPassword');
    const submit = $('#submit');

    enableOrDisableSubmit();

    email.on('input', enableOrDisableSubmit);
    password.on('input', enableOrDisableSubmit);

    function enableOrDisableSubmit() {
        const emailRegex = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;

        if(email.val() == '' || password.val() == '' || email.val().match(emailRegex) == null ){
            submit.prop('disabled', true);
        }else{
            submit.prop('disabled', false);
        }
    }
});


