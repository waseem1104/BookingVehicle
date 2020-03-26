<?php

$bdd = new PDO('mysql:host=localhost;dbname=bookingcalendar', 'root', 'root');


if (isset($_POST['forminscription'])){


$pseudo = htmlspecialchars($_POST['pseudo']);
$mail = htmlspecialchars($_POST['mail']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);


	if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['mdp2'])) {

		if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){

			if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				$reqmail = $bdd ->prepare("SELECT * FROM membres WHERE mail = ?");
				$reqmail->execute(array($mail));
				$mailexist = $reqmail->rowCount();
					
				if ($mailexist == 0) {

					if ($mdp == $mdp2) {

						$insertmbr = $bdd -> prepare("INSERT INTO membres(nom, mail, motdepasse) VALUES(?, ?, ?)");
						$insertmbr -> execute(array($pseudo, $mail, $mdp));
						$erreur = "Votre compte a bien été crée !";
						
					}
					else{
						$erreur = " Vos mots de passes ne correspondent pas.";
					}

				}
				else{
					$erreur= "Adresse mail déjà utilisés.";
				}
			}
			else{
				$erreur = " Votre adresse mail n'est pas valide.";
			}
	
		}
  		else{
 			$erreur = "Tous les champs doivent être complétés !";
  		}
	}
}






?>





<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body class="body_inscription">
<div class="container">
			<div class="row main">

				<div class="panel-heading">
	               <div class="panel-title text-center">
	               <p style="text-align: center;" ><img src="img/logoicl.png" style="width: 75px;"></p>
	               		<h1 class="title">INSCRIPTION</h1>
	               		<hr />
	               	</div>
	            </div>
				<div class="main-login main-center">
					<form class="form-horizontal" method="POST" action="">

						<div class="form-group">
							<label for="pseudo" class="cols-sm-2 control-label">Pseudo :</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="pseudo" id="pseudo"  placeholder="Entrez votre pseudo"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="mail" class="cols-sm-2 control-label">Email :</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="mail" id="mail"  placeholder="Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="mdp" class="cols-sm-2 control-label">Mot de passe :</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="mdp" id="mdp"  placeholder="Mot de passe"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="mdp" class="cols-sm-2 control-label">Confirmation du mot de passe :</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="mdp2" id="mdp2"  placeholder="Confirmez votre mot de passe"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<p id="condition">En vous inscrivant, vous acceptez <a href="#">les conditions générales d'utilisation.</a></p>
							<button type="submit" name="forminscription" class="btn btn-primary btn-lg btn-block login-button">S'inscrire</button>
						</div>

						<div class="login-register">

				            <p>Vous êtes déjà membres ?<a class="CO" href="connexion.php"> Connectez-vous !</a></p>
				         </div>
					</form>

					<?php

					if (isset($erreur)){
						
					?>
					
					<p style="text-align: center; color: #ffffff;">
					<?php	 
					echo $erreur;
				}

					?>
				</p>

				</div>
			</div>
		</div>



</body>
</html>