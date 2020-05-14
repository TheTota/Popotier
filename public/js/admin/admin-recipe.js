$( () => {
    var str = window.location.href.split('/');
    var last = str[str.length-1];
    if (last === "recipes-to-validate") {
        $('#recipesToValidate').addClass('active');
    } else {
        $('#validatedRecipes').addClass('active');
    }

    $('#recipeCollapse').addClass('show');
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
            window.location.replace("/admin/view/recipes-to-validate");
        }
    )
}

function validateRecipeRequest (idRecipe) {
    return new Promise((resolve, reject) => {
        $.get('/recipe/validate/'+idRecipe, (data, success) => {
            if(success){
                console.log(data);
                resolve()
            } else {
                reject();
            }
        })
    })
}

function devalidateRecipe(idRecipe) {
    devalidateRecipeRequest(idRecipe).then(
        () => {
            window.location.replace("/admin/view/validated-recipes");
        }
    )
}

function devalidateRecipeRequest (idRecipe) {
    return new Promise((resolve, reject) => {
        $.get('/recipe/devalidate/'+idRecipe, (data, success) => {
            if(success){
                console.log(data);
                resolve()
            } else {
                reject();
            }
        })
    })
}