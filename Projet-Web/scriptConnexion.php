<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
      <?php
      $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', 'root', '');

        $mail = $_POST['mail'];
        $motDePasse = $_POST['motDePasse'];
        if (!isset($_POST['mail']) || !isset($_POST['motDePasse'])){
            header("Location: connexion.html");
            // Arrête l'exécution de ce fichier par PHP
            return; 
        }
        else{
            $stmt = $bdd->prepare("CALL connexion(:mail , :motDePasse)");
            $stmt->bindValue(':mail', $mail , PDO::PARAM_STR);
            $stmt->bindValue(':motDePasse', $motDePasse , PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($resultat) {
             header("Location: etudiant.html");
             exit;
            } 

            else {
             echo "Nom d'utilisateur ou mot de passe incorrect.";
             header("Location: inscription.html");
             
            }
        }
        
      ?>
    </body>
</html>