// JS that handle the behaviour of the password recovery form

$(() => {

    const email = $('#inputEmail');
    const submit = $('#submit');

    enableOrDisableSubmit();

    email.on('input', enableOrDisableSubmit);

    function enableOrDisableSubmit() {
        const emailRegex = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;

        if(email.val() == '' || email.val().match(emailRegex) == null ){
            submit.prop('disabled', true);
        }else{
            submit.prop('disabled', false);
        }
    }
});


