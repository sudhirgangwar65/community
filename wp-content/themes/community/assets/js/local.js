jQuery(document).ready(function () {

    let $ = jQuery;


    $('.nv-new-menu-icon img, .res-menu img').click(function () {
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


    $(".drop-list i").click(function () {
        $(".dropdown-custom").not($(this).parents(".modal-boxes").find(".dropdown-custom")).removeClass("drop-add");
        $(this).parents(".modal-boxes").find(".dropdown-custom").toggleClass("drop-add");
    });


    $(".report-modal-imgg").click(function () {
        var ModelpopupId = $(this).attr("model");
        //console.log(ModelpopupId)
        $("#" + ModelpopupId).modal("show");
        var currentpoptitle = $(this).find(".modal-boxes-info h4").text();
        $(".second-model h5").text(currentpoptitle);
        $(".dropdown-custom").removeClass("drop-add");
    })
});
$(".back-new h6").click(function () {
    $(this).closest(".modal").modal("hide")
})
$(".close").click(function () {
    $(".modal").modal("hide");
});