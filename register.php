<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'phplogin';
$error = [];
$show_error = false ;
$user = "";
$mdp = "";
$mail = "";
$Question = "";
$Reponse = "";


// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
//if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	//exit('Failed to connect to MySQL: ' . mysqli_connect_error());
//}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!empty($_POST)) {
	
	foreach($_POST as $key => $value){
		$post[$key]= htmlspecialchars($value);
	}
	
	// Could not get the data that should have been sent.
	if (strlen($post['password']) > 20 || strlen($post['password']) < 5) {
		$error[] = 'Le mot de passe doit contenir entre 5 et 20 caractères';
	}
	if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
		$error[] = 'Email is not valid!';
	}
	if (strlen($post['username']) > 20 || strlen($post['username']) < 5) {
		$error[] = 'le nom d\'utilisateur doit contenir entre 5 et 20 caractères';
	}
	if (!isset($post['Question'])){
		$error[]='Veuillez choisir une question secrete ';
	}
	if (!isset($post['Reponse'])){
		$error[]='Veuillez choisir une reponse a votre question secrete ';
	}


if (count($error)>0){
$show_error = true ;
$user = $post["username"];
$mdp = $post["password"];
$mail = $post["email"];

} 
else{// We need to check if the account with that username exists.
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
		// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
		$stmt->bind_param('s', $post['username']);
		$stmt->execute();
		$stmt->store_result();
		// Store the result so we can check if the account exists in the database.
		if ($stmt->num_rows > 0) {
			// Username already exists
			echo "<p class='stylephp'>Utilisateur déjà existant.</p>";
		} else {
			// Username doesnt exists, insert new account
	if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email,Question, Reponse ) VALUES (?, ?, ?, ?, ?)')) {
		// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
		$password = password_hash($post['password'], PASSWORD_DEFAULT);
		$reponse = password_hash($post['Reponse'], PASSWORD_DEFAULT);
		$stmt->bind_param('sssss', $post['username'], $password, $post['email'], $post['Question']);
		$stmt->execute();
		echo "<p class='stylephp'>Enregistrement réussi , vous pouvez vous connecter.</p>";
	} else {
		// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
		echo 'Could not prepare statement!';
	}
		}
		$stmt->close();
	} else {
		// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
		echo 'Could not prepare statement!';
	}
	$con->close();
}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Inscription</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<img src="logoGBAF.jpg" class="img5">
	</head>
	<body>
		<div class="register">
			<h1>Inscription</h1>
			<?php foreach($error as $err):?>
			<span> <?=$err ; ?> </span>
			<?php endforeach; ?>
			<form method="post" autocomplete="off">
				<label for="username">
					<i class=""></i>
				</label>
				<input type="text" name="username" placeholder="Nom d'utilisateur" value="<?=$user;?>" id="username" required>
				<label for="password">
					<i class=""></i>
				</label>
				<input type="password" name="password" placeholder="Mot de passe" value="<?=$mdp;?>" id="password" required>
				<label for="email">
					<i class=""></i>
				</label>
				<input type="email" name="email" placeholder="Email" value="<?=$mail;?>" id="email" required>
				<div class= "test55">
				<label for="Question">Selectionnez une question secrete</label>
				<i class=""></i>
				<select name="Question">
					<option value="Votre surnom etant enfant">Votre surnom etant enfant</option>
					<option value="Nom de jeune fille de votre mere">Nom de jeune fille de votre mere</option>
				</select>
				</div>
				<label for="Reponse">
					<i class=""></i>
				</label>
				<input type="text" name="Reponse" placeholder="Reponse a la question secrete" id="Reponse" required>
				
				<input type="submit" value="Valider">
			</form>
		</div>
		<p class="centre">Vous avez déjà un compte ? <a href="index.html">Connectez-vous ici ! </a></p>
		<footer class="main_footer center_text ptb_2">
			<div class="container">
			<p><a href="Mention.php">Mention légale</a></p>
			<p><a href="Contact.php"> Contact</a></p>
		</div>
		
		</footer>
	</body>
</html>