<?php
	require("functions.php");
	require("editideafunctions.php");
	$notice = "";
	
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
	
	
	//kas uuendatakse
	if (isset($_POST["update"])){
		updateIdea($_POST["id"], test_input($_POST["idea"]), $_POST["ideaColor"]);
		header("Location: userideas.php");
	}
		
	if(isset($_GET["delete"])){
		deleteIdea($_GET["id"]);
		header("Location: usersideas.php");
		exit();
	}
	
		
		
		
		
		$idea = getSingleIdea($_GET["id"]);
	
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
	
	<h1 style="color:red;">Egert Piksar</h1>
	<p></p>
	<p><a href="?logout=1">Logi välja</a>!</p>
	<p><a href="userideas.php">Tagasi mõtete lehele</a></p>
	<h2> Hea mõtte toimetamine </h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<input name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
		<label>Hea mõte: </label>
		<textarea name="idea"><?php echo $idea->text; ?></textarea>
		<br>
		<label>Mõttega seostuv värv: </label>
		<input name="ideaColor" type="color" value="<?php echo $idea->color; ?>">
		<br>
		<input name="update" type="submit" value="Salvesta muudatused">
		<span><?php echo $notice; ?></span>
	
	</form>
	<p><a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta see mõte</a></p>
	<hr>

	
</body>	
</html>