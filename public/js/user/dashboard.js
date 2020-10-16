(function($) {
    'use strict';

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('#layoutSidenav_nav .sb-sidenav a.nav-link').each(function() {
            if (this.href === path) {
                $(this).addClass('active');
            }
        });

    // Toggle the side navigation
    $('#sidebarToggle').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('sb-sidenav-toggled');
    });
})(jQuery);
var profName
var profDesc
var profUrl
var profAddr
$(document).ready(async()=>{
    $.ajax({
        url: '/api/getGame',
        type: 'get',
        success: (data)=>{
            $('#username').append(data.username);
            publisher = data.data;
            if (publisher.length != 0 ){
            for(i=0;i<publisher.length;i++){
            $('#tableBody').append('<tr id="'+i+'">'+
            '<td>'+publisher[i].game+'</td>'+
           '<td>'+publisher[i].genre+'</td>'+
            '<td>'+publisher[i].site+'</td>'+
            '<td><a href="/preview/'+publisher[i].id+'">preview </a></td>'+
            +'</tr>');

            }
        }
        }
    })

   
    await $.ajax({
        url: '/api/profile',
        type: 'get',
        success: (data)=>{
            profile = data.data;
            profName=profile.Publisher_Name
            profDesc=profile.Publisher_Description
            profUrl=profile.Website_URL;
            profAddr=profile.Address;
           $('#pub_name').text(profName);
           $('#pub_Description').text(profDesc);
            $('#pub_site').text(profUrl);
            $('#pub_site').attr('href', profUrl);
            $('#pub_Address').text(profAddr);
            
        } 
    });
    $('#changeProfile').click(()=>{
        $('#changeProfile').css('display', 'none');
        $('#show').css('display', 'none');
        $('#input').css('display', 'block');
        $('#save').css('display', 'block');
        $('#cancel').css('display', 'block');

        $('#input_name').val(profName);
        $('#input_Description').val(profDesc);
         $('#input_site').val(profUrl);
         $('#input_Address').val(profAddr);
    })
    $('#cancel').click(()=>{
        $('#changeProfile').css('display', 'block');
        $('#show').css('display', 'block');
        $('#input').css('display', 'none');
        $('#save').css('display', 'none');
        $('#cancel').css('display', 'none');
    })
    $('#save').click(()=>{
        jsonData = {
            'name':$('#input_name').val(),
            'desc':$('#input_Description').val(),
            'url':$('#input_site').val(),
            'address':$('#input_Address').val()
        }
        if (jsonData["name"] == ""){
            alert("name must be filled out");
            return
        }else if(jsonData["url"]!=""){
            if(reg.test(jsonData["url"])==false){
                alert("wrong url format");
                return
            }}
               
                
        $.ajax({
            url: '/api/profile/update',
            data: jsonData,
            type: 'put',
            success: (data)=>{
               if (data.status == "OK"){
                   alert(data.message)
                   location.reload()
               }else{
                   alert(data.message)
               }
            } 
        });
    })
})
reg= /^(https:\/\/www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/gms
$('#create').click((e) => {
    
    
    e.preventDefault();
         jsonData = {
            'name': $('#addgame').val(),
            'desc': $('#adddesc').val(),
            'genre': $('#addgenre').val(),
            'site': $('#addSite').val()
        };
        if (jsonData['name'] == ''){
            alert('name must be filled out');
            return
        }else if(jsonData['site']!=''){
            if(reg.test($('#addSite').val())==false){
                alert('wrong url format');
                return
            }
        }
        $.ajax({
            url: '/api/create',
            type: 'post',
            data: jsonData,
            success: (data) => {
                if(data.status=='OK'){
                    location.reload()
                }
                alert(data.message)
            }
        });

    });

