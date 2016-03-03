<?php
function debug($var){
	echo '<pre>'.print_r($var, true).'</pre>';
}

function valide_pass($chaine, $mode = 2){
    $minimum = array(1 => 4, 2 => 6, 3 => 8);
    $pourcentage = array(1 => 26, 2 => 51, 3 => 76);

    //regex
    // (?=(.*[A-Z]){1,}) ========= contient au moins une MAJ
    // (?=(.*[a-z]){1,}) ========= contient au moins une minus
    // (?=(.*[0-9]){1,}) ========= contient au moins un chiffre

    //  et $minimum[$mode]=6 donc au moins 6 caractères
    //  $c_uniques et les counts comptent le nombre de caractères identiques

    if(preg_match('#(?=(.*[A-Z]){1,})(?=(.*[a-z]){1,})(?=(.*[0-9]){1,}){'.$minimum[$mode].',}#', $chaine)){
        $a_chaine = str_split($chaine);
        $c_uniques = array_unique($a_chaine);
        if(count($c_uniques)*100/count($a_chaine) >= $pourcentage[$mode]){
            return true;
        }
    }
    return false;
}