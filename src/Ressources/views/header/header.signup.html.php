<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>

  <script src="/formation-php/web/node_modules/jquery/dist/jquery.js."></script>
  <link rel="stylesheet" href="/formation-php/web/node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="/formation-php/web/css/style.css">
  <script src="/formation-php/web/node_modules/bootstrap/dist/js/bootstrap.js"></script>
  
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/formation-php/web/assets/stylesheets/tchat.css" id="bootstrap-css">
<script src="/formation-php/web/assets/javascript/index.js"></script>
  
</head>
<body>


        <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./index">
                        Formation-PHP
                    </a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                      
                      
                      <?php if($_SESSION["user"]->role == \App\Role\Role::VISITOR_VALUE):?>
                      <li><a href="/formation-php/web/signup">SignUp</a></li>
                      <li><a href="/formation-php/web/signin">SignIn</a></li>
                      <?php endif;?>
                      
                      <?php if($_SESSION["user"]->role != \App\Role\Role::VISITOR_VALUE):?>
                      <li><a href="/formation-php/web/home">Home</a></li>
                      <li><a href="/formation-php/web/signout">SignOut</a></li>
                      <?php endif;?>
                    </ul>
                  </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
              </nav>