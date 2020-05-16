function handleLikeButtonClick(idRecipe) {
    // (Try to) like the recipe
    likeRecipeRequest(idRecipe).then(
        () => {
            //window.location.reload();
        }
    )
}

function likeRecipeRequest (idRecipe) {
    return new Promise((resolve, reject) => {
        $.get('/recipe/like/'+idRecipe, (data, success) => {
            if(success){
                if (data !== "") {
                    window.location.href = "/login";
                } else {
                    toggleLikeIcon();
                }
                //console.log(data);
                resolve();
            } else {
                reject();
            }
        })
    })
}

function toggleLikeIcon() {
    // Color btn
    var icon = $("#like-btn i");
    icon.toggleClass("far");
    icon.toggleClass("fas");
}