<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="/css/dashboard.css" rel="stylesheet" />
        <link href="/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous" />
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="/dashboard">Lara Game Man</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                   
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <div id="username"></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4">Dashboard</h1>
                        <div class="breadcrumb mb-4 d-flex align-items-center">
                            <div class="breadcrumb-item active w-25">Dashboard</div>
                            <div class="d-flex justify-content-end w-75">
                            <button class="btn btn-primary"  id="changeProfile">Change Profile</button>
                            <button class="btn btn-primary mx-1" style="display: none;" id="save">save changes</button>
                            
                            <button class="btn btn-light btn-outline-dark mx-1" style="display: none;" id="cancel">cancel</button>
                            </div>
                        </div>
                    <section id="show" style="display: block;">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-header">Publisher</div>
                                    <div class="card-body" id="pub_name"></div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-header">Site</div>
                                    <a href="#" class="card-body" id="pub_site"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-6 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-header">Description</div>
                                    <div class="card-body" id="pub_Description"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-header">Address</div>
                                    <div class="card-body" id="pub_Address" ></div>
                                </div>
                            </div>
                        </div>
                        </section>
                        <section id="input" style="display:none;">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-header">Publisher</div>
                                    <input class="card-body" id="input_name" value=""/>
                                    
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-header">Site</div>
                                    <input class="card-body" id="input_site" value="" placeholder="https://www.example.com"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-6 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-header">Description</div>
                                    <input class="card-body" id="input_Description" value="">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-header">Address</div>
                                    <input class="card-body" id="input_Address" value="">
                                </div>
                            </div>
                        </div>
                        </section>
                        <div class="row w-100 d-flex justify-content-end">
                        
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">Post Game</button>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Game Name</th>
                                                <th>Genre</th>
                                                <th>Website URL</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Button trigger modal -->

<!-- Modal -->
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
            <input type="text" class="form-control" id="addSite" placeholder="https://www.example.com">
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="create">Save changes</button>
      </div>
    </div>
  </div>
</div>

        <script src="/js/jquery.js" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.js" crossorigin="anonymous"></script>
        <script src="/js/user/dashboard.js"></script>
    </body>
</html>
