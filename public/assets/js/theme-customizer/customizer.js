if (localStorage.getItem("color"))
    $("#color").attr("href", "../assets/css/" + localStorage.getItem("color") + ".css");
if (localStorage.getItem("dark"))
    $("body").attr("class", "dark-only");
//live customizer js
$(document).ready(function () {
    $('.sidebar-type li').on('click', function () {

        $("body").append('');
        console.log("test");
        var type = $(this).attr("data-attr");

        var boxed = "";
        if ($(".page-wrapper").hasClass("box-layout")) {
            boxed = "box-layout";
        }
        switch (type) {
            case 'compact-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                $(this).addClass("active");
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                break;
            }
            case 'normal-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper " + boxed);
                $(".logo-wrapper").find('img').attr('src', '../assets/images/logo/logo.png');
                localStorage.setItem('page-wrapper', 'horizontal-wrapper');
                break;
            }
            case 'default-body': {
                $(".page-wrapper").attr("class", "page-wrapper  only-body" + boxed);
                localStorage.setItem('page-wrapper', 'only-body');
                break;
            }
            case 'dark-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper dark-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper dark-sidebar');
                break;
            }
            case 'compact-wrap': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar');
                break;
            }
            case 'color-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper color-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper color-sidebar');
                break;
            }
            case 'compact-small': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar compact-small" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar compact-small');
                break;
            }
            case 'box-layout': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper box-layout " + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper box-layout');
                break;
            }
            case 'enterprice-type': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper enterprice-type" + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper enterprice-type');
                break;
            }
            case 'modern-layout': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper modern-type" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper modern-type');
                break;
            }
            case 'material-layout': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper material-type" + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper material-type');
                
                break;
            }
            case 'material-icon': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar compact-small material-icon" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar compact-small material-icon');
                
                break;
            }
            case 'advance-type': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper enterprice-type advance-layout" + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper enterprice-type advance-layout');
                
                break;
            }
            default: {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                break;
            }
        }
        // $(this).addClass("active");
        location.reload(true);
    });

    $('.main-layout li').on('click', function () {
        $(".main-layout li").removeClass('active');
        $(this).addClass("active");
        var layout = $(this).attr("data-attr");
        $("body").attr("class", layout);
        $("html").attr("dir", layout);
    });

    $('.main-layout .box-layout').on('click', function () {
        $(".main-layout .box-layout").removeClass('active');
        $(this).addClass("active");
        var layout = $(this).attr("data-attr");
        $("body").attr("class", "box-layout");
        $("html").attr("dir", layout);
    });

});