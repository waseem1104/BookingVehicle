<?php
session_start();




$bdd = new PDO('mysql:host=localhost;dbname=bookingcalendar', 'root', 'root');
if (isset($_POST['formconnexion'])) {

  $mail = htmlspecialchars($_POST['mail']);
  $mdp = sha1($_POST['mdp']);

  if (!empty($mail) AND !empty($mdp)) {

    $requser = $bdd ->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
    $requser->execute(array($mail, $mdp));
    $userexist = $requser->rowCount();
    if ($userexist == 1){

      $userinfo = $requser->fetch();
      $_SESSION['id_membre'] = $userinfo['id_membre'];
      $_SESSION['nom'] = $userinfo['nom'];
      $_SESSION['mail'] = $userinfo['mail'];
      header("Location:index.php");

    
    }
    else{
      $mess = "Email ou mot de passe incorrect.";
    }

    
  }
  else{
  	$mess = "Tous les champs doivent être complétés !";
  }

   
 }

?>



<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body class="body_connexion">


	<div class="container">
			<div class="row main">

				<div class="panel-heading">
	               <div class="panel-title text-center">
	               	<p style="text-align: center;"><img src="img/logoicl.png" style="width: 75px;"></p>
	               		<h1 class="title">CONNEXION</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="POST" action="">
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

						<div class="form-group ">
							<button type="submit" name="formconnexion" class="btn btn-primary btn-lg btn-block login-button">Se connecter</button>
						</div>
						<div class="login-register">
						
				         </div>
					</form>


					<?php
					if (isset($mess)) {
						echo $mess;
					}

					?>

				</div>
			</div>
		</div>


</body>
</html>