<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
	$bdd = new PDO("mysql:host=127.0.0.1;dbname=phplogin;charset=utf8", "root", "root");
	if(isset($_GET['id']) AND !empty($_GET['id'])) {
	   $get_id = htmlspecialchars($_GET['id']);
	   $article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
	   $article->execute(array($get_id));
	   if($article->rowCount() == 1) {
	      $article = $article->fetch();
	      $id = $article['id'];
	      $titre = $article['titre'];
	      $contenu = $article['contenu'];
		  $picture = $article['image'];
	      $likes = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
	      $likes->execute(array($id));
	      $likes = $likes->rowCount();
	      $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
	      $dislikes->execute(array($id));
	      $dislikes = $dislikes->rowCount();
	   } else {
	      die('Cet article n\'existe pas !');
	   }
	} else {
	   die('Erreur');
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
    <?php include("header.php"); ?>
	   <title>Accueil</title>
	   <meta charset="utf-8">
	</head>
	<body>
		<div class="articles">
			<img src="<?= $picture ?> " alt="">
	   <h1><?= $titre ?></h1><br>
	   <p><?= $contenu ?></p>
	   </div>
	   <a href="action.php?t=1&id=<?= $id ?>">J'aime</a> (<?= $likes ?>)
	   <br />
	   <a href="action.php?t=2&id=<?= $id ?>">Je n'aime pas</a> (<?= $dislikes ?>) 
	</body>
	</html>
	
	<meta charset="utf-8" />
	
	<?php
	// Section commentaire 
	
	if(isset($_GET['id']) AND !empty($_GET['id'])) {
	   $getid = htmlspecialchars($_GET['id']);
	   $article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
	   $article->execute(array($getid));
	   $article = $article->fetch();
	   if(isset($_POST['submit_commentaire'])) {
	      if(isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {
	         $pseudo = $_SESSION['name'];
	         $commentaire = htmlspecialchars($_POST['commentaire']);
	            $ins = $bdd->prepare('INSERT INTO commentaires (pseudo, commentaire, id_article) VALUES (?,?,?)');
	            $ins->execute(array($pseudo,$commentaire,$getid));
	            $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";
	      } else {
	         $c_msg = "Erreur: Tous les champs doivent être complétés";
	      }
	   }
	   $commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_article = ? ORDER BY id DESC');
	   $commentaires->execute(array($getid));
	?>
	<?php 
	$username = $_SESSION['name'];
	$showcomment = $bdd->prepare("SELECT count(*) FROM commentaires WHERE id_article = ? AND pseudo='$username' ");
	$showcomment->execute([$id]);
	$count = $showcomment->fetchColumn();
	echo $count;
	if($count<1){
	

	 ?> 
	<br />
	<h2>Commentaires:</h2>
	<form method="POST">
	<b><?=$_SESSION['name']?></b><br />
	   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
	   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
	</form><?php } ?>



	
	<?php if(isset($c_msg)) { echo $c_msg; } ?>
	<br /><br />
	<?php while($c = $commentaires->fetch()) { ?>
	   <?= $c['date'] ?><b>:<?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?><br />
	   <?php } ?>
	<?php
	}
	?>
    