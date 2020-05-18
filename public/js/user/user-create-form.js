$(function () {
    // Properties
    let lastNameError = true;
    let firstNameError = true;
    let emailError = true;
    let emailExistError = true;
    let passwordError = true;
    let aliasError = true;

    const onlyLettersRegex = /[A-Za-z]+$/;

    // Elements selection
    const lastName = $('#inputLastName');
    const firstName = $('#inputFirstName');
    const email = $('#inputEmail');
    const password = $('#inputPassword');
    const alias = $('#inputAlias');
    const submitButton = $('#submit');

    $('#lastNameError').hide();
    $('#firstNameError').hide();
    $('#emailExistError').hide();
    $('#emailError').hide();
    $('#aliasError').hide();
    $('#passwordError').hide();


    // Events
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

    email.on('input', () => {
        const emailRegex = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;
        const emailValue = email.val();

        if(emailValue == ''){
            emailError = true;
        } else {

            if(emailValue.match(emailRegex) != null) {
                checkEmail().then(
                    () => {
                        handleSubmitButton();
                    }
                )
            } else {
                emailError = true;
            }
        }
    });

    email.on('change', () => {

        if(emailError && email.val() != ""){
            $('#emailError').show();
        } else {
            $('#emailError').hide();
        }

        if(emailExistError){
            $('#emailExistError').show();
        } else {
            $('#emailExistError').hide();
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

    password.on('input', () => {
        const passwordValue = password.val();
        const passwordRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/

        if (passwordValue.match(passwordRegex) != null) {
            passwordError = false;
        } else {
            passwordError = true;
        }
    });

    password.on('change', () => {

        if (passwordError) {
            $('#passwordError').show();
        } else {
            $('#passwordError').hide();
        }
    });

    $("form :input").on('change', () => {
        handleSubmitButton();
    });

    // Functions
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
                    emailError = false;
                    if(!data){
                        emailExistError = true;
                    } else {
                        emailExistError = false;
                    }
                    resolve();
                } else {
                    reject();
                }
            })
        })
    }

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