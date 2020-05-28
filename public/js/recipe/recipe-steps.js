$(() => {

    const stepRow = $('#main-step-element .step-row-element');

    $('.step-row-element:first-child button').hide();
    $('.step-row-element button').on('click', () => {
        $(event.target).closest('li').remove();
    })

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