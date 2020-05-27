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
    var ratingFilter = getRatingFilter();
    var tagsFilter = getTagsFilter();

    searchRecipeRequest("/recipe/search", normalizedString, ratingFilter, tagsFilter).then(
        (data) => {
            $("#search-result-section").empty();
            $("#search-result-section").append(data);
            $("#loading-spinner").css("visibility", "hidden");
        }
    )
}

function searchRecipeRequest(path, name, ratingFilter, tagsFilter) {
    return new Promise((resolve, reject) => {
        $.post( path, { name: name, ratingFilter: ratingFilter, tagsFilter: tagsFilter })
            .done(function( data ) {
                if (data !== "") {
                    resolve(data);
                }
            })
    })
}

function getRatingFilter() {
    return val = $('#rating-filter option:selected').val();
}

function getTagsFilter() {
    return $('#tag-filter').val();
}

