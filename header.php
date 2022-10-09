<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">

		<link href="styleHome.css" rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=device-width, initial-scale=1">

		<a href="home.php">
			<img src="logoGBAF.jpg" alt="LogoGBAF" class="img3">
		</a> 
		
		<hr class="solid">
		<div class ="topright"> 

<p><b><?=$_SESSION['name']?></b></p>
   <p>Vous êtes bien connecté.</p>
   <p><a href="logout.php">Se déconnecter</a></p>
   <p style="font-size:12px"><a href="edition.php">editer mon profil</a></p>
</div> 
	</head>

	