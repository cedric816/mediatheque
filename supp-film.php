<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un film</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1{
            border: solid black 2px;
            padding: 20px;
        }
        .film{
            width: 50%;
            border-bottom: solid black 2px;
        }
        form{
            display: flex;
            flex-direction: column;
        }
        input, textarea{
            margin-bottom: 20px;
        }
        label{
            font-weight: bold;
        }
        a{
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            width: 200px;
            padding-left: 20px;
            padding-right: 20px;
        }
        .lien-simple{
            border: none;
            padding: 0px;
            width: auto;
            font-size: 28px;
            background-color: grey;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<?php
include ('config-bdd.php');

if (isset($_GET['id']) and is_numeric($_GET['id'])){
    
    $id_film = htmlspecialchars($_GET['id']);
    $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);

    //récupérer les infos du film
    $requete = "SELECT * FROM `films` WHERE `id_film`=:id_film";
    $prepare = $connexion->prepare($requete);
    $prepare->execute(array(
        "id_film"=> $id_film
    ));
    $prepare = $prepare->fetch();

    echo("
        <h1>Etes-vous sûr de vouloir supprimer ce film définitivement?</h1>
        <div class='film'>
        <form method='POST' action='modif-film.php'>
        <label for='titre'>Titre:</label>
        <input type='text' id='titre' name='titre' value='".$prepare['titre_film']."' required>
        <label for='sortie'>Date de sortie:</label>
        <input type='date' id='sortie' name='sortie' value='".$prepare['sortie_film']."' required>
        <label for='realisateur'>Réalisateur:</label>
        <input type='text' id='realisateur' name='realisateur' value='".$prepare['realisateur_film']."' required>
        <label for='acteurs'>Acteurs:</label>
        <textarea id='acteurs' name='acteurs' rows='3' required>".$prepare['acteurs_film']."</textarea>
        <label for='resume'>Résumé:</label>
        <textarea id='resume' name='resume' rows='7' required>".$prepare['synopsis_film']."</textarea>
        <input type='hidden' name='id_film' value='".$prepare['id_film']."'>
        <input type='submit' value='OUI supprimer'>
        <a href='../index.php'>NON, retour à l'accueil</a>
        </form>
        </div>
    ");
}

if (isset($_POST['titre'])){
    $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
    $id_film = htmlspecialchars($_POST['id_film']);

    $requete = "DELETE FROM `films` WHERE `id_film`=:id_film";
    $prepare = $connexion->prepare($requete);
    $prepare->execute(array(
        "id_film"=> $id_film,
    ));

    echo ("
    <p>film supprimé</p>
    <a class='lien-simple' href='../index.php'>Retour à l'accueil</a>
    ");
}
?>
</body>
</html>