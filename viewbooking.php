<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=bookingcalendar', 'root', 'root');

if ($_SESSION['id_membre'] == null ) {
	header('Location:index.php');
}

$name = $_SESSION['nom'];

$rec = $bdd->prepare("SELECT id_booking, nom, vehicle , date_debut , heure_depart , date_fin , heure_arrivee FROM booking WHERE nom = ? ");
$rec->execute(array($name));




?>

<!DOCTYPE html>
<html>
<head>
	<title>Viewyourbooking</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body >
	<?php

 if (isset($_SESSION['id_membre'])){

                 echo '<form action="deconnexion.php" method="POST" style="border:none;" ><button type="submit" name="submit" class="logout" style="border:none; background:none; cursor:pointer;font-size:14px; text-decoration:underline;" >Logout </button></form>';


          }

          ?>

<p style="text-align: center;"><img src="img/logoicl.png" style="width: 75px;"></p>	
<div class="title_booking">
	<h1 style="text-transform: uppercase;">Your Booking</h1>
</div>


<?php

while ($afficher = $rec->fetch()) {

	

	?>

	<div class="col-md-8 offset-2" style="
 
    
    padding: 25px;
    margin-bottom: 50px;
    box-shadow: 11px;
   background: #81a9da;
   border:1px solid black;
};">
  <div id="postlist">
    <div class="panel">
      <div class="panel-heading">
        <div class="text-center">
          <div class="row">
            <div class="panel-body" style="width:100%;">

<div class="col-sm-12">
 <p><?php echo 'Name : '.$afficher['nom']; ?></p>
  <p><?php echo 'Vehicle : '.$afficher['vehicle']; ?></p>
   
    </div>
   
      <p><small><?php echo ' Date début  : ' .$afficher['date_debut'] . ' ' . 'Heure départ : ' . $afficher['heure_depart']; ?></small></p>
      <p><small><?php echo ' Date fin  : ' .$afficher['date_fin'] . ' ' . "Heure d'arrivée : " . $afficher['heure_arrivee']; ?></small></p>

    
      <a href="supprimer.php?id=<?php echo $afficher['id_booking'];?>">Delete</a>


      </form>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



	<?php

}


?>

</body>
</html>