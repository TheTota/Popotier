$(() => {
    enableOrDisableSubmit()
});

const commentTextArea = $('textarea#commentTextArea');
const submit = $('#submitComment');

commentTextArea.on('input', enableOrDisableSubmit);

function enableOrDisableSubmit() {
    if (commentTextArea.val() === '') {
        submit.prop('disabled', true);
    } else {
        submit.prop('disabled', false);
    }
}

function commentRecipe(idRecipe) {
    var comment = commentTextArea.val();
    commentRecipeRequest(idRecipe, comment).then(
        () => {
        }
    )
}

function commentRecipeRequest (id, value) {
    return new Promise((resolve, reject) => {
        var path = '/recipe/comment/' + id + '/' + value;
        alert(path);
        $.get(path, (data, success) => {
            if (success) {
              /*  if (data !== "") {
                    window.location.href = "/login";
                }
                else {
                    //$("#user-rating").load(location.href + " #user-rating>*","");
                    // TODO: refresh comments
                }*/
                resolve();
            } else {
                reject();
            }
        })
    })
}