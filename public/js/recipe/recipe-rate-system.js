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
                if (data !== "") {
                    window.location.href = "/login";
                }
                else {
                    window.location.reload();
                }
                resolve(data);
            } else {
                reject();
            }
        })
    })
}