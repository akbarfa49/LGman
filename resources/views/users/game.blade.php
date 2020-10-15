<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Information</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
<body>
  <div class="container">
    <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(https://images.unsplash.com/photo-1552152974-19b9caf99137?fit=crop&w=1350&q=80);">
      <h2 class="mb-4" id="game">
      </h2>
      <p class="mb-4" id="publisher">
      </p>
    </div>
    <div>
      <div class="row">
        <div class="col">
          <h4>Description</h4>
          <p id="desc"></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h4>Genre</h4>
          <p id="genre"></p>
        </div>
        <div class="col">
          <h4>Website</h4>
          <a href="#" id="site">Game Website</a>
        </div>
      </div>
      <div class="row">
        <button id="edit" class="btn btn-primary col mx-1"  data-toggle="modal" data-target="#exampleModal">Edit  Game Info</button>
        <button id="delete" class="btn btn-danger col mx-1">Delete Game</button>
        
        </div>
    </div>
  </div>
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
      <div class="form-group">
            <label for="recipient-name" class="col-form-label">Game Name:</label>
            <input type="text" class="form-control" id="addgame">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Game Desc:</label>
            <textarea type="text" class="form-control" id="adddesc"></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Genre:</label>
            <input type="text" class="form-control" id="addgenre"></textarea>
          </div>
      
          <div class="form-group">
            <label for="message-text" class="col-form-label">Site:</label>
            <input type="text" class="form-control" id="addsite" placeholder="https://www.example.com"></textarea>
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js" crossorigin="anonymous"></script>
<script src="/js/user/gameview.js"></script>
</body>
</html>