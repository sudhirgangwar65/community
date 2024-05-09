jQuery(document).ready(function () {

    let $ = jQuery;




    $('.nv-new-menu-icon img').click(function () {
        $('.desk-sidebar').addClass('.desk-sidebar-add');
        $('body').addClass('body-over');
    })

    $('.desk-sidebar .cross img').click(function () {
        $('.desk-sidebar').removeClass('.desk-sidebar-add');
        $('body').removeClass('body-over');
    })


    $('.side-menus > ul li a i').click(function () {
        $(this).parents('li').siblings('li').removeClass('open-dropdown');
        $(this).parents('li').toggleClass('open-dropdown');

    })


});