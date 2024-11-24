<?php
// charger_produits.php

// Connexion à la base de données avec PDO
$host = 'localhost';
$dbname = 'projet_web';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
    die();
}

// Récupérer les produits arrivés le mois dernier
$moisDernierDebut = date('Y-m-01');
$moisDernierFin = date('Y-m-t');

$stmt = $pdo->prepare("SELECT * FROM evenements WHERE date_e BETWEEN :debut AND :fin");
$stmt->bindParam(':debut', $moisDernierDebut);
$stmt->bindParam(':fin', $moisDernierFin);
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits vendus le mois dernier</title>
    <link rel="stylesheet" href="Style.css" >
    <link rel="stylesheet" href="Evènement_BDE.css" >
</head>
<body>
    <section class="top_produit">
    <?php foreach ($produits as $produit) : ?>
       
                <section class="event">
                    <p><?php echo $produit['nom_e']; ?></p>
                    <div class= ligne></div>
                    <img src="<?php echo $produit['image_e']; ?>" alt="">
                    <div class="description">
                        <p><?php echo $produit['description_e']; ?></p>
                    </div>
                    <div class="comment">
                        <button>Ajouter au panier</button>
                    </div>
                </section>
    <?php endforeach; ?>
    </section>
</body>
</html>