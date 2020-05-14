$( () => {
    $('#allergy').addClass('active');

    $('#inputAllergeneName').on('input', () => {
        const $input = $('#inputAllergeneName')

        if($input.val() != ''){
            const $value = $input.val()[0].toUpperCase() + $input.val().substr(1);
            $input.val($value);
            $('#submit').prop('disabled', false);
        }else{
            $('#submit').prop('disabled', true);
        }
    })
});

function updateAllergenValue(element, id) {
    if( confirm('Etes vous sur de vouloir modifier la valeur de l\'allergene?')){
        updateAllergenValueRequest(element.value, id).then(
            (data) => {
                console.log('L\'allergène a été changé en ' + element.value);
            }
        )
    }else{
        location.reload();
    }
}

function updateAllergenValueRequest(value, id) {
    return new Promise((resolve, reject) => {
        $.get('/allergen/update/' + id + '/' + value, (data, success) => {
            if (success) {
                resolve(data);
            } else {
                reject();
            }
        })
    })
}

