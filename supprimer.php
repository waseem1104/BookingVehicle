<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=bookingcalendar', 'root', 'root');

	

$delete = $bdd->prepare("DELETE FROM booking WHERE id_booking = ?");

$delete->execute(array($_GET['id']));

header('Location:index.php');





?>