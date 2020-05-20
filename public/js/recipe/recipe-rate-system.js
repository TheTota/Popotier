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
                    $("#user-rating").load(location.href + " #user-rating>*","");
                    $("#global-rating").load(location.href+" #global-rating>*","");
                }
                resolve(data);
            } else {
                reject();
            }
        })
    })
}