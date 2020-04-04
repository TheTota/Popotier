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


    lastName.on('input', () => {
        const lastNameValue = lastName.val();

        if (lastNameValue.match(onlyLettersRegex) != null || lastNameValue == '') {
            $('#lastNameError').hide();
            lastNameError = false;
        } else {
            $('#lastNameError').show();
            lastNameError = true;
        }
    });

    firstName.on('input', () => {
        const firstNameValue = firstName.val();

        if (firstNameValue.match(onlyLettersRegex) != null || firstNameValue == '') {
            $('#firstNameError').hide();
            firstNameError = false;
        } else {
            $('#firstNameError').show();
            lastNameError = true;
        }
    });

    email.on('change', () => {
        const emailRegex = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;
        const emailValue = email.val();

        if(emailValue == ''){
            $('#emailExistError').hide();
            $('#emailError').hide();
        } else {
            if(emailValue.match(emailRegex) != null) {
                checkEmail().then(
                    () => {
                        handleSubmitButton();
                    }
                )
            } else {
                $('#emailError').show();
                emailError = true;
            }
        }
    });

    alias.on('change',  () => {
        const aliasValue = alias.val();

        $('#aliasError').hide();
        aliasError = true;

        if(aliasValue.length > 0){
            checkAlias().then(
                () => {
                    handleSubmitButton();
                }
            )
        }
    });

    function checkAlias() {
        return new Promise((resolve, reject) => {
            $.get('/user/verify/alias/' + alias.val(), function (data, status) {

                if (status == 'success') {
                    if (!data) {
                        aliasError = true;
                        $('#aliasError').show();
                    } else {
                        aliasError = false;
                        $('#aliasError').hide();
                    }
                    resolve();
                } else {
                    reject();
                }
            });
        })
    }

    function checkEmail() {
        return new Promise((resolve, reject) => {
            $.get('/user/verify/email/' + email.val(), function(data, status) {

                if(status == 'success'){
                    if(!data){
                        emailError = true;
                        $('#emailExistError').show();
                    } else {
                        emailError = false;
                        $('#emailExistError').hide();
                    }
                    resolve();
                } else {
                    reject();
                }
            })
        })
    }

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

    $("form :input").on('change', () => {

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