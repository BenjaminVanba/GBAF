<!DOCTYPE html>
<html lang="fr">
	<head>
		<link href="Style/styleHome.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" media="screen and (max-width: 1280px)" href="Style/smallres.css">
		<meta charset="UTF-8">
		<title>Header</title>
	</head>
	<body>
		<header>
			<div class="test shadow">
				<a href="home.php">
					<img src="IMG/logoGBAF.jpg" alt="LogoGBAF" class="img3">
				</a> 
				<div class ="topright test2"> 
					<p><b><?=$_SESSION['name']?></b></p>
					<p>Vous êtes bien connecté.</p>
					<p><a href="logout.php">Se déconnecter</a></p>
					<p style="font-size:12px"><a href="edition.php">editer mon profil</a></p>
				</div>
			</div>
		</header>
	</body>
</html>
			
	
	