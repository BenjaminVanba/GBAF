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
		<title>Accueil</title>
	<?php include("header.php"); ?>
  <?php include("footer.php"); ?>
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
  <br>
  <table style="width:50%">
  <tr class="center">
    <th>
    <img src="CDE.png" class="imageTabl" alt="">
      La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation...
      <p><a href="article.php?id=4">Lire la suite</a></p>
    </th>
    
  </tr>
  <tr>
    <th> 
      <img src="Dsa_france.png" class="imageTabl" alt="">
    Dsa France Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales...
      <p><a href="article.php?id=3">Lire la suite</a></p>
    </th>
  </tr>
  <tr>
    <th> 
      <img src="protectpeople.png" class="imageTabl" alt="">
    Protectpeople finance la solidarité nationale. Nous appliquons le principe édifié par ...
      <p><a href="article.php?id=2">Lire la suite</a></p>
    </th>
  </tr>
  <tr>
    <th>
    <img src="formation_co.png" class="imageTabl" alt="">
Formation&co Formation&co est une association française présente sur tout le territoire ...
      <p><a href="article.php?id=1">Lire la suite</a></p>
    </th>
  </tr>
</table>
        
</body>

</html>
