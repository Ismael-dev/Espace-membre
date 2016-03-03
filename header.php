<!-- 
Le header comprend le demarrage de session (utilisé sur chaque page)
et aussi la barre de navigation(le menu).
et tous les scripts et css liés

-->
<?php
 //Démarrage de la session
session_start();
require_once ('fonction.php');
?>
<?php


if(isset($_SESSION['mail'])){
    $membre= "<a href='#'><B>Bienvenue ".$_SESSION['mail']."</B></a>  ";
    $membre.= "|||  <a href='logout.php'><B>DECONNEXION</B></a>";
}else{
    $membre= "<a href='register.php'><B>S'inscrire </B></a>     |||
                                <a href='login.php'><B> Se connecter</B></a>";
   // header('location:index.php');
}
?>



<!DOCTYPE html>
<html>
  	<head>
  		<meta charset="utf-8">
  		<title>ESPACE MEMBRE</title>
  		<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  		<link type="text/css" rel="stylesheet" href="css/style.css" />
  		<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
  		<script type="text/javascript" src="js/bootstrap.js"></script>
		
  	</head>
  	<body>
  		<nav class="navbar navbar-inverse">
  			<div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle Nav</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="index.php">Espace membre</a>
                </div>
                <div id="navbar" class="colapse navbar-collapse">
                    <div class="nav navbar-nav right"><br>
                        <?php echo $membre; ?>
                    </div>
                
                    
                </div>     
  			</div>
        </nav>