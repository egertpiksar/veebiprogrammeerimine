<?php
	require("functions.php");
	require("upload.php");
	
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
	$dirToRead = "../pics/";
	//kuna tahan ainult pildifaile, siis filtreerin
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	$picFiles = [];
	//$allFiles = scandir($dirToRead);
	//loen kataloogi ja viskan kaks esimest massiivi liiget (. ja ..) välja
	$allFiles = array_slice(scandir($dirToRead),2);
	//var_dump($allFiles);
	
	//tsükkel, mis töötab ainult massiividega
	foreach ($allFiles as $file){
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
		//kas see tüüp on lubatud nimekirjas
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);
			//$picFiles[] = $file;
		}
	}//foreach lõppeb
	//var_dump($picFiles);
	
	//mitu pilti on?
	$fileCount = count($picFiles);
	$picNumber = mt_rand(0, $fileCount - 1);
	$picToShow = $picFiles[$picNumber];
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
	<p><a href="usersinfo.php">Kasutajate info</a></p>
	<p><a href="userideas.php">Head mõtted</a></p>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    Laadige pilt oma arvutist:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Laadige ülesse" name="submit">
	<p>Üks pilt Tallinna Ülikoolist!</p>
	<img src="<?php echo $dirToRead .$picToShow; ?>" alt="Tallinna Ülikool">
		<img src="<?php echo $dirToRead .$picToShow; ?>" alt="Tallinna Ülikool">

</body>
</html>