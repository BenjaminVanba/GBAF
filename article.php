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
	      $titre = $article['acteur'];
	      $contenu = $article['description'];
		  $picture = $article['logo'];
	      $likes = $bdd->prepare('SELECT id FROM likes WHERE id_acteur = ?');
	      $likes->execute(array($id));
	      $likes = $likes->rowCount();
	      $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_acteur = ?');
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
	<html lang="fr">
		<head>
			<title>Articles</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
		</head>
		<body>
			<?php include("header.php"); ?>
			<img src="<?= $picture ?> " class="imgArticle" alt="">
			<div class="articles">
				<h1><?= $titre ?></h1><br>
				<p><?= $contenu ?></p>
			</div>
			<div class= "like">
				<a href="action.php?t=1&id=<?= $id ?>"><img src="IMG/ThumbsUp.png" alt="ThumbsUp" class="Thumbs"></a>(<?= $likes ?>)
				<a href="action.php?t=2&id=<?= $id ?>"><img src="IMG/ThumbsDown.png" alt="ThumbsDown" class="Thumbs"></a>(<?= $dislikes ?>)
			</div>
			<?php include("footer.php"); ?>
		</body>
	</html>
	
	<?php
	// Section commentaire 
	if(isset($_GET['id']) AND !empty($_GET['id'])) {
	   $getid = htmlspecialchars($_GET['id']);
	   $article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
	   $article->execute(array($getid));
	   $article = $article->fetch();
	   if(isset($_POST['submit_commentaire'])) {
	      if(isset($_POST['post']) AND !empty($_POST['post'])) {
	         $pseudo = $_SESSION['name'];
	         $commentaire = htmlspecialchars($_POST['post']);
	            $ins = $bdd->prepare('INSERT INTO commentaires (id_user, post, id_acteur) VALUES (?,?,?)');
	            $ins->execute(array($pseudo,$commentaire,$getid));
	            $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";
	      } else {
	         $c_msg = "Erreur: Tous les champs doivent être complétés";
	      }
	   }
	   $commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_acteur = ? ORDER BY id DESC');
	   $commentaires->execute(array($getid));
	?>
	<?php 
	$username = $_SESSION['name'];
	$showcomment = $bdd->prepare("SELECT count(*) FROM commentaires WHERE id_acteur = ? AND id_user='$username' ");
	$showcomment->execute([$id]);
	$count = $showcomment->fetchColumn();
	if($count<1){
		?> 
	<div class="Comm">
		<form method="POST">
			<textarea name="post" placeholder="Nouveau commentaire"></textarea><br>
			<input type="submit" value="Poster mon commentaire" name="submit_commentaire">
		</form>
	</div>
	<?php } ?>
	<?php 
	$NombreCommentaire = $bdd->prepare("SELECT count(*) FROM commentaires WHERE id_acteur = ?");
	$NombreCommentaire->execute([$id]);
	$count = $NombreCommentaire->fetchColumn();
	echo "<p class='NbrComm'> $count Commentaire(s)</p>"; 
	?> 
	<div class= "articles">
		<?php if(isset($c_msg)) { echo $c_msg; } ?>
		<br><br>
		<?php while($c = $commentaires->fetch()) { ?>
		<div class="cadre articles"><b><?= $c['id_user'] ?></b><br><i><?= $c['date_add'] ?></i><br><br><?= $c['post'] ?><br /></div>
		<?php } ?>
	</div>
	<?php
	}
	?>
