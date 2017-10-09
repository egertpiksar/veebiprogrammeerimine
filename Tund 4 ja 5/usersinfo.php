<?php
	require("functions.php");
	
	//kui pole sisseloginud, siis sisselogimise lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//kui logib välja
	if (isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: login.php");
	}
	
	
		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Egert Piksari veebiprogemise asjad
	</title>
</head>
<body>
	<h1>Egert Piksar</h1>
	<p></p>
	<p><a href="?logout=1">Logi välja</a>!</p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Kõik süsteemi kasutajad</h2>
	<table border="1" style="border: 1px solid black; border-collapse: collapse">
	<tr>
		<th>Eesnimi</th><th>Perekonnanimi</th><th>E-mail</th><th>Sünnipäev</th><th>Sugu</th>
	</tr>
	<tr>
		<td>Kalle</td><td>Mees</td><td>kalle.mees@tlu.ee</td>
	</tr>
	<tr>
		<td>Malle</td><td>Naine</td><td>malle.naine@tlu.ee</td>
	</tr>
	<tr>
		<td>Vanja</td><td>Vannis</td><td>vanja.vannis@tlu.ee</td>
	</tr>
	</table>
	
	
</body>
</html>
