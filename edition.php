	<?php
	session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }
	$bdd = new PDO('mysql:host=localhost;dbname=phplogin', 'root', 'root');
	 
	if(isset($_SESSION['id'])) {
	   $requser = $bdd->prepare("SELECT * FROM accounts WHERE id = ?");
	   $requser->execute(array($_SESSION['id']));
	   $user = $requser->fetch();
	   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['username']) {
	      $newpseudo = htmlspecialchars($_POST['newpseudo']);
	      $insertpseudo = $bdd->prepare("UPDATE accounts SET username = ? WHERE id = ?");
	      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
	      header('Location: index.html');
	   }
	   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
	      $newmail = htmlspecialchars($_POST['newmail']);
	      $insertmail = $bdd->prepare("UPDATE accounts SET email = ? WHERE id = ?");
	      $insertmail->execute(array($newmail, $_SESSION['id']));
	      header('Location: index.html');
	   }
	   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
	      $mdp1 = ($_POST['newmdp1']);
	      $mdp2 = ($_POST['newmdp2']);
	      if($mdp1 == $mdp2) {
			$mdp1 = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
	         $insertmdp = $bdd->prepare("UPDATE accounts SET password = ? WHERE id = ?");
	         $insertmdp->execute(array($mdp1, $_SESSION['id']));
	         header('Location: home.php');
	      } else {
	         $msg = "Vos deux mdp ne correspondent pas !";
	      }
	   }
	?>
	<html>
	   <head>
	      <title>Edition profil</title>
	      <meta charset="utf-8">
          <?php include("header.php"); ?>
		  <?php include("footer.php"); ?>
	   </head>
	   <body>
	      <div align="center">
	         <h2>Edition de mon profil</h2>
	         <div align="left">
	            <form method="POST" action="" enctype="multipart/form-data">
	               <label>Pseudo :</label>
	               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['username']; ?>" /><br /><br />
	               <label>Mail :</label>
	               <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['email']; ?>" /><br /><br />
	               <label>Mot de passe :</label>
	               <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
	               <label>Confirmation - mot de passe :</label>
	               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
	               <input type="submit" value="Mettre à jour mon profil !" />
	            </form>
	            <?php if(isset($msg)) { echo $msg; } ?>
	         </div>
	      </div>
	   </body>
	</html>
	<?php   
	}
	else {
	   header("Location: index.html");
	}
	?>
