$(document).ready(function(){
    $("body").on("click", ".profile_btn", function() {
        $(".logout_btn").addClass("show");
        $(".popover_overlay").fadeIn();
        $("body").addClass("show_popover_overlay");
    });
    $("body").on("click", ".popover_overlay", function() {
        $(".logout_btn").removeClass("show");
        $(".popover_overlay").fadeOut();
        $("body").removeClass("show_popover_overlay");
    });
    setTimeout(function() {
        $(".alert").fadeOut();
    }, 2000);
    $.get('/products/get_cart', function(res) {
        $(".show_cart").html(res);
    });
});

