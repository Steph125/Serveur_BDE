<?php

$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');

$verifions = $bdd->prepare("SELECT * FROM idees WHERE nom_i = :nom_i");
$verifions->bindParam(':nom_i', $nom_i);
$verifions->execute();
$verificat = $verifions->fetch(PDO:: FETCH_ASSOC);

if ($verificat) {

    $verifierer = $bdd->prepare("CALL Likeidee(:nom_i,:new_like)");
    $verifierer->bindValue(':nom_i', $nom_i, PDO::PARAM_STR);
    $verifierer->bindValue(':new_like', $new_like, PDO::PARAM_INT);
    $verifierer->execute();

    echo "<button id='like' onclick='clik()'><img id='image' src='like.png'></button>";
   

    echo "<script>";
    echo "let new_like = 0;";
    echo "function clik() {";
    echo "document.getElementById('image').src = 'like bleu.png';";
    echo "new_like++;";
    echo "}";
    echo "</script>";
}

?>


<?php

/*$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');

$verifie = $bdd->prepare("SELECT * FROM evenements WHERE nom_e = :nom_e");
$verifie->bindParam(':nom_e', $nom_e);
$verifie->execute();
$reverificat = $verifie->fetch(PDO:: FETCH_ASSOC);

if ($reverificat) {

    $verifiere = $bdd->prepare("CALL likeevenement(:nom_e,:likes)");
    $verifiere->bindValue(':nom_e', $nom_e, PDO::PARAM_STR);
    $verifiere->bindValue(':likes', $likes, PDO::PARAM_INT);
    $verifiere->execute();

    echo "<button id='like' onclick='clike()'><img id='image' src='like.png'></button>";
    echo "<button id='dislike' onclick='disclike()'><img id='image' src='dislike.png'></button>";

    echo "<script>";
    echo "let new_like = 0;";
    echo "function clike() {";
    echo "document.getElementById('image').src = '';";
    echo "new_like++;";
    echo "}";
    echo "function disclike() {";
    echo "document.getElementById('image').src = '';";
    echo "}";
    echo "</script>";
}*/

?>