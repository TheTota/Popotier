$(() => {

    $('#sidenavCollapse').on('click', () => {
        $('#sidenav').toggleClass('active');
    });



});

function setActive(element){
    $('a').removeClass('active');
    element.classList.add('active');
}