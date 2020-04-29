$(() => {

    $('#sidenavCollapse').on('click', () => {
        $('#sidenav').toggleClass('active');
        $('#admin-content').toggleClass('active')
    });



});

function setActive(element){
    $('a').removeClass('active');
    element.classList.add('active');
}