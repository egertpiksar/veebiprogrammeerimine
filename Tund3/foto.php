<?php

	$picdir = "../picture/";
	$picfiles = [];
	$picfilestype = ["jpeg", "jpg", "png", "gif"];
	
	$allfiles = array_slice(scandir($picdir), 2);
	
	foreach ($allfiles as $file){
		$filetype = pathinfo($file, PATHINFO_EXTENSION);
		if (in_array($filetype, $picfilestypes) == true){
			array_push($picfiles, $file);
			
		}
	}
	
	//var_dump($picfiles);
	$filecount = count($picfiles);
	$picnumber = mt_rand(0, ($filecount - 1));
	$picfile = $picfiles[$picnumber];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Egert Piksari veebiprogrammeerimine
	</title>
</head>
<body>
	<h1>
	
	</h1>
	<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiseltvõetavat sisu.</p>
	<h2>Pilt ülikoolist</h2>
	<img src="../picture/tlu_15.jpg" alt="Tallinna Ülikool">
	<img src="../picture/tlu_41.jpg" alt="Tallinna Ülikool">
	<img src="<?php echo $picdir .$picfile; ?>" alt="Tallinna Ülikool">
	
</body>
</html>