<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediatheque</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Les films de la médiathèque</h1>
    </header>
    <a class='lien-simple' href='ajout-film.php'>Ajouter un film</a>
    
    <?php
    include ('config-bdd.php');

    $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);

    //récupérer les infos des films
    $requete = "SELECT * FROM `films`";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    while ($film = $prepare->fetch()){
        echo("
            <div class='film'>
            <h2>".$film['titre_film']."</h2>
            <img src='".$film['affiche_film']."' alt='affiche du film' height='200px'>
            <p><strong>Réalisateur: </strong>".$film['realisateur_film']."</p>
            <p><strong>Acteurs principaux: </strong>".$film['acteurs_film']."</p>
            <h5>Date de sortie: ".$film['sortie_film']."</h5>
            <p><strong>Résumé: </strong>".$film['synopsis_film']."</p>
            <a href='modif-film.php/?id=".$film['id_film']."'> Modifier les infos de ce film </a>
            <a href='pret-film.php/?id=".$film['id_film']."'> Enregistrer un prêt </a>
            <a href='supp-film.php/?id=".$film['id_film']."'> Supprimer ce film </a>
            </div>
        ");
    }
    ?>
</body>
</html>