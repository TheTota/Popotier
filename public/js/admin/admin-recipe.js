function checkRecipe(id) {
    getRecipe(id).then(
        (data) => {
            console.log(data);
            $(data).appendTo('#modal').modal({
                fadeDuration: 150
            });
        }
    );
}

function getRecipe(id) {
    return new Promise((resolve, reject) =>{
        $.get('/recipe/view/'+id, (data, success) => {
            if(success){
                resolve(data);
            }else{
                reject();
            }
        })
    })
}