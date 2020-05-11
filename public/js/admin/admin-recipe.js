$( () => {
    $('#recipe').addClass('active');
})

function getRecipeSummary(id) {
    getRecipeSummaryRequest(id).then(
        (data) => {
            $(data).appendTo('#modal').modal({
                fadeDuration: 150
            });
        }
    );
}

function getRecipeSummaryRequest(id) {
    return new Promise((resolve, reject) => {
        $.get('/recipe/summary/'+id, (data, success) => {
            if(success){
                resolve(data);
            }else{
                reject();
            }
        })
    })
}

function validateRecipe(idRecipe) {
    validateRecipeRequest(idRecipe).then(
        () => {
            window.location.replace("/admin/view/recipes");
        }
    )
}

function validateRecipeRequest (idRecipe) {
    return new Promise((resolve, reject) => {
        $.get('/recipe/validate/'+idRecipe, (data, success) => {
            if(success){
                resolve()
            } else {
                reject();
            }
        })
    })
}