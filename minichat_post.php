<?php
session_start();

// Effectuer ici la requête qui insère le message
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// On définit les variables
$pseudo = $_POST['pseudo'];
$message = $_POST['message'];

// On ajoute une entrée dans la table chat
$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(:pseudo, :message)');
$req->execute(array(
	'pseudo' => $pseudo,
	'message' => $message
    ));
    
// Sauvegarde du pseudo du visiteur
$_SESSION['pseudo'] = $pseudo;

// Redirection vers minichat.php
header('Location: minichat.php');

?>

