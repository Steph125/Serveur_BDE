<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE Cesi</title>
    <link rel="stylesheet" href="./assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Custom CSS -->
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
            <a class="navbar-brand" href="tableau_de_bord.php">
                <img src="cesi.jpg" width="120" height="100" class="d-inline-block align-top" alt="Logo">
            </a>

            <button class="navbar-toggler border-black" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-bell" style="color: black;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Liste_suggestions(anglais).html"><i class="fas fa-globe-americas" style="color: black;"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Username
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Home</a>
                            <a class="dropdown-item" href="tableau_de_bord.php">Dashboard</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-user-circle" style="color: black;"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main role="main">
    <div class="rounded-rectangle">
        <!-- Contenu de votre rectangle centré ici -->
        <h2>Boîte à idées</h2>
    </div>
    
    <section class="full-width-section border-black" style="margin-top: 50px;">
        <?php
            include "RecupereIdee.php";

        ?>
    </section>

</main>

<script>
    function modifierdate() {
        // Sélection de l'élément où le contenu sera inséré
        var mainElement = document.querySelector('main');

        // Modification du contenu de la balise main
        mainElement.innerHTML = `
            <main role="main">
                <div class="rounded-rectangle">
                    <!-- Contenu de votre rectangle centré ici -->
                    <h2>Modifier une date</h2>
                    <form action="modifieidee.php" method="POST">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <div class="zonetexte" style="margin-top: 10px">
                                        <textarea placeholder="Nom de l'évènement" id="nom_i" name="nom_i" ></textarea>
                                    </div>
                                    <div class="zonetexte" style="margin-top: 10px">
                                        <label for="new_date">Date:</label>
                                        <input type="DATE" id="new_date" name="new_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 text-center">
                                    <div class="button-group">
                                        <button class="soumettre_event circle" type="submit">Soumettre</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>`;
    }

    function modifieridee() {
        // Sélection de l'élément où le contenu sera inséré
        var mainElement = document.querySelector('main');

        // Modification du contenu de la balise main
        mainElement.innerHTML = `
            <main role="main">
                <div class="rounded-rectangle">
                    <!-- Contenu de votre rectangle centré ici -->
                    <h2>Modifier une idée</h2>
                    <form action="modifieidee.php" method="POST">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center ">
                                <div class="drop-zone" onclick="Image()">
                                        <span class="drop-zone__prompt">Ajouter une image +</span>
                                        <input type="file" id="new_image" name="new_image" class="drop-zone__input">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <div class="zonetexte" style="margin-top: 10px">
                                        <textarea placeholder="Nom de l'évènement" id="nom_i" name="nom_i" ></textarea>
                                    </div>
                                    <div class="zonetexte" style="margin-top: 10px">
                                        <textarea placeholder="Description" id="new_description" name="new_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 text-center">
                                    <div class="button-group">
                                        <button class="soumettre_event circle" type="submit">Soumettre</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>`;
    }
    function Image() {
        document.getElementById('new_image').click();
    }
</script>


<footer class=" text-black py-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text center">
                <img src="cesi.jpg" width="120" height="100" class="d-inline-block align-bottom" alt="Logo">
            </div>
            <div class="col-md-12 text-center">
                <h5>Suivez-nous</h5>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://www.bing.com/search?q=facebook&FORM=HDRSC1"><i class="fab fa-facebook-f" style="color: black;"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.bing.com/search?q=twitter&qs=n&form=QBRE&sp=-1&ghc=1&lq=0&pq=twitter&sc=11-7&sk=&cvid=9B5ACF55684C4975B4AA2E2A93A492E2&ghsh=0&ghacc=0&ghpl="><i class="fab fa-twitter" style="color: black;"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.bing.com/search?q=instagram&filters=ufn%3a%22Instagram%22+sid%3a%22a2113d26-7976-df57-241f-77b7bbb1b4f7%22&asbe=SS&qs=MB&pq=in&sk=HS1&sc=10-2&cvid=2DEB27F667C24EB285DAFE0D7D423C19&FORM=QBRE&sp=2&ghc=1&lq=0"><i class="fab fa-instagram" style="color: black;"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.bing.com/search?q=linkedin&filters=ufn%3a%22LinkedIn%22+sid%3a%22401e29b7-e564-7d0a-69dd-4aeff23c198d%22&asbe=OS&qs=MB&pq=likd&sc=10-4&cvid=54999CBC93DF4064AF14BB22E091E5EE&FORM=QBRE&sp=1&ghc=1&lq=0"><i class="fab fa-linkedin-in" style="color: black;"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <p>&copy; 2024 CESI - Tous droits réservés</p>
            </div>
        </div>
    </div>

    <script src="./assets/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="./assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
</footer>

</body>
</html>
