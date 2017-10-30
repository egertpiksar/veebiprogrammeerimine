<?php

	require("../../../config.php");
	$database = "if17_piksar_2";

//loeme toimetamiseks mõtte
	function getSingleIdea($edit_Id){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT idea, color FROM vp_userideas WHERE id=?");
		$stmt->bind_param("i", $edit_Id);
		$stmt->bind_result($idea, $color);
		$stmt->execute();
		$ideaObject = new Stdclass();
		if($stmt->fetch()){
			$ideaObject->text = $idea;
			$ideaObject->color = $color;
		}

	
		$stmt->close();
		$mysqli->close();
		return $ideaObject;
	
	}

	function updateIdea($id, $idea, $ideaColor){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE vp_userideas SET idea=?, color=?, id=?");
		$stmt->bind_param("ssi", $idea, $color, $id);
		if($stmt->execute()){
			echo "Õnnestus!";
		} else {
			echo $stmt->error;
		}
	
		$stmt->close();
		$mysqli->close();
	}
	function deleteIdea($id){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE vp_userideas SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
			echo "Õnnestus!";
		} else {
			echo $stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
	}
?>