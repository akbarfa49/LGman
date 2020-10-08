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
            $('#edit').attr('href', '/edit/'+game.game_id)
            $('#delete').attr('href', '/api/delete/'+game.game_id)
            }
        
        
    })
})