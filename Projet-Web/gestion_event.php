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
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');
    $recuper = $bdd->prepare("SELECT * FROM evenements");
    $recuper->execute();

    while ($tout = $recuper->fetch(PDO::FETCH_ASSOC)) {
        echo '
        <div class="rounded-rectangle1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                        <p>' . $tout["nom_e"] . '</p>
                        <img src="' . $tout["image_e"] . '" class="img-fluid" alt="Image" width="">
                        <div class="rectangle">';
                            include "affichage_telechargement.php";
                        echo '</div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <p>' . $tout["description_e"] . '</p>
                        <a href ="inscriptionmanifestation.php"> Alors tu es intéressé, inscris-toi.</a>
                        <div class="button-group">
                            <button id="like" onclick="clike()">
                                <img id="like-image" src="likes.png"></button> 
                                <span id="like-count">0</span>
                            <button id="dislike" onclick="diclike()">
                                <img id="dislike-image" src="dislike.png"></button> 
                            <span id="dislike-count">0</span>
                            <button id="commentons" onclick="commentons()">
                                <img id="commentons" src="commentaires.png"></button>
                            <span id="comment-count">0</span>
                            <div id="comment-section" style="display: none;">
                                <textarea id="comment-input" placeholder="Ajouter un commentaire"></textarea>
                                <button id="post-comment">Publier</button>
                                <div id="comments">
                                    <!-- Les commentaires seront affichés ici -->
                                </div>

                            </div>
                        </div>
                        <script>
                                      let likeCount = 0;
                                    let dislikeCount = 0;
                                    let Count =0;

                                    function clike() {
                                        likeCount++;
                                        document.getElementById("like-image").src = "like bleu.png";
                                        document.getElementById("dislike-image").src = "dislike.png";
                                        document.getElementById("like-count").textContent = likeCount;
                                    }

                                    function diclike() {
                                        dislikeCount++;
                                        document.getElementById("dislike-image").src = "bleu.png";
                                        document.getElementById("like-image").src = "likes.png";
                                        document.getElementById("dislike-count").textContent = dislikeCount;
                                    }
                                    function commentons() {
                                            var commentSection = document.getElementById("comment-section");
                                            var commentInput = document.getElementById("comment-input");
                                            var postButton = document.getElementById("post-comment");

                                            if (commentSection.style.display === "none") {
                                                commentSection.style.display = "block";
                                            } else {
                                                commentSection.style.display = "none";
                                            }

                                            postButton.onclick = function() {
                                                var commentText = commentInput.value;
                                                if (commentText.trim() !== "") {
                                                    var newComment = document.createElement("div");
                                                    newComment.textContent = commentText;
                                                    document.getElementById("comments").appendChild(newComment);
                                                    commentInput.value = "";
                                                    var commentCount = document.getElementById("comment-count");
                                                     commentCount.textContent = parseInt(commentCount.textContent) + 1;
                                                    
                                                }
                                            };
                                        }
                                </script>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 text-center">
                        <div class="button-group1">
                            <button class="modifier-button" id="okay" onclick="supprimer()">Supprimer</button>
                            <button class="modifier-button" id="okay" onclick="modifier()">Modifier</button>
                            <button class="modifier-button" id="okay" onclick="ajouter()">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
    ?>
</main>

<footer class="text-black py-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-center">
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
</footer>

<script>
    function supprimer() {
        var mainElement = document.querySelector('main');
        mainElement.innerHTML = `
            <main role="main">
                <div class="rounded-rectangle">
                    <h2>Suppression d'un commentaire d'un événement passé</h2>
                    <form action="evenement_passee.php" method="POST">
                    <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                            <div class="zonetexte" style="margin-top: 10px">
                                <textarea placeholder="Nom de l'évènement" id="new_nom" name="new_nom" ></textarea>
                            </div>
                            <div class="zonetexte" style="margin-top: 10px ">
                                <textarea placeholder="Commentaire" id="new_commentaire" name="new_commentaire" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 text-center">
                            <div class="button-group">
                                <button class="soumettre_event circle" type="submit" name="action" value="supprime">Soumettre</button>
                            </div>
                        </div>
                    </div>
                </div>
                    </form>
                </div>
               
            </main>
        `;
    }

    function modifier() {
        var mainElement = document.querySelector('main');
        mainElement.innerHTML = `
            <main role="main">
                <div class="rounded-rectangle">
                    <h2>Modification d'un événement passé</h2>
                    <form action="evenement_passee.php" method="POST">
                        <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                <div class="drop-zone" onclick="selectImage()">
                                    <span class="drop-zone__prompt">Ajouter une image +</span>
                                    <input type="file" id="new_image" name="new_image" class="drop-zone__input" style="display: none;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                <div class="zonetexte" style="margin-top: 10px">
                                    <textarea placeholder="Nom de l'évènement" id="nom" name="nom" ></textarea>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 text-center">
                                    <div class="button-group" >
                                        <button class="soumettre_event circle" type="submit"  name="action" value="modifie">Soumettre</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        `;
    }

    function ajouter() {
        var mainElement = document.querySelector('main');
        mainElement.innerHTML = `
            <main role="main">
                <div class="rounded-rectangle">
                    <h2>Ajout d'un événement</h2>
                    <form action="evenement_mois.php" method="POST">

                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                    <div class="drop-zone" onclick="takeImage()">
                                        <span class="drop-zone__prompt">Ajouter une image +</span>
                                        <input type="file" id="image_e" name="image_e" class="drop-zone__input" style="display: none;">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <div class="zonetexte" style="margin-top: 10px">
                                        <textarea placeholder="Nom de l'évènement" id="nom_e" name="nom_e" ></textarea>
                                    </div>
                                    <div class="zonetexte" style="margin-top: 10px ">
                                        <textarea placeholder="Description de l'évènement" id="description_e" name="description_e" ></textarea>  
                                    </div>
                                    <div class="zonetexte" style="margin-top: 10px ">
                                        <textarea placeholder="Prix" id="prix_e" name="prix_e" ></textarea>  
                                    </div>
                                    <div class="zonetexte" style="margin-top: 10px ">
                                        <label for="date_e">Date :</label>
                                        <input type="date" id="date_e" name="date_e" required>  
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 text-center">
                                    <div class="button-group">
                                        <button class="soumettre_event circle" type="submit" name="action" value="regle">Soumettre</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </main>
        `;
    }

    function selectImage() {
        document.getElementById('new_image').click();
    }
    function takeImage() {
        document.getElementById('image_e').click();
    }
</script>


<script src="./assets/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="./assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="main.js"></script>

</body>
</html>