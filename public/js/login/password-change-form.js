// JS that handle the behaviour of the password recovery form

$(() => {

    const password = $('#inputPassword');
    const passwordConfirm = $('#inputPasswordConfirmation');

    var passwordError = true;
    var passwordConfirmError = true;

    const submit = $('#submit');

    if (password.length > 0) {
        handleSubmitButton();

        // check new password
        password.on('change', () => {
            const passwordValue = password.val();
            const passwordRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/

            if (passwordValue.match(passwordRegex) != null) {
                $('#passwordError').hide();
                passwordError = false;
            } else {
                $('#passwordError').show();
                passwordError = true;
            }
        });

        // check if confirm is same as password
        passwordConfirm.on('input', () => {
            if (password.val() === passwordConfirm.val()) {
                $('#passwordConfirmError').hide();
                passwordConfirmError = false;
            } else {
                $('#passwordConfirmError').show();
                passwordConfirmError = true;
            }
        })

        // check if errors to enable or disable the submit btn
        $("form :input").on('change', () => {
            handleSubmitButton();
        });
    }

    function handleSubmitButton() {
        if (passwordError || passwordConfirmError) { // if we have an error, disable
            submit.prop('disabled', true);
        } else {
            submit.prop('disabled', false);
        }
    }
});


