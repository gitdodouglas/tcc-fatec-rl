<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
      <title>YOUPIE</title>

      <!-- CSS  -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
      <script src="js/jquery.min.js"></script>
      <script src="js/materialize.min.js"></script>
      <script src="js/init.js"></script>      
      <style>
        @media only screen and (min-width : 992px) {
            #titleHead{
                float: left;
            }    
        }
         #toast-container {
            top: auto !important;
            right: auto !important;
            bottom: 10%;
            left:7%;
         }

         .input-field input[type=text].invalid {
     border-bottom: 1px solid red;
     box-shadow: 0 1px 0 0 red;
   }

   .grad {
    background: #f4f8f9; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(#f4f8f9, #e5ecee); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(#f4f8f9, #e5ecee); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(#f4f8f9, #e5ecee); /* For Firefox 3.6 to 15 */
    background: linear-gradient(#f4f8f9, #e5ecee); /* Standard syntax */
    background-repeat: no-repeat;
    background-attachment: fixed;
}
      </style>
      <script src="js/angular.min.js"></script>
      <script src="js/routes.js"></script>
      <script src="js/angular-md5.js"></script>
      <script src="js/angular-cookies.min.js"></script>
      <script src="js/ngMask.js"></script>
      <script src="app.module.js"></script>
      <script src="app.routes.js"></script>
      <script src="components/Autenticacao/services/services.js"></script>
      <script src="components/Autenticacao/directives/directives.js"></script>
      <script src="components/Autenticacao/controllers/loginController.js"></script> 
      <script src="components/Autenticacao/controllers/cadastroController.js"></script>   
      <script src="components/Autenticacao/controllers/trocarSenhaController.js"></script> 
      <script src="components/Autenticacao/controllers/esqueciSenhaController.js"></script>
      <!-- <script src="js/angular/services/service.js"></script>
      <script src="js/angular/controllers/contatosCtrl.js"></script> -->
   </head>
   <body ng-app="appModule" class="grad" style="height:100%;" >
      <nav class="grey lighten-5" role="navigation">
         <div class="nav-wrapper container">
            <!-- <a id="logo-container" style="color:#1a237e;" href="#" class="brand-logo">Logo</a> -->
            <a id="logo-container" href="#" class="brand-logo"><img style="width:150px;margin-top:17px;" src="images/logo3.jpg"></img></a>
            <ul class="right hide-on-med-and-down">
               <li><a href="#!login"style="color:#212121;">Entrar</a></li>
               <!-- <li><a href="#!trocarSenha"style="color:#212121;">trocar</a></li> -->
                <!--  <li><a href="#!esqueciSenha"style="color:#212121;">esqueciSenha</a></li> -->
                <li><a href="#!cadastro"class="waves-effect waves-light btn green darken-2" >Cadastre-se</a></li>
             </ul>

             <ul id="nav-mobile" class="side-nav">
                <li><a href="#!" style="color:#212121;">Início</a></li>
                <li><a href="#!cadastro" style="color:#212121;">Cadastre-se</a></li>
                <li><a href="#!login" style="color:#212121;">Entrar</a></li>
             </ul>
             <a href="" data-activates="nav-mobile" style="color:#212121;" class="button-collapse"><i class="material-icons">menu</i></a>
          </div>
       </nav>
       <ng-view>
       </ng-view>
    </body>
 </html>
