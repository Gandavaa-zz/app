$(".sidebar-dropdown > a").click(function() {
    $(".sidebar-submenu").slideUp(200);
    if ($(this).parent().hasClass("active")) {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
    } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
    }
});



$(document).ready(function() {
    $("#menu-toggle").click(function() {
        if ($(".page-wrapper").hasClass("toggled"))
            $(".page-wrapper").removeClass("toggled");
        else {
            $(".page-wrapper").addClass("toggled");
        }
    });
});