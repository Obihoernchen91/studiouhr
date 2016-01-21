<?php

include_once '../includes/functions.php';
include_once '../includes/connect.php';

if(isset($_GET['update'])) {
	if(isset($_POST['dauer']) && $_POST['dauer'] != '') {$dauer = mysqli_real_escape_string($sql, trim($_POST['dauer']));}
	if(isset($_POST['id']) && $_POST['id'] != '') {$sendungID = intval(trim($_POST['id']));}
	if(isset($_POST['pos']) && $_POST['pos'] != '') {$pos = intval(trim($_POST['pos']));}

	//die($_POST['dauer']." ".$_POST['id']." ".$_POST['pos']);

	$update_ab = "	UPDATE `positionen` SET `dauer`='{$dauer}'
					WHERE sendungID = '{$sendungID}'
					AND position = '{$pos}';";
	if(mysqli_query($sql, $update_ab)) {echo "keine Probleme";}
	else {echo $update_ab;}

}

?>