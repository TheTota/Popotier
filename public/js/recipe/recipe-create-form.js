$(function () {
    // Properties 
    var nameError = true;

    const onlyLettersRegex = /[A-Za-z]+$/;


    // TO DO : ingredientsError - stepsError in array 

    // Elements selection
    const name = $('#inputName');
    const image = $('#inputImage');
    const personNumber = $('#inputPersonNumber');
    const cookingTime = $('#inputCookingTime');
    const preparationTime = $('#inputPreparationTime');
    const difficultyTime = $('inputDifficulty');
    const meanPrice = $('#inputMeanPrice');
    const authorQuote = $('#inputAuthoQuote');
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
        }
        console.log(inputName);
    })

});