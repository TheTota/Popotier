function handleLikeButtonClick(idRecipe, isPartOfList) {
    // (Try to) like the recipe
    likeRecipeRequest(idRecipe, isPartOfList).then(
        () => {
        }
    )
}

function likeRecipeRequest (idRecipe, isPartOfList) {
    return new Promise((resolve, reject) => {
        $.get('/recipe/like/'+idRecipe, (data, success) => {
            if(success){
                if (data !== "") {
                    window.location.href = "/login";
                }
                else {
                    if (isPartOfList) {
                        window.location.reload();
                    } else {
                        toggleLikeIcon();
                    }
                }
                resolve();
            } else {
                reject();
            }
        })
    })
}

function toggleLikeIcon() {
    // Color btn
    var icon = $(".like-btn i");
    icon.toggleClass("far");
    icon.toggleClass("fas");
}