<?php
	require("header.php");
	require("../../config.php");
	$database = "if17_ryhm6";

	$dir = '../pildid';
	

	
	
		//salvestamine
	function saveIdea($pilt, $reiting){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO piltide_hindamine (id, pilt, reiting) VALUES (?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("iss", $_SESSION["id"], $pilt, $reiting);
		if($stmt->execute()){
			$notice = "Mõte on salvestatud!";
		} else {
			$notice = "Mõtte salvestamisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
		return $notice;
	
	}
	//$query = $database->query("SELECT * FROM pildid");
	
	//$pilt = [];
	
	/*while($row = $query->fetch_object()) {
		$pilt[] = $row;
		
	}*/
	
	
	//echo "<img src='../pildid/1.jpg' width='400' height='400'>";


	
	/*if ($opendir = opendir($dir))
	{
		while(($file = readdir($opendir)) !== FALSE)
		{
		  if ($file!="."&&$file!="..")
			echo "<img src='../pildid/1.jpg' width='400' height='400'>";
			
		}
	}
	*/
/*
	if(isset($_GET["pilt"], $_GET["reiting"])) {
		
			$pilt = (int)$_GET["pilt"];
			$reiting = (int)$_GET["reiting"];
			
		if(in_array($reiting, [1, 2, 3, 4, 5])) {
			$exists = $database->query("SELECT id FROM pildid WHERE id = {$pilt}")->num_rows ? true : false;
			if($exists){
				$database->query("INSERT INTO piltide_hindamine (pilt, reiting) VALUES ({$pilt}, {$reiting})");
			
			}
		}
	}
*/
//kui soovitakse ideed salvestada
	if(isset($_POST["ideaBtn"])){
		
		if(isset($_POST["pilt"]) and isset($_POST["r"]) and !empty($_POST["pilt"]) and !empty($_POST["reiting"])){
			$myIdea = test_input($_POST["pilt"]);
			$notice = saveIdea($myIdea, $_POST["reiting"]);
		}
	}


?>


<!DOCTYPE html> 
<html>
<head>
<style> <!-- See on galerii välimuse osa-->
div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 360px;
}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 15px;
    text-align: center;
}
</style>
</head>
<body>
<!--class on galerii, et saaks välimust muuta-->
<div class="gallery"><!--DIV ALGUS-->
  <a target="_blank" href="1.jpg">
    <img src='../pildid/1.jpg' width="300" height="200">
 </a>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>&nbsp; <!--TÜHIK-->
1<input name="rating" type="radio" value="1" />
2<input name="rating" type="radio" value="2" />
3<input name="rating" type="radio" value="3" />
4<input name="rating" type="radio" value="4" />
5<input name="rating" type="radio" value="5" />
 &nbsp;&nbsp;<!--TÜHIKUD-->
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" value="Salvesta" name="vote" /></p>
</div><!--DIV LÕPP-->



<div class="gallery">
  <a target="_blank" href="img_forest.jpg">
    <img src='../pildid/2.jpg' width="300" height="200">
  </a>
  <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>&nbsp;
1<input name="rating" type="radio" value="1" />
2<input name="rating" type="radio" value="2" />
3<input name="rating" type="radio" value="3" />
4<input name="rating" type="radio" value="4" />
5<input name="rating" type="radio" value="5" />
 &nbsp;&nbsp;
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" value="Salvesta" name="vote" /></p>
</div>



<div class="gallery">
  <a target="_blank" href="img_lights.jpg">
    <img src='../pildid/download.jpg' width="300" height="200">
</a>
  
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<p>&nbsp;
1<input name="rating" type="radio" value="1" />
2<input name="rating" type="radio" value="2" />
3<input name="rating" type="radio" value="3" />
4<input name="rating" type="radio" value="4" />
5<input name="rating" type="radio" value="5" />
 &nbsp;&nbsp;
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" value="Salvesta" name="vote" /></p>




</body>
</html>
