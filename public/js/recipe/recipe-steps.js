$(() => {

    const stepRow = $('.step-row-element');
    $('.delete-step-button').hide();

    // When adding a step we clone the step-row-element we hide the first delete button and we add the onClick event to the new cloned element
    $('#add-step-button').on('click', () => {
        stepRow.clone().appendTo('#steps');
        $('.delete-step-button').show();
        $('.step-row-element:first-child button').hide();
        $('.delete-step-button').on('click', (event) => {
            $(event.target).closest('li').remove();
        });
    });

})