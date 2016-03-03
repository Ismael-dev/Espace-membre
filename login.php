<?php

// Démarrage de session inclu dans header.php (ne pas le rajouter ici)
include ('header.php');

// Connexion à la base de données
require_once ('conndb.php');

//Verification de la présence du mail dans la bd pour eviter de créer plusieur compte avec la même adresse.
$requete = $connDB->prepare("SELECT * FROM users");
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_ASSOC);



if((isset($_POST['email']))&&(isset($_POST['pass']))){
    foreach ($users as $key => $val) {
        if ($users[$key]['mail']==$_POST['email'] && $users[$key]['pass']==(sha1($_POST['pass']))){

            // On rentre le mail en variable de session
            $_SESSION['mail']=$users[$key]['mail'];

            // Préparation de la requete pour écrire la date et l'heure de connexion
            $requete = $connDB->prepare("UPDATE users SET date_connexion=?, nbr_connexion=? WHERE mail='".$_SESSION['mail']."'");
            
            //Préparation des variable à injecter dans la base de données
            $nbr_connexion=($users[$key]['nbr_connexion'])+1;
            //récupération date et heure maintenant
            $date_connexion=date("d/m/Y H:i",time());

            //vérification de mes variables.
            echo $nbr_connexion."<br>";
            echo $date_connexion."<br>";
            
            //Execution de ma requète.
            $requete->execute([$date_connexion, $nbr_connexion]);
            
            die('Vous êtes à présent connecté.'); 

        }else{
            continue;
        }
    }
}


debug($users);



?>


		<div class="container-fluid">
			<div class="col-lg-4 col-sm-3"></div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
            	<h3 class="text-center">SE CONNECTER</h3>
    			<form role="form" name="mon_form" method="POST" action="#">
    				<fieldset>
    					<label>UTILISATEUR</label> 
    					<input type="text" class="form-control" placeholder="Votre mail" required autofocus value="" name="email" id="email">
    					<span id="erremail" class="erreur"></span>
    				</fieldset>
    			  <br>
    				<fieldset>
    					<label>MOT DE PASSE</label> 
    					<input type="password" class="form-control" placeholder="Mot de passe" required name="pass" id="pass">
    					<span id="errpasse" class="erreur"></span>
    				</fieldset>
    				<br>
    				<button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>  				
    			</form>
            </div>
            <div class="col-lg-4 col-sm-3"></div>
		</div>



<?php
// Inclusion du pied de page
include ('footer.php');
?>