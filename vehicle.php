<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=bookingcalendar', 'root', 'root');

if ($_SESSION  == null ) {
	header('Location:index.php');
}


if (isset($_POST['formbooking'])) {

$vehicle = $_POST['vehicle'];
$date_debut = $_POST['date'];
$heure_depart = $_POST['time'];
$date_fin = $_POST['date2'];
$heure_arrivee = $_POST['time2'];
	
	if (isset($_POST['vehicle']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['date2']) && isset($_POST['time2'])) {
		
		if (!empty($_POST['vehicle']) AND !empty($_POST['date']) AND !empty($_POST['time']) AND !empty($_POST['date2']) AND !empty($_POST['time2']) ){

			$insertmbr = $bdd -> prepare("INSERT INTO booking(nom , vehicle, date_debut, heure_depart, date_fin, heure_arrivee) VALUES(?, ?, ?, ?, ?, ?)");
			$insertmbr -> execute(array($_SESSION['nom'], $vehicle, $date_debut, $heure_depart, $date_fin, $heure_arrivee));
			$mess = "book !";
						

		}
		else{
			$mess =  "Veuillez remplir tous les champs !";
		}
	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Vehicle</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<a href="index.php"><button class="btn2">< Back</button></a>
<body class="body_vehicle">


<div class="container">
			<div class="row main">

				<div class="panel-heading">
	               <div class="panel-title text-center">
	               <p style="text-align: center;"><a href="index.php"><img src="img/logoicl.png" style="width: 75px;"></a></p>
	               		<h1 class="title">Book your vehicle</h1>
	               		<hr />
	               	</div>
	            </div>
				<div class="main-login main-center">
					<form class="form-horizontal" method="POST" action="">

						<div class="form-group">
							<label for="" class="cols-sm-2 control-label">Choose your vehicle :</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<select name="vehicle" class="select">
										<option value="">Vehicle</option>
										<option value="Audi">Audi</option>
										<option value="Mercedes">Mercedes</option>
										<option value="Nissan">Nissan</option>
										<option value="Ford">Ford</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">

							<label for="" class="cols-sm-2 control-label">To :</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="date" class="form-control" name="date" id="date"  placeholder=""/>
									<input type="time" class="form-control" name="time" id="time"  placeholder=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="cols-sm-2 control-label">From : </label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="date" class="form-control" name="date2" id="date2"  placeholder=""/>
									<input type="time" class="form-control" name="time2" id="time2"  placeholder=""/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							
							<button type="submit" name="formbooking" class="btn btn-primary btn-lg btn-block login-button">Book !</button>
						</div>

				
					</form>

					
				</p>

				</div>
			</div>
		</div>





</body>
</html>