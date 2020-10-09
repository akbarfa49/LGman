(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

$(document).ready(()=>{
    $.ajax({
        url: '/api/getGame',
        type: 'get',
        success: (data)=>{
            $("#username").append(data.username);
            publisher = data.data;
            if (publisher.length != 0 ){
            for(i=0;i<publisher.length;i++){
            $("#tableBody").append('<tr id="'+i+'">'+
            '<td>'+publisher[i].game+'</td>'+
           '<td>'+publisher[i].genre+'</td>'+
            '<td>'+publisher[i].site+'</td>'+
            '<td><a href="/preview/'+publisher[i].id+'">preview </a></td>'+
            +'</tr>');

            }
        }
        }
    })
})
$("#create").click((e) => {
    e.preventDefault();
         jsonData = {
            "name": $("#addgame").val(),
            "desc": $("#adddesc").val(),
            "genre": $("#addgenre").val(),
            "site": $("#addsite").val()
        };
        if (jsonData["name"] == ""){
            alert("name must be filled out");
            return
        }
        $.ajax({
            url: '/api/create',
            type: 'post',
            data: jsonData,
            success: (data) => {
                alert(data.message);
            }
        });

    });

