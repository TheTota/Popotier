$(() => {
    let page = 1;
    getRecipesPerPage(1);
    hideChevron(page);

    console.log($(".pagination-button").last().text());

   $(".pagination-button").on('click', (event) => {
       page = event.target.innerText;
       changePage(page);
   });

   $("#pagination-left-chevron").on('click', () => {
       page--;
       changePage(page)
   })

    $("#pagination-right-chevron").on('click', () => {
        page++;
        changePage(page)

    })
});

function changePage(page){
    hideChevron(page)
    getRecipesPerPage(page);
    $(".pagination-button").each( (index, button) => {
        $(button).removeClass('active');
        if(button.innerText == page){
            $(button).addClass('active');
        }
    });
}

function hideChevron(page){
    if(page == 1){
        $("#pagination-left-chevron").hide();
    } else {
        $("#pagination-left-chevron").show();
    }

    if(page == $(".pagination-button").last().text()){
        $("#pagination-right-chevron").hide();
    } else {
        $("#pagination-right-chevron").show();
    }

}

function getRecipesPerPage(page) {
    getRecipesPerPageRequest('/recipe/get/' + page).then(
        (data) => {
            $("#recipe-list").empty();
            $("#recipe-list").append(data);
        }
    )
}

function getRecipesPerPageRequest(path) {
    return new Promise((resolve, reject) => {
        $.get(path, (data, success) => {
            if (success) {
                resolve(data);
            } else {
                reject();
            }
        })
    })
}