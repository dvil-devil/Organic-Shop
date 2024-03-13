$(document).ready(function() {
    $.get('products/catalogue', function(res) {
        $(".products_container").html(res);
    });

    $("body").on("click", ".categories_form button", function() {
        let button = $(this);
        let form = button.closest("form");

        form.find("input[name=category]").val(button.attr("data-category"));
        button.closest("ul").find(".active").removeClass("active");
        button.addClass("active");
        filterProducts(form);
        return false;
    });

    $("body").on("keyup", ".search_form", function() {
        let form = $(this);
        filterProducts(form);
        $(".categories_form").find(".active").removeClass("active");
        return false;
    });

    $("body").on('click', '.pages', function(e){
        e.preventDefault()
        var page = $(this).attr('data-page');
        console.log(page);
        $.get('products/catalogue/page/'+page, function(res) {
            $('.products_container').html(res);
        });
    });
});

/* Ajax to filter products */
function filterProducts(form) {
    $.post(form.attr("action"), form.serialize(), function(res) {
        $(".products_container").html(res);
    });
}