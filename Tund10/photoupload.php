<?php
	require("functions.php");
	$notice = "";
	$allIdeas = "";
	
	//########KLASS########
	require("classes/Photoupload.class.php");
	
	//$joke = new Photoupload("Väga salajane värk");
	//echo $joke->testPublic;
	//echo $joke->testPrivate;
	
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
	
	//Algab foto laadimise osa
	$target_dir = "../pics/";
	$target_file;
	$uploadOk = 1;
	$imageFileType;
	$maxWidth = 600;
	$maxHeight = 400;
	$marginBottom = 10;
	$marginRight = 10;
	
	
	//Kas on pildi failitüüp
	if(isset($_POST["submit"])) {
		
		//kas mingi fail valiti
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]))["extension"]);
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			//tekitame failinime koos ajatempliga
			$target_file = $target_dir .pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .(microtime(1) * 10000) ."." .$imageFileType;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "See pole pildifail. ";
				$uploadOk = 0;
			}

			
			//Kas selline pilt on juba üles laetud
			if (file_exists($target_file)) {
				$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
				$uploadOk = 0;
			}
			//Piirame faili suuruse
			/*if ($_FILES["fileToUpload"]["size"] > 1000000) {
				$notice .= "Pilt on liiga suur! ";
				$uploadOk = 0;
			}*/
			
			//Piirame failitüüpe
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$notice .= "Vabandust, vaid JPG, JPEG, PNG ja GIF failid on lubatud! ";
				$uploadOk = 0;
			}
			
			//Kas saab laadida?
			/*if ($uploadOk == 0) {
				$notice .= "Vabandust, pilti ei laetud üles! ";
			//Kui saab üles laadida
			} else {		
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
				} else {
					$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
				}
			}*/
			
			if ($uploadOk == 0) {
				$notice .= "Vabandust, pilti ei laetud üles! ";
			//Kui saab üles laadida
			} else {
				
					//KASUTAN KLASSI!
					$myPhoto = new Photoupload($_FILES["fileToUpload"]["tmp_name"], $imageFileType);
					$myPhoto->readExif();
					$myPhoto->resizeImage($maxWidth, $maxHeight);
					//$myPhoto->addWatermark();
					//$myPhoto->addTextWatermark($myPhoto->exifToImage);
					$myPhoto->addTextWatermark("hmv_foto");
					$myPhoto->savePhoto($target_dir, $target_file);
					$myPhoto->clearImages();
					unset($myPhoto);
			}
	} else {	
			$notice = "Palun valige kõigepealt pildifail!";		
	}//kas üldse mõni fail valiti, lõppe
}//kas vajutati submit nuppu, lõppeb

	require("header.php");

?>

	<h1>Egert Piksar</h1>
	<p>See veebileht on loodud veebiprogrammeerimise kursusel ning ei sisalda mingisugust tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja</a>!</p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Foto üleslaadimine</h2>
	<form action="photoupload.php" method="post" enctype="multipart/form-data">
		<label>Valige pildifail:</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Lae üles" name="submit" id="submitPhoto"><span id="fileSizeError"></span>
		
		<p>Kes näevad pilti?</p>
		<input type="radio" name="visibility"
		<?php if (isset($visibility) && $visibility=="avalik") echo "valitud";?>
		value="avalik">Avalik
		<input type="radio" name="visibility"
		<?php if (isset($visibility) && $visibility=="Sisseloginud kasutaja") echo "valitud";?>
		value="Sisseloginud kasutaja">Sisseloginud kasutaja
		<input type="radio" name="visibility"
		<?php if (isset($visibility) && $visibility=="Ainult omanik") echo "valitud";?>
		value="Ainult omanik">Ainult omanik
		
	</form>
	
	<span><?php echo $notice; ?></span>
<?php
	echo '<script type="text/javascript" src="javascript/checkFileSize.js"></script>';
	require("footer.php");
?>	
	<hr>
</body>
</html>