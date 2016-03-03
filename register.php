<?php
// Démarrage de session inclu dans header.php (ne pas le rajouter ici)
include ('header.php');

if (!empty($_POST)) {
    $erreur = array();

    if (($_POST['email1']==$_POST['email2']) && (filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL))) {
        if (($_POST['pass1']==$_POST['pass2']) && valide_pass($_POST['pass1'])){
            
            // inclusion du fichier de connexion base de donnée
            require_once ('conndb.php');

            //Verification de la présence du mail dans la bd pour eviter de créer plusieur compte avec la même adresse.
            $requete = $connDB->prepare("SELECT mail FROM users WHERE mail=?");
            $requete->execute([$_POST['email1']]);
            $mail = $requete->fetch();

            //debug($mail);       //Affichage debug des erreurs mail
            
            if ($mail){
                $erreur['email'] = "Votre mail est déjà utilisé pour un compte.";
            }else{
              //Préparation de la requete d'insertion
                $requete = $connDB->prepare("INSERT INTO users SET mail=?, pass=?, date_creation=?");

                //Préparation des variable à injecter dans la base de données
                $mail=$_POST['email1'];
                //Hachage du mot de passe grace à sha1
                $pass=sha1($_POST['pass1']);
                //récupération date et heure maintenant
                $date_creation=date("d/m/Y H:i",time());

                //vérification de mes variables.
                //echo $mail;
                //echo $pass;
                //echo $date_creation;
                
                $requete->execute([$mail, $pass, $date_creation]);
                $_SESSION['mail']=$mail;
                die('Votre compte a correctement été créé.'); 
            }

        }else{
            $erreur['pass'] = "Vos mots de passe ne sont pas valides ou identiques";
        }
    }else{
        $erreur['email'] = "Vos mails ne sont pas valides ou identiques";
    }
//debug($erreur);           //Affichage debug des erreurs mot de passe
}
?>

		<div class="container-fluid">
			<div class="col-lg-4 col-sm-3"></div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <h3 class="text-center">S'INSCRIRE</h3>

    			<form role="form" name="mon_form" method="POST" action="#">
    				<fieldset>
    					<label>UTILISATEUR</label> 
    					<input type="text" class="form-control" placeholder="Votre mail" required autofocus value="" name="email1" id="email1">
                        <input type="text" class="form-control" placeholder="Retapez votre mail" required value="" name="email2" id="email2">
    					<span id="erremail" class="erreur"><?php if (isset($erreur['email'])){ echo $erreur['email'];} ?></span>
    				</fieldset>
    			  <br>
    				<fieldset>
    					<label>MOT DE PASSE</label> 
    					<input type="password" class="form-control" placeholder="Mot de passe" required name="pass1" id="pass1">
                        <input type="password" class="form-control" placeholder="Retapez votre mot de passe" required name="pass2" id="pass2">
                        <span id="errepass" class="erreur"><?php if (isset($erreur['pass'])){ echo $erreur['pass'];} ?></span>
    					<span id="infopass" class="info">Minimum de 6 caractères dont un chiffre, une majuscule et une minuscule.</span>
    				</fieldset>
    				<br>
    				<button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>  				
    			</form>
            </div>
            <div class="col-lg-4 col-sm-3"></div>
		</div>
<?php




include ('footer.php');
?>