<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Starter Template - Materialize</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script src="js/jquery.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/routes.js"></script>
    <script src="app.module.js"></script>
    <script src="app.routes.js"></script>
    <!-- <script src="js/angular/services/service.js"></script>
    <script src="js/angular/controllers/contatosCtrl.js"></script> -->
  </head>
  <body ng-app="appModule" >
    <ng-view>     
    </ng-view>
    <a href="#!principal">principal</a>
  </body>
</html>
