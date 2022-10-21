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
<html lang="fr">
	<head>
    <title>Accueil</title>
		<meta charset="utf-8">
		<link href="Style/styleHome.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
  <body>
    <?php include("header.php"); ?>
    <h1 class="center"> <u>Qui sommes nous ?</u></h1>
    <div class="center">
      <br><p> Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :<p>
        <ul class="center">
          <li>BNP Paribas</li>
          <li>BPCE</li>
          <li>Crédit Agricole</li>
          <li>Crédit Mutuel-CIC</li>
          <li>Société Générale</li>
          <li>La banque Postale</li>
        </ul>
    </div>
      <img src="IMG/Landscape.jpeg" class="img2" alt="">
      <table style="width:50%">
      <tr class="center">
        <th>
          <div class="container">
            <img src="IMG/CDE.png" class="imageTabl" alt="">
            <div class ="texttabl">
              <h3 class="titretabl">Chambre Des Entrepreneurs</h3>
              <p> La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation... </p>
            </div>
          </div>
          <a href="article.php?id=4" class="button">Lire la suite</a>
        </th>
      </tr>
      <tr>
        <th> 
          <div class="container">
            <img src="IMG/Dsa_france.png" class="imageTabl" alt="">
            <div class ="texttabl">
              <h3 class="titretabl">DSA France</h3>
              <p> Dsa France Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales... </p>
            </div>
          </div>
          <a href="article.php?id=3" class="button">Lire la suite</a>
        </th>
      </tr>
      <tr>
        <th>
          <div class="container">
            <img src="IMG/protectpeople.png" class="imageTabl" alt="">
            <div class="texttabl">
              <h3 class="titretabl">Protectpeople</h3>
              <p> Protectpeople finance la solidarité nationale. Nous appliquons le principe édifié par ... </p>
            </div>
          </div>
          <a href="article.php?id=2" class="button">Lire la suite</a>
        </th>
      </tr>
      <tr>
        <th>
          <div class="container">
            <img src="IMG/formation_co.png" class="imageTabl" alt="">
            <div class="texttabl">
              <h3 class="titretabl">Formation & co </h3>
              <p>Formation&co Formation&co est une association française présente sur tout le territoire ...</p>
            </div>
          </div>
          <a href="article.php?id=1" class="button">Lire la suite</a>
        </th>
      </tr>
    </table>
    <?php include("footer.php"); ?>   
</body>
</html>
