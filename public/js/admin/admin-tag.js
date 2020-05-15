$(() => {
    $('#tag').addClass('active');
})

$('#inputTagName').on('input', () => {
    const $input = $('#inputTagName')

    if ($input.val() != '') {
        const $value = $input.val()[0].toUpperCase() + $input.val().substr(1);
        $input.val($value);
        $('#submit').prop('disabled', false);
    } else {
        $('#submit').prop('disabled', true);
    }
});

function updateTagValue(element, id) {
    if( confirm('Etes-vous sûr de vouloir modifier la valeur du tag ?')){
        updateTagValueRequest(element.value, id).then(
            (data) => {
                console.log('Le tag a été changé en ' + element.value);
            }
        )
    }else{
        location.reload();
    }



}

function updateTagValueRequest(value, id) {
    return new Promise((resolve, reject) => {
        $.get('/tag/update/' + id + '/' + value, (data, success) => {
            if (success) {
                resolve(data);
            } else {
                reject();
            }
        })
    })
}