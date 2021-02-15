<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunt de film</title>
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
        input, textarea, select{
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
    $film_id='';
    if (is_numeric($_GET['id'])){
        $id_film = htmlspecialchars($_GET['id']);
        $film_id=$id_film;
        $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);

        //récupérer les infos du film
        $requete = "SELECT * FROM `films` WHERE `id_film`=:id_film";
        $prepare = $connexion->prepare($requete);
        $prepare->execute(array(
            "id_film"=> $id_film
        ));
        $prepare = $prepare->fetch();

        echo("
        <h1>Emprunt de ".$prepare['titre_film']."</h1>
        <form method='POST' >
        <label for='debut'>Date de début</label>
        <input type='date' id='debut' name='debut' required>
        <label for='fin'>Date de fin</label>
        <input type='date' id='fin' name='fin' required>
        <label for='abonne'>Emprunteur:</label>
        <select id='abonne' name='abonne'>
        ");

        $requete2 = "SELECT * FROM `abonnes`";
        $prepare2 = $connexion->prepare($requete2);
        $prepare2 -> execute();

        while ($abonne = $prepare2->fetch()){
            echo("<option value='".$abonne['id_abonne']."'>".$abonne['nom_abonne']."</option>
        ");
        }
        
        echo("<input type='submit' value='valider le prêt'></select></form>");
        echo("<a href='../index.php'>NON, retour à l'accueil</a>");

    if (isset($_POST['abonne'])){
        $debut_emprunt = htmlspecialchars($_POST['debut']);
        $fin_emprunt = htmlspecialchars($_POST['fin']);
        $abonne_id = htmlspecialchars($_POST['abonne']);

        $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
        $requete3 = "INSERT INTO `emprunts`(`debut_emprunt`, `fin_emprunt`, `film_id`, `abonne_id`)
                        VALUES(:debut_emprunt, :fin_emprunt, :film_id, :abonne_id)";
        $prepare3 = $connexion->prepare($requete3);
        $prepare3 -> execute(array(
            "debut_emprunt"=> $debut_emprunt,
            "fin_emprunt"=> $fin_emprunt,
            "film_id"=> $film_id,
            "abonne_id"=> $abonne_id
        ));
        echo ("
            <p>emprunt enregistré</p>
            <a class='lien-simple' href='../index.php'>Retour à l'accueil</a>
            ");
    }
    }
?>
</body>
</html>

