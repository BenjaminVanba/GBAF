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
	<!-- Système de like --> 
	<!DOCTYPE html>
	<html>
	<head>
	<link href="styleHome.css" rel="stylesheet" type="text/css">
	   <title>Articles</title>
	   <meta charset="utf-8">
	</head>
	<body>
	<?php include("header.php"); ?>
	<img src="<?= $picture ?> " class="imageTabl" alt="">
		<div class="articles">
	   <h1><?= $titre ?></h1><br>
	   <p><?= $contenu ?></p>
	   </div>
	   <div class= "articles">
	   <a href="action.php?t=1&id=<?= $id ?>">J'aime</a> (<?= $likes ?>)
	   <br />
	   <a href="action.php?t=2&id=<?= $id ?>">Je n'aime pas</a> (<?= $dislikes ?>)
	</div>
	<?php include("footer.php"); ?>
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
	if($count<1){
	

	 ?> 
	<br />
	<div class="articles">
	<h2>Commentaires:</h2>
	<form method="POST">
	<b><?=$_SESSION['name']?></b><br />
	   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
	   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
	   </div>
	</form><?php } ?>
	


	<div class= "articles">

	<?php if(isset($c_msg)) { echo $c_msg; } ?>
	<br /><br />
	<?php while($c = $commentaires->fetch()) { ?>
		<div class="cadre articles"><b><?= $c['pseudo'] ?></b><br><i><?= $c['date'] ?></i><br><br><?= $c['commentaire'] ?><br /></div>
	   <?php } ?>
	</div>
	<?php
	}
	?>
