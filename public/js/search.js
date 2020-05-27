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

        $( "select" ).change(function() {
            var searchString = $('#search-input').val();
            searchRecipe(searchString)
        });

    }
);


function searchRecipe(searchString) {
    const normalizedString = searchString.replace(/ /g, "_");

    // get filters
    var ratingFiler = getRatingFilter();

    searchRecipeRequest("/recipe/search", normalizedString, ratingFiler).then(
        (data) => {
            $("#search-result-section").empty();
            $("#search-result-section").append(data);
            $("#loading-spinner").css("visibility", "hidden");
        }
    )
}

function searchRecipeRequest(path, name, ratingFilter) {
    return new Promise((resolve, reject) => {
        $.post( path, { name: name, ratingFilter: ratingFilter })
            .done(function( data ) {
                if (data !== "") {
                    resolve(data);
                }
            })
    })
}

function getRatingFilter() {
    var val = $('#rating-filter option:selected').text();

    switch (val) {
        case "Tout":
            return 0;
            break;
        case ">4":
            return 4;
            break;
        case ">3":
            return 3;
            break;
        case ">2":
            return 2;
            break;
        case ">1":
            return 1;
            break;
    }

    return 0;
}