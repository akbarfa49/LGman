$(document).ready(()=>{
    $.ajax({
        url: '/api/getGame/'+window.location.pathname.split('/')[2],
        type: 'get',
        success: (data)=>{
            game = data.data;
            
            $('#game').text(game.game);
            $('#publisher').text(game.publisher);
            $('#desc').text(game.desc);
            $('#genre').text(game.genre);
            $('#site').attr('href', game.site);
            $('#delete').attr('href', '/api/delete/'+game.game_id)
            duar = game.game_id
            }
        
        
    })
})
var duar
$("#save").click(()=>{
    jsonData = {
        "name": $("#addgame").val(),
        "desc": $("#adddesc").val(),
        "genre": $("#addgenre").val(),
        "site": $("#addsite").val(),
        "id": duar
    };
    if (jsonData["name"] == ""){
        alert("name must be filled out");
        return
    }
    $.ajax({
        url: '/api/update',
        type: 'put',
        data: jsonData,
        success: (data) => {
            if(data.message=='OK'){
                location.reload()
            }
        }
    });
})