//external JS and JQuery for WP A1


//contact form JQuery Validation Plugin code
$(function() {
    $("#contact").validate({
        rules: {
            question: "required",
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            question: "Please enter a question",
        }
    });
});

window.onscroll = function() { stickyHeader() };

function stickyHeader() {
    var navbar = document.getElementById("navbar");
    var stick = header.offsetTop;

    if (window.pageYOffset > stick) {
        navbar.classList.add("stick");
    } else {
        navbar.classList.remove("stick");
    }
}
var age = 1;
// updates age on reg page
function ageUpdate(age) {
    document.querySelector("#ageOutput").value = age;
    this.age = age;
}