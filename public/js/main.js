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
    //voor date en time picker reservatie
    $('#date').pickadate({
        formatSubmit : 'yyyy-mm-dd',
        format : 'yyyy-mm-dd'
    });
    $('#time').pickatime({
        formatSubmit : 'HH:i:s',
        format : 'H:i',
        min:'08:00',
        max:'22:00',
    });

    $(".thumbnail").click(function(e){
        if(e.target.nodeName  != "INPUT"){
            var check = $(this).find("input:checkbox.checker").prop("checked");
            $(this).find("input:checkbox.checker").prop("checked", !check);
        }
    });

    $('.filter').keyup(filterContent);
    function filterContent()
    {
        var search = $('.filter').val();
        $('.haystack').each(function(i,obj){
            $(this).parent().parent().parent().css('display','block');
            text = $(this).html().toLowerCase()
            console.log(obj);
            if(text.indexOf(search.toLowerCase()) === -1)
            {
                var parent = $(this).parent();
                var parent = parent.parent();
                var parent = parent.parent();
                parent.css('display','none');
            }
        });
    }
});