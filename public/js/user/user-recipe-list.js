$(() => {
    let page = 1;
    let path = '/user/get/recipe/';

    $("#user-recipe-button")
        .on('click', () => {
        getUserRecipePagesNumber().then(
            (pages) => {
                $('#page-numbers').empty();
                for (i = 1; i <= pages; i++) {
                    $("#page-numbers").append("<button class='pagination-button btn btn-flat-primary'>" + i + "</button>")
                    getRecipesPerPage(path, 1);
                    hideChevron(page);

                    $(".pagination-button").on('click', (event) => {
                        page = event.target.innerText;
                        changePage(path, page);
                    });
                }
            }
        )
    })
        .trigger('click');


    $("#user-liked-recipe-button").on('click', () => {
        getUserLikedRecipePagesNumber().then(
            (pages) => {
                $('#page-numbers').empty();
                for (i = 1; i <= pages; i++) {
                    $("#page-numbers").append("<button class='pagination-button btn btn-flat-primary'>" + i + "</button>")
                    getRecipesPerPage(path, 1);
                    hideChevron(page);

                    $(".pagination-button").on('click', (event) => {
                        page = event.target.innerText;
                        changePage(path, page);
                    });
                }
            }
        )
    });

    $("#user-liked-recipe-button").on('click', () => {
        path = '/user/get/like/';
        getRecipesPerPage(path, 1);
    });

    $("#user-recipe-button").on('click', () => {
        path = '/user/get/recipe/';
        getRecipesPerPage(path, 1);
    });

    $("#pagination-left-chevron").on('click', () => {
        page--;
        changePage(path, page)
    });

    $("#pagination-right-chevron").on('click', () => {
        page++;
        changePage(path, page)
    });
})
;

function changePage(path, page) {
    hideChevron(page);
    getRecipesPerPage(path, page);
    $(".pagination-button").each((index, button) => {
        $(button).removeClass('active');
        if (button.innerText == page) {
            $(button).addClass('active');
        }
    });
}

function hideChevron(page) {
    if (page == 1) {
        $("#pagination-left-chevron").hide();
    } else {
        $("#pagination-left-chevron").show();
    }

    if (page == $(".pagination-button").last().text()) {
        $("#pagination-right-chevron").hide();
    } else {
        $("#pagination-right-chevron").show();
    }

}

function getRecipesPerPage(path, page) {
    getRecipesPerPageRequest(path + page).then(
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

function getUserRecipePagesNumber() {
    return new Promise((resolve, reject) => {
        $.get("/user/get/recipe/page_count", (data, success) => {
            if (success) {
                resolve(data);
            } else {
                reject();
            }
        })
    })
}

function getUserLikedRecipePagesNumber() {
    return new Promise((resolve, reject) => {
        $.get("/user/get/liked_recipe/page_count", (data, success) => {
            if (success) {
                resolve(data);
            } else {
                reject();
            }
        })
    })
}