$(document).ready(function(){
    $("#jurisprudence_show").slideUp();
    $("#publisher").keyup(function(){
        ajax_search();
    });
    $("#date").keyup(function(){
        ajax_search();
    });
});
function ajax_search(){
    $("#jurisprudence_show").show();
    $.post("/ajax/jurisprudence_publisher_date_match.php",{date: $("#date").val(), publisher: $("#publisher").val()},function(data){$("#jurisprudence_show").html(data);})
}

