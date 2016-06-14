$(document).ready(function(){
    $("#article_show").slideUp();
    $("#publisher").keyup(function(){
        ajax_search();
    });
    $("#date").keyup(function(){
        ajax_search();
    });
});
function ajax_search(){
    $("#article_show").show();
    $.post("/ajax/articles_author_date_match.php",{date: $("#date").val(), publisher: $("#publisher").val()},function(data){$("#article_show").html(data);})
}
