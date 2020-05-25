$(() => {

    const ingredientRow = $('.ingredient-row-element');
    $('.delete-ingredient-button').hide();

    // When adding a step we clone the step-row-element we hide the first delete button and we add the onClick event to the new cloned element
    $('#add-ingredient-button').on('click', () => {
        ingredientRow.clone().appendTo('#ingredients');
        $('.delete-ingredient-button').show();
        $('.ingredient-row-element:first-child button').hide();
        $('.delete-ingredient-button').on('click', (event) => {
            $(event.target).closest('li').remove();
        });
    });
})