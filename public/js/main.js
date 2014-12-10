$(document).ready(function(){
    $('.dropdown-toggle').dropdown();

    $(".category").click(function(){
    	var cat = $(this).attr("id");
    	$(".categoryfull").hide();
    	$("."+cat).show();
    });
});