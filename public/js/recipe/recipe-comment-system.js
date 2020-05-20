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
    // clear input
    commentTextArea.val('');
    enableOrDisableSubmit();

    commentRecipeRequest(idRecipe, comment).then(
        () => {
        }
    )
}

function commentRecipeRequest (id, value) {
    return new Promise((resolve, reject) => {
        var path = '/recipe/comment/' + id + '/' + value;
        $.get(path, (data, success) => {
            if (success) {
              /*  if (data !== "") {
                    window.location.href = "/login";
                    // TODO: enable comments only if connected
                }
                else {
                    //$("#user-rating").load(location.href + " #user-rating>*","");
                    // TODO: refresh comments
                }*/
                $("#recipeComments").load(location.href + " #recipeComments>*","");
                resolve();
            } else {
                reject();
            }
        })
    })
}