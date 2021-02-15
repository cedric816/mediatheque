<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un film</title>
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

        if (isset($_POST['titre'])){
            $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
    
            $titre_film = htmlspecialchars($_POST['titre']);
            $sortie_film = htmlspecialchars($_POST['sortie']);
            $realisateur_film = htmlspecialchars($_POST['realisateur']);
            $acteurs_film = htmlspecialchars($_POST['acteurs']);
            $synopsis_film = htmlspecialchars($_POST['resume']);
            $affiche_film = htmlspecialchars($_POST['affiche']);
    
            $requete = "INSERT INTO `films` 
                            (`titre_film`,
                            `sortie_film`,
                            `realisateur_film`,
                            `acteurs_film`,
                            `synopsis_film`,
                            `affiche_film`)
                            VALUES (:titre_film, :sortie_film, :realisateur_film, :acteurs_film, :synopsis_film, :affiche_film)";
            $prepare = $connexion->prepare($requete);
            $prepare->execute(array(
                "titre_film"=> $titre_film,
                "sortie_film"=> $sortie_film,
                "realisateur_film"=> $realisateur_film,
                "acteurs_film"=> $acteurs_film,
                "synopsis_film"=> $synopsis_film,
                "affiche_film"=> $affiche_film
            ));
    
            echo ("
            <p>film enregistré</p>
            <a class='lien-simple' href='index.php'>Retour à l'accueil</a>
            ");
        } else {
            echo("
            <h1>Renseigner toutes les infos et cliquer sur Valider</h1>
        <div class='film'>
        <form method='POST' action='ajout-film.php'>
        <label for='titre'>Titre:</label>
        <input type='text' id='titre' name='titre' required>
        <label for='affiche'>URL de l'affiche du film:</label>
        <input type='text' id='affiche' name='affiche' required>
        <label for='sortie'>Date de sortie:</label>
        <input type='date' id='sortie' name='sortie' required>
        <label for='realisateur'>Réalisateur:</label>
        <input type='text' id='realisateur' name='realisateur' required>
        <label for='acteurs'>Acteurs:</label>
        <textarea id='acteurs' name='acteurs' rows='3' required></textarea>
        <label for='resume'>Résumé:</label>
        <textarea id='resume' name='resume' rows='7' required></textarea>
        <input type='submit' value='Valider'>
        <a href='index.php'>NON, retour à l'accueil</a>
        </form>
        </div>
            ");
        }
    ?>
</body>
</html>