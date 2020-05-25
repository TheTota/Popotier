$(function () {

    $('#nameError').hide();

    // Properties
    let nameError = true;
    let stepsError = true;
    const onlyLettersAndSpaceRegex = /[A-Za-z_ ]$/;

    handleSubmitButton();

    var nbSteps = 1;

    // TO DO : ingredientsError

    // Elements selection
    const name = $('#inputName');
    const submitButton = $('#submit');

    // Events
    name.on('input', () => {
        const inputName = name.val();

        if (inputName != '' && inputName.match(onlyLettersAndSpaceRegex) != null) {
            $('#nameError').hide();
            nameError = false;
        } else if (inputName != '' && inputName.match(onlyLettersAndSpaceRegex) == null) {
            $('#nameError').show();
            nameError = true;
        }

        if(inputName == ''){
            nameError = true;
        }
        console.log('error :' + nameError);
    });

    $("form :input").on('change', () => {
        handleSubmitButton();
    });



    function formHasErrors() {
        return (
            nameError
        )
    }

    function handleSubmitButton() {
        console.log(formHasErrors());
        if (formHasErrors()) {
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
        }
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

