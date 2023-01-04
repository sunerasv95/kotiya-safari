$(function () {
    setTimeout(() => {
        if ($(".alert-danger").hasClass("show")) {
            $(".alert-danger").removeClass("show").addClass("fade").remove();
        }
        if ($(".alert-success").hasClass("show")) {
            $(".alert-success").removeClass("show").addClass("fade").remove();
        }
    }, 8000);
});

function showButtonSpinner(btnElement){
    if(btnElement.length){
        btnElement
            .attr("disable", "disable")
            .html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='px-1'>Submiting...</span>");
    }
}

function hideButtonSpinner(btnElement, btnText){
    if(btnElement.length){
        btnElement
            .removeAttr("disable", "disable")
            .empty()
            .text(btnText);
    }
}

