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

    commentRecipeRequest(idRecipe, comment);
}

function commentRecipeRequest (id, value) {
        var path = '/recipe/comment';
        $.post( path, { id: id, value:value })
            .done(function( data ) {
                if (data !== "") {
                    window.location.href = "/login";
                } else {
                    $("#recipeComments").load(location.href + " #recipeComments>*", "");
                }
            });
}