function deleteRecipe(idRecipe) {
    if( confirm('Etes-vous sûr de vouloir supprimer cette recette ?')){
        deleteRecipeRequest("/recipe/delete/" + idRecipe).then(
            () => {
                window.location.reload();
            }
        )
    }
}

function deleteRecipeRequest (path) {
    return new Promise((resolve, reject) => {
        $.get(path, (data, success) => {
            if(success){
                //console.log(data);
                resolve();
            } else {
                reject();
            }
        })
    })
}