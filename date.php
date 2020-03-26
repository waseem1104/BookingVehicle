<?php

 class Date
 {
 	var $days = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
 	var $months = array('Janvier' , 'Fevrier' , 'Mars' , 'Avril' , 'Mai', 'Juin' , 'Juillet' , 'Aout', 'Septembre', 'Octobre', 'Novembre','Decembre' );

 	

 	function getEvents($year){
 		global $bdd;
 		$req = $bdd ->query("SELECT * FROM booking WHERE YEAR(date_debut)=".$year);
 		$r = array();
 		
 		while ($d = $req->fetch(PDO::FETCH_OBJ)) {

 			
 			$r[strtotime($d->date_debut)][$d->id_booking]= "• Id : " . $d->id_booking . "; Name : " . $d->nom . "; Vehicle : " . $d->vehicle . "; Heure départ : " . $d->heure_depart . "; Date arrivée : " . $d->date_fin;
 			 $r[strtotime($d->date_fin)][$d->id_booking]= "• Id : " . $d->id_booking . "; Name : " . $d->nom . "; Vehicle : " . $d->vehicle .  "; Date départ : " . $d->date_debut. "; Heure départ : " . $d->heure_depart . "; Heure arrivée : "  . $d->heure_arrivee;
 		}

 		return $r;
 		
 		
 		
 	}
 	function getAll($year){
 		$r = array();

 	


 		$date = new DateTime($year.'-01-01');
 		while ($date->format('Y') <= $year) {
 		$y = $date->format('Y');
 		$m = $date->format('n');
 		$d = $date->format('j');
 		$w = str_replace('0','7',$date->format('w'));

 		$r[$y][$m][$d] = $w;
 		$date->add(new DateInterval('P1D'));
 		}
 		return $r; 
 	}
 }



?>