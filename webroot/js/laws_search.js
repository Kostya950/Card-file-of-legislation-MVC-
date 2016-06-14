function fetch_select_1(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_1").innerHTML=response;
        }
    });
}


function fetch_select_2(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_2").innerHTML=response;
        }
    });
}
function fetch_select_3(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_3").innerHTML=response;
        }
    });
}
function fetch_select_4(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_4").innerHTML=response;
        }
    });
}
function fetch_select_5(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_5").innerHTML=response;
        }
    });
}
function fetch_select_6(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_6").innerHTML=response;
        }
    });
}
function fetch_select_7(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_7").innerHTML=response;
        }
    });
}
function fetch_select_8(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_8").innerHTML=response;
        }
    });
}
function fetch_select_9(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_9").innerHTML=response;
        }
    });
}
function fetch_select_10(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_10").innerHTML=response;
        }
    });
}
function fetch_select_11(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_11").innerHTML=response;
        }
    });
}
function fetch_select_12(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_12").innerHTML=response;
        }
    });
}
function fetch_select_13(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_13").innerHTML=response;
        }
    });
}
function fetch_select_14(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_14").innerHTML=response;
        }
    });
}
function fetch_select_15(val)
{
    $.ajax({
        type: 'post',
        url: '/ajax/laws_subcategory_number_date_match.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("new_select_15").innerHTML=response;
        }
    });
}



$(document).ready(function(){
    $("#number_show").slideUp();
    $("#number").keyup(function(){
        ajax_search();
    });
    $("#date").keyup(function(){
        ajax_search();
    });
});
function ajax_search(){
    $("#number_show").show();
    $.post("/ajax/laws_subcategory_number_date_match.php", {date: $("#date").val(), number: $("#number").val()},function(data){$("#number_show").html(data);})
}

