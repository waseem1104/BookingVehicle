<?php
session_start();
?>



<!DOCTYPE html>
<html>
<head>
	<title>Calendar Booking</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="body">

<?php

 if (isset($_SESSION['id_membre'])){

                 echo  "<font color=black style='font-size:25px; float:right;'>".'Welcome ' . $_SESSION['nom'] . ' !' . '</font><form action="deconnexion.php" method="POST" style="border:none;" ><button type="submit" name="submit" class="logout" style="border:none; background:none; cursor:pointer;font-size:14px; text-decoration:underline;" >Logout </button><a href="viewbooking.php" style="color:black; text-decoration:underline;font-size:14px;">View your booking</a></form>';


          }else{
 ?>
		<div id="section1">
			<a class="link" href="inscription.php"><button class="btn_inscription col-md-12 col-sm-12 ">Sign Up</button></a>
			<a class="link" href="connexion.php"><button class="btn_connexion col-md-12 col-sm-12 ">Connexion</button></a>


		</div>

<?php } ?>

	
<div class="title">
	<h1>Booking Vehicle</h1>
</div>

	<p style="text-align: center;"><img src="img/logoicl.png" style="width: 75px;"></p>

<?php
if (isset($_SESSION['id_membre'])){
?>

<div id="section2">
		<a class="link" href="vehicle.php"><button class="btn1">Booking</button></a>
		<a class="link" href="calendar.php"><button class="btn1"> View Calendar</button></a>

</div>

<?php 

}else{

?>
<h2 style="text-align: center;">Subscribe to book your vehicle !</h2>
<div id="section2">
		<a class="link" href="calendar.php"><button class="btn1"> View Calendar</button></a>

</div>
<?php
}?>
</body>
</html>