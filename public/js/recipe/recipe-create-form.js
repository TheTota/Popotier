$(function () {
    // Properties 
    var nameError = true;
    var stepsError = true;
    const onlyLettersRegex = /[A-Za-z]+$/;

    var nbSteps = 1;

    // TO DO : ingredientsError 

    // Elements selection
    const name = $('#inputName');
    const submitButton = $('#submit');

    // Events

    name.on('input', () => {
        const inputName = name.val();

        if (inputName != '' || inputName.match(onlyLettersRegex) != null) {
            $('#nameError').hide();
            nameError = false;
        } else {
            $('#nameError').show();
            nameError = true;
        }
        console.log('error :' + nameError);
    })


    function handleSubmitButton() {
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

    function addStep() {
        console.log("Ajouter �tape");
        nbSteps = nbSteps + 1;
        var ul = document.getElementById("steps");
        var li = document.createElement("li");
        li.appendChild(document.createTextNode("test"));
        li.setAttribute("id", nbSteps); // added line
        ul.appendChild(li);
    }

});