$(() => {

        $("#search-input").on('input', (event) => {
            const searchString = event.target.value;
            if (searchString.length > 3) {
                $("#loading-spinner").css("visibility", "visible");
                searchRecipe(searchString);
            } else {
                $('#search-result-section').empty();
            }

        })
    }
);


function searchRecipe(searchString) {
    const normalizedString = searchString.replace(/ /g, "_");

    // get filters
    var a = $('#rating-filter').selectpicker();

    searchRecipeRequest("/recipe/search/" + normalizedString).then(
        (data) => {
            $("#search-result-section").empty();
            $("#search-result-section").append(data);
            $("#loading-spinner").css("visibility", "hidden");
        }
    )
}

function searchRecipeRequest(path) {
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