$(document).ready(function()
{
    $(document).on('click', '.pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();


        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];
        var href = location.hash;


        getData(page,href);
    });
});


function getData(page,href){

        $.ajax(
        {
            url: '?page=' + page, 
            type: "get",
            datatype: "html",
            data:{href:href},
        })
        .done(function(data)
        {
            var newApps = href.indexOf("newApps");
            if(newApps > 0){
            $("#newApps-lists").empty().html(data);
            }  
            var inProgress = href.indexOf("inProgress");
            if(inProgress > 0){
            $("#inProgress-lists").empty().html(data);
            }         
            var accepted = href.indexOf("accepted");
            if(accepted > 0){
            $("#accepted-lists").empty().html(data);
            }
            var dropped = href.indexOf("dropped");
            if(dropped > 0){
            $("#dropped-lists").empty().html(data);
            }       
          
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server ');
        });
}