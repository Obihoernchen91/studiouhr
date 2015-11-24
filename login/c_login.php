<?php

		include_once '../includes/functions.php';
		include '../includes/connect.php';

		$name = mysqli_real_escape_string($sql, trim($_POST['name']));
	    $passwort = hash("sha512", mysqli_real_escape_string($sql, trim($_POST['passwort'])));

	    $login_ab = "SELECT * FROM nutzer WHERE login = '".$name."' AND passwort = '".$passwort."';";
	    if($login_an = mysqli_query($sql, $login_ab)) {

	        if(mysqli_num_rows($login_an) == 1) {

	        	sec_session_start();

	            $login = mysqli_fetch_array($login_an);

	            $sendung_ab = "SELECT * FROM nutzer_sendung WHERE nutzerID = '".$login['nutzerID']."';";
	            $sendung_an = mysqli_query($sql, $sendung_ab);
	            $sendung_anz = mysqli_num_rows($sendung_an);

	            $nutzer_browser = $_SERVER['HTTP_USER_AGENT'];
	            $_SESSION['nutzerID'] = $login['nutzerID'];
	            $_SESSION['rolle'] = $login['rollenID'];
	            $_SESSION['name'] = $name;
	            $_SESSION['login_string'] = hash('sha512', $passwort . $nutzer_browser);

	            if($sendung_anz > 0) {
	            	while($sendung = mysqli_fetch_array($sendung_an)) {
	            		$_SESSION['berechtigung'][] = intval($sendung['sendungID']);
	            	}
	            }
	            header("Location: ../start/start.php?login");
	        }
	        else {header("Location: ../index.php?anmfehler");}
	    }
	    else {header("Location: ../index.php?anmfehler");}
?>	