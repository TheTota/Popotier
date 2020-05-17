function handleLikeButtonClick(idRecipe, isPartOfList) {
    // (Try to) like the recipe
    likeRecipeRequest(idRecipe, isPartOfList).then(
        () => {
            if (isPartOfList) {
                window.location.reload();
            } else {
                toggleLikeIcon();
            }
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
    var icon = $(".like-btn i");
    icon.toggleClass("far");
    icon.toggleClass("fas");
}