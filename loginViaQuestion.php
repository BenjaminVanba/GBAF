<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Question Secrete</title>
        <link href="style.css" rel="stylesheet" type="text/css">
		<img src="logoGBAF.jpg" class="img5">
	</head>
	<body>
		<div class="login">
			<h1>Mot de passe oublié ? Connectez-vous avec votre question secrète</h1>
			<form action="authoQuestion.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Nom d'utilisateur" id="username" required>
				<div class= "test55">
				<label for="Question">Selectionnez votre question secrete</label>
				<i class=""></i>
				<select name="Question">
					<option value="Votre surnom etant enfant">Votre surnom etant enfant</option>
					<option value="Nom de jeune fille de votre mere">Nom de jeune fille de votre mere</option>
				</select>
				</div>
				<label for="Reponse">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="Reponse" placeholder="Reponse" id="Reponse" required>
				<input type="submit" value="Valider">
			</form>
		</div>
		<p class="centre">Pas de compte ? <a href="register.php">Créez-en un ici </a></p>
	</body>
</html>