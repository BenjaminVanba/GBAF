<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
	$bdd = new PDO("mysql:host=127.0.0.1;dbname=phplogin;charset=utf8", "root", "root");
	if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])) {
	   $getid = (int) $_GET['id'];
	   $gett = (int) $_GET['t'];
	   $sessionid = $_SESSION['id'];
	   $check = $bdd->prepare('SELECT id FROM articles WHERE id = ?');
	   $check->execute(array($getid));
	   if($check->rowCount() == 1) {
	      if($gett == 1) {
	         $check_like = $bdd->prepare('SELECT id FROM likes WHERE id_acteur = ? AND id_user = ?');
	         $check_like->execute(array($getid,$sessionid));
	         $del = $bdd->prepare('DELETE FROM dislikes WHERE id_acteur = ? AND id_user = ?');
	         $del->execute(array($getid,$sessionid));
	         if($check_like->rowCount() == 1) {
	            $del = $bdd->prepare('DELETE FROM likes WHERE id_acteur = ? AND id_user = ?');
	            $del->execute(array($getid,$sessionid));
	         } else {
	            $ins = $bdd->prepare('INSERT INTO likes (id_acteur, id_user) VALUES (?, ?)');
	            $ins->execute(array($getid, $sessionid));
	         }
	         
	      } elseif($gett == 2) {
	         $check_like = $bdd->prepare('SELECT id FROM dislikes WHERE id_acteur = ? AND id_user = ?');
	         $check_like->execute(array($getid,$sessionid));
	         $del = $bdd->prepare('DELETE FROM likes WHERE id_acteur = ? AND id_user = ?');
	         $del->execute(array($getid,$sessionid));
	         if($check_like->rowCount() == 1) {
	            $del = $bdd->prepare('DELETE FROM dislikes WHERE id_acteur = ? AND id_user = ?');
	            $del->execute(array($getid,$sessionid));
	         } else {
	            $ins = $bdd->prepare('INSERT INTO dislikes (id_acteur, id_user) VALUES (?, ?)');
	            $ins->execute(array($getid, $sessionid));
	         }
	      }
	      header('Location: article.php?id='.$getid);
	   } else {
	      exit('Erreur fatale. <a href="home.php">Revenir à l\'accueil</a>');
	   }
	} else {
	   exit('Erreur fatale. <a href="home.php">Revenir à l\'accueil</a>');
	}