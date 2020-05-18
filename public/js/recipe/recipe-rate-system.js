function rateRecipe(idRecipe, rating) {
    // (Try to) like the recipe
    rateRecipeRequest(idRecipe, rating).then(
        () => {
        }
    )
}

function rateRecipeRequest (id, value) {
    return new Promise((resolve, reject) => {
        $.get('/recipe/rate/' + id + '/' + value, (data, success) => {
            if (success) {
                resolve(data);
            } else {
                reject();
            }
        })
    })
}