<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$bdd = new PDO("mysql:host=localhost;dbname=phplogin;charset=utf8", "root", "root");
$articles = $bdd->query('SELECT * FROM articles ORDER BY id DESC');

?>
<!DOCTYPE html>

<html>
	<head>
		
	<?php include("header.php"); ?>

	</head>

	
<body>

	<br><h1 class="center"> <u>Qui sommes nous ?</u></h1>

<div class="center">
	<br><p> Le Groupement Banque Assurance Français (GBAF) est une fédération
  représentant les 6 grands groupes français :<p>
  <ul class="center">
    <li>BNP Paribas</li>
    <li>BPCE</li>
    <li>Crédit Agricole</li>
    <li>Crédit Mutuel-CIC</li>
    <li>Société Générale</li>
    <li>La banque Postale</li><br><br>
  </ul>

</div>

  <img src="Landscape.jpeg" class="img2" alt=""><br><br>
  
  <hr class="center">
    <div class="center">
<ul>
	      <?php while($a = $articles->fetch()) { ?>
	      <li><a href="article.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a></li>
	      <?php } ?>
	   <ul>
        </div>
        <p><a href="edition.php">edition</a></p>
</body>

</html>