<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=bookingcalendar', 'root', 'root');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calendar</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<script type="text/javascript">
		
		jQuery(function($){
			$('.month').hide();
			$('.month:first').show();
			$('.months a:first').addClass('active');
			var current = 1;
			$('.months a').click(function(){
				var month = $(this).attr('id').replace('linkMonth','');
				if (month != current) {
					$('#month'+current).slideUp();
					$('#month'+month).slideDown();
					$('.months a').removeClass('active');
					$('.months #alinkMonth' + month).addClass('active');
					current = month;
				}
				return false;
			});
		});
	</script>
</head>
<body>

<?php

require('date.php');

$date = new Date();
$year = date('Y');
$events = $date->getEvents($year);
$dates = $date->getAll($year);

?>
<a href="index.php"><button class="btn2">< Back</button></a>
<h1 style="text-align: center;">CALENDAR</h1>

<div class="periods">
	<div class="year"><?php echo $year; ?></div>
	<div class="months">
		<ul>
			<?php foreach ($date->months as $id=>$m):?>
				<li><a href="#" id="linkMonth<?php echo $id+1;?>"><?php echo substr($m,0,3);?></a></li>

			<?php endforeach; ?>
		</ul>
	</div>
<div class="clear"></div>
	<?php $dates = current($dates); ?>
	<?php foreach ($dates as $m => $days){?>
		<div class="month relative" id="month<?php echo $m;?>">
			
			<table>
				<thead>
					<tr>
						<?php foreach ($date->days as $d){?>

						<th><?php echo substr($d, 0,3);?></th>
						<?php }?>
					</tr>
				</thead>
				<tbody>
					
					<tr>
						<?php $end = end($days); foreach ($days as $d=>$w){?>

						<?php $time = strtotime("$year-$m-$d"); ?>
						<?php if ($d == 1 and $w != 1) {?>
						<td colspan="<?php echo $w - 1; ?>" class="padding"></td>
						<?php } ?>
						<td <?php if ($time == strtotime(date('Y-m-d'))){ ?> class="today" <?php } ?>>
							<div class="relative">
						<div class="day"><?php echo $d; ?></div>
					</div>
					<div class="daytitle">
						<?php echo $date->days[$w-1]; ?> <?php echo $d; ?> <?php echo $date->months[$m-1]; ?>
					</div>
					<ul class="events">

						<?php if (isset($events[$time])) {

							foreach ($events[$time] as $e ) { ?>

								<li><?php echo $e;?></li>
							<?php }
						} ?>
						
					</ul>
							
						</td>
						<?php if ($w == 7){?>
						</tr><tr>
							<?php }?>

						<?php }?>

						<?php if ($end != 7){?>
						<td colspan="<?php echo 7-$end; ?>" class="padding"></td>
						<?php } ?>
					</tr>
				</tbody>
			</table>
		</div>
		<?php } ?>
	
</div>




</body>
</html>