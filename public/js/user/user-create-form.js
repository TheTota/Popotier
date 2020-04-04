$(function () {
    //Properties
    var lastNameError = true;
    var firstNameError = true;
    var emailError = true;
    var passwordError = true;
    var aliasError = true;

    const onlyLettersRegex = /[A-Za-z]+$/;

    // Elements
    const lastName = $('#inputLastName');
    const firstName = $('#inputFirstName');
    const email = $('#inputEmail');
    const password = $('#inputPassword');
    const alias = $('#inputAlias');
    const submitButton = $('#submit');


    lastName.on('input', function () {
        const lastNameValue = lastName.val();

        if (lastNameValue.match(onlyLettersRegex) != null || lastNameValue == '') {
            $('#lastNameError').hide();
            lastNameError = false;
        } else {
            $('#lastNameError').show();
            lastNameError = true;
        }
    });

    firstName.on('input', function () {
        const firstNameValue = firstName.val();

        if (firstNameValue.match(onlyLettersRegex) != null || firstNameValue == '') {
            $('#firstNameError').hide();
            firstNameError = false;
        } else {
            $('#firstNameError').show();
            lastNameError = true;
        }
    });

    email.on('change', function () {
        const emailRegex = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;
        const emailValue = email.val();

        $('#emailExistError').hide();
        $('#emailError').hide();

        if (emailValue.match(emailRegex) != null) {

            $.get('/user/verify/email/' + emailValue, function(data, status) {

                if(status == 'success'){
                    if(!data){
                        emailError = true;
                        $('#emailExistError').show();
                    } else {
                        emailError = false;
                        $('#emailExistError').hide();
                    }
                }
            })
        } else {
            $('#emailError').show();
            emailError = true;
        }

    });

    alias.on('change', function () {
        const aliasValue = alias.val();

        if(aliasValue.length > 0){
            $.get('/user/verify/alias/' + aliasValue, function (data, status) {
                if (status == 'success') {
                    if (!data) {
                        aliasError = true;
                        $('#aliasError').show();
                    } else {
                        aliasError = false;
                        $('#aliasError').hide();
                    }
                }
            });
        } else {
            $('#aliasError').hide();
        }
    });

    password.on('change', function () {
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

    $("form :input").on('change', function () {
        handleSubmitButton();
    })

    function handleSubmitButton() {
        if (formHasErrors()) {
            submitButton.prop('disabled', true);
        } else {
            submitButton.prop('disabled', false);
        }
    }

    function formHasErrors() {
        return (
            lastNameError
            || firstNameError
            || emailError
            || aliasError
            || passwordError
        )
    }

});