$(function () {
    // Properties 
    var nameError = true;
    var stepsError = true;
    const onlyLettersRegex = /[A-Za-z]+$/;

    // TO DO : ingredientsError 

    // Elements selection
    const name = $('#inputName');
    const submitButton = $('#submit');

    // Events

    name.on('input', () => {
        const inputName = name.val();

        if (inputName.match(onlyLettersRegex) != null) {
            $('#nameError').hide();
            nameError = false;
        } else {
            $('#nameError').show();
            nameError = true;
            submitButton.prop('disabled', false);

        }
    })


    $("form :input").on('change', () => {
        handleSubmitButton();
    });

    function handleSubmitButton() {
        console.log(formHasErrors());
        if (formHasErrors()) {
            submitButton.prop('disabled', true);
        } else {
            submitButton.prop('disabled', false);
        }
    }

    function formHasErrors() {
        return (
            nameError
        )
    }

});