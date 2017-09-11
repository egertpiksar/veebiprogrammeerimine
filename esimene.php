<?php
	
	//muutujad
	$myName = "Egert";
	$myFamilyName = "Piksar";
	
	$hourNow = date("H");
	
	$schooldaystart = date("d.m.Y") ."  8:15";
	echo $schooldaystart;
	//echo $hourNow
	$schoolbegin = strtotime($schooldaystart);
	$timenow  = strtotime("now");
	//echo ($timenow - $schoolbegin);
	$minutepassed = round($timenow - $schoolbegin / 60);
	echo $minutepassed;
	//Võrdlen kellaaega ja annan hinnangu, mis päeva osaga on tegemist. <   >   ==   !=
	$partofday = "";
	if ( $hourNow < 8 ){
		$partofday = "varajane hommik";
	}
		//echo $partofday
	if ( $hourNow <= 8 and $hourNow < 16 ){
		$partofday = "koolipäev";
	}
	if( $hourNow >= 16 ){
		$partofday = "vaba aeg";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Egert Piksari veebiprogrameerimise asjad</title>
</head>
<body>
	<h1>
	<?php
		
		echo $myName ." " .$myFamilyName
		
	?>
	
	</h1>
	<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiseltvõetavat sisu.</p>
	<p>Sügisuvitalv.</p>
	<?php 
	
	echo "<p>Kõige esimene php sõnum.</p>";
	echo "<p>Täna on ";
	echo date("d.m.Y") .". Käes on " .$partofday;
	echo ".</p>";
	echo "<p>Lehe avamise hetkel oli kell  " .date ("H.i.s") .".</p>";
	
	?>
</body>
</html>