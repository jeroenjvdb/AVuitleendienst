$(document).ready(function(){
    $('.dropdown-toggle').dropdown();

    $(".category").click(function(){
    	var cat = $(this).attr("id");
    	$(".categoryfull").hide();
    	$("."+cat).show();
    });
    $(".nav-bars").click(function() {
        $(".nav-pills").css("display","block"); 
        $(".nav-bars-x").css("display","block"); 
        $(".nav-bars").css("display","none"); 
    }); 
    $(".nav-bars-x").click(function() {
        $(".nav-pills").css("display","none"); 
        $(".nav-bars-x").css("display","none"); 
        $(".nav-bars").css("display","block"); 
    }); 
});