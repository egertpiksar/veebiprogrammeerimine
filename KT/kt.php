<?php
    require("../config.php");
	$database="if17_roland_4";
	
	
	
	$rkFirstname = "";
	$rkLastname= "";
	$rkLanguage= "";
	$rkJanuary= "";
	$rkFebruary= "";
	$rkMarch= "";
	$rkApril= "";
	$rkMay= "";
	$rkJune= "";
	$rkJuly= "";
	$rkAugust= "";
	$rkSeptember= "";
	$rkOctober= "";
	$rkNovember= "";
	$rkDecember= "";
	
	$rkFirstnameError = "";
	$rkLastnameError= "";
	$rkLanguageError= "";
	$rkJanuaryError= "";
	$rkFebruaryError= "";
	$rkMarchError= "";
	$rkAprilError= "";
	$rkMayError= "";
	$rkJuneError= "";
	$rkJulyError= "";
	$rkAugustError= "";
	$rkSeptemberError= "";
	$rkOctoberError= "";
	$rkNovemberError= "";
	$rkDecemberError= "";
	
	function lisanAndmed($rkFirstname, $rkLastname, $rkLanguage, $rkJanuary, $rkFebruary, $rkMarch, $rkApril, $rkMay, $rkJune, $rkJuly, $rkAugust, $rkSeptember, $rkOctober, $rkNovember, $rkDecember){
	
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	echo $mysqli->error;
		$stmt->bind_param('sssssssssssssss',$rkFirstname, $rkLastname, $rkLanguage, $rkJanuary, $rkFebruary, $rkMarch, $rkApril, $rkMay, $rkJune, $rkJuly, $rkAugust, $rkSeptember, $rkOctober, $rkNovember, $rkDecember);
		$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}

	if (isset ($_POST["rkFirstname"])){
		if (empty($_POST["rkFirstname"])){
			$rkFirstnameError ="NB! Väli on kohustuslik!";
		} else {
			$rkFirstname = test_input($_POST["rkFirstname"]);
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Eesnimi: </label>
		<input name="firstname" type="text" value="<?php echo $rkFirstname; ?>"><span><?php echo $rkFirstnameError; ?></span>
		<br>
		<label>Perekonnanimi: </label>
		<input name="lastname" type="text" value="<?php echo $rkLastname ?>"><span><?php echo $rkLastnameError; ?></span>
		<br>
		<label>Keel: </label>
		<input name="language" type="text" value="<?php echo $rkLanguage; ?>"><span><?php echo $rkLanguageError; ?></span>
		<br>
		<label>Sisesta selles keeles kõikide kuude nimed: </label>
		<input name="january" type="text">
		<input name="february" type="text">
		<input name="march" type="text">
		<input name="april" type="text">
		<input name="may" type="text">
		<input name="june" type="text">
		<input name="july" type="text">
		<input name="august" type="text">
		<input name="september" type="text">
		<input name="october" type="text">
		<input name="november" type="text">
		<input name="december" type="text">
		<br>
		<input name="Sisesta" type="submit" value="Salvesta">
</body>
</html>
