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

    setupCalendar();

    function setupCalendar(){
        var resparent = $(".reserved").parent().parent().parent();
        resparent.css({
            "background-color" : "#f2dede"
        });

        $(".calendar th:nth-child(2)").attr("colspan" , "1");
        $(".calendar th:nth-child(3)").attr("colspan" , "5");
        $(".calendar th:nth-child(4)").attr("colspan" , "1");
        
        $(".calendar .btn").hover(function(){
            $(this).parent().addClass("secondblue");
        }, function(){
            $(this).parent().removeClass("secondblue");
        });

        var colgroups;

        for(var i = 0; i < 8; i++){
            colgroups += "<colgroup></colgroup>";
        }

        $(".calendar").prepend(colgroups);

        $(".calendar").delegate('td','mouseover mouseleave', function(e) {
            if (e.type == 'mouseover') {
              $(this).parent().addClass("lightblue");
              $("colgroup").eq($(this).index()).addClass("lightblue");
            }
            else {
              $(this).parent().removeClass("lightblue");
              $("colgroup").eq($(this).index()).removeClass("lightblue");
            }
        });
    }

    $('.calendar.table tbody tr td').on('click', function(e){
        console.log(e);
        var datetime = e.currentTarget.dataset.datetime;
        var d = new Date(datetime);
        console.log(d);
        var url = window.location.href;
        var urlArr = url.split('/');
        var id = e.currentTarget.children[0].dataset.id;
        console.log(id);
        var route = '/reservations/create/' + d.getFullYear() + '-' + (parseInt(d.getMonth()) + 1) + '-' + d.getDate() + '/' + id;
        // route = route.replace(':date',  )
        console.log(route);
        window.location = route;
    })
});