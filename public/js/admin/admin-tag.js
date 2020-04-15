$( () => {
    $('#tag').addClass('active');
})

$('#inputTagName').on('input', () => {
    const $input = $('#inputTagName')

    if($input.val() != ''){
        const $value = $input.val()[0].toUpperCase() + $input.val().substr(1);
        $input.val($value);
        $('#submit').prop('disabled', false);
    }else{
        $('#submit').prop('disabled', true);
    }
})