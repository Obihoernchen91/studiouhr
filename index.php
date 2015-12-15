<?php 
	header("Location: login/login.php");

	if(isset($_GET['logout'])) {header("Location: login/login.php?out");}

	if(isset($_GET['anmfehler'])) {header("Location: login/login.php?fehler");}

	if(isset($_GET['anmelden'])) {header("Location: login/login.php?anm");}

	if(isset($_GET['berechtigung'])) {header("Location: start/start.php?entry");}
	#hallo
 ?>