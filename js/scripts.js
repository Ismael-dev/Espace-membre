/* Document Javascript */

var formulaire = document.forms[0];

function verifPasse(passe){
	if (passe.value.length>=6){
		return true;
	}else{
		document.getElementById('erreur').innerHTML = 'Erreur ! Champ incorrect, votre mot de passe doit comporter au moins 6 caratères.';
          passe.style.borderColor = 'rgba(242, 40, 40, 0.9)';
		return false;
	}
}

function verifMail(email){
	var regex = /^[a-zA-Z0-9._-]{3,}+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	if(!regex.test(email.value)){
		document.getElementById('erreur').innerHTML = 'Erreur ! Champ incorrect.';
          email.style.borderColor = 'rgba(242, 40, 40, 0.9)';
        return false;
	}else {
      	return true;
    }
}

function check(){
	var emailOk = verifMail(email);
	var passeOk = verifPasse(passe);
   
	if(emailOk && passeOk){
		return true;
	}else{
		alert("Veuillez remplir correctement tous les champs");
		return false;
	}
}



