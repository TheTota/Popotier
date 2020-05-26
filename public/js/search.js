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
    handleRatingFilter();

    searchRecipeRequest("/recipe/search", normalizedString).then(
        (data) => {
            $("#search-result-section").empty();
            $("#search-result-section").append(data);
            $("#loading-spinner").css("visibility", "hidden");
        }
    )
}

function searchRecipeRequest(path, name) {
    return new Promise((resolve, reject) => {
        $.post( path, { name: name })
            .done(function( data ) {
                if (data !== "") {
                    resolve(data);
                } 
            })
    })
}

function handleRatingFilter() {
    var val = $('#rating-filter option:selected').text();

    switch (val) {
        case "Tout":
            break;
        case ">4":
            break;
        case ">3":
            break;
        case ">2":
            break;
        case ">1":
            break;
    }
}