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
        url: '/api/admin/data',
        type: 'get',
        success: (data)=>{
            $("#username").append(data.username);
            publisher = data.data;
            if (publisher.length != 0 ){
            for(i=0;i<publisher.length;i++){
            $("#tableBody").append('<tr>'+
            '<td>'+publisher[i].publisher+'</td>'+
           '<td>'+publisher[i].address+'</td>'+
            '<td>'+publisher[i].website+'</td>'+
            '<td>'+publisher[i].email+'</td>'+
            '<td><a href="/api/admin/delete/'+publisher[i].id+'">delete </a></td>'+
            +'</tr>');

            }
        }
        }
    })
})
$("#create").click((e) => {
    e.preventDefault();
         jsonData = {
            "email": $("#createEmail").val(),
            "username": $("#createUsername").val(),
            "pass": $("#createPassword").val()
        };
        if (jsonData["email"] == "" || jsonData["pass"]=="" || jsonData["username"]==""){
            alert("Email or Password or Username must be filled out");
            return
        }
        $.ajax({
            url: '/api/admin/create',
            type: 'post',
            data: jsonData,
            success: (data) => {
                alert(data.message);
            }
        });

    });

