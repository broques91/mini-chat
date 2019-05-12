<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Mini-chat en PHP</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
   <body>

   <h1>Mon premier mini-chat</h1>

   <form action="minichat_post.php" method="post">
        Pseudo: <br>
        <input type="text" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo'] ?>">
        <p>
        Votre message: <br>
        <textarea rows="10" cols="50" name="message" id="message"></textarea>
        </p>
        <input type="submit" value="Envoyer">
    </form>


    <?php
    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    // Récupération des 10 derniers messages
    $reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');

    // Affichage de chaque message avec protection des données par htmlspecialchars
    while ($donnees = $reponse->fetch())
    {
        echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
    }

    $reponse->closeCursor();

    ?>
    </body>
</html>
