<?php 

include "../includes/connect.php";

####################################
#Funktionen, um Sendung zu erstellen
####################################

if(isset($_POST['create_sendung'])) {
	$spalten = mysqli_real_escape_string($sql, intval(trim($_POST['pos'])));
	$name = utf8_encode(mysqli_real_escape_string($sql, trim($_POST['name'])));
	$datum = date("Y-m-d", strtotime(mysqli_real_escape_string($sql, trim($_POST['datum']))));
	$dauer = mysqli_real_escape_string($sql, trim($_POST['dauer']));
	$verantwortlicher = intval(mysqli_real_escape_string($sql, trim($_POST['verantwortlicher'])));
	if(!empty($_POST['einladen'])) {$eingeladen = $_POST['einladen'];} else {$eingeladen = '';}
	$eingeladen = array();
	$eingeladen_anz = count($eingeladen);

	$rand = mt_rand(0, 128);
	$salt = str_shuffle($name.$rand.$name);
	$salt = str_replace(' ','',$salt);



	$sendung_ab = "	INSERT INTO `sendungen`(`name`, `positionen`, `datum`, `dauer`, `verantwortlicher`,`salt`) 
					VALUES ('$name','$spalten','$datum','$dauer','$verantwortlicher','$salt')";
	$sendung_an = mysqli_query($sql, $sendung_ab);
	$sendungID = mysqli_insert_id($sql);
	if($sendung_an) {
		include_once "../includes/functions.php";
		sec_session_start();
		$_SESSION['berechtigung'][] = $sendungID;
	}

	if($sendung_an) {
		for($i=1; $i <= $spalten; $i++) {

			$positionen_ab = "	INSERT INTO `positionen`(`sendungID`, `position`, `typID`) 
								VALUES ('$sendungID','$i','1');";
			$positionen_an = mysqli_query($sql, $positionen_ab);
		}
	}

	if($positionen_an) {
		$verant_ab = "INSERT INTO `nutzer_sendung`(`nutzerID`, `sendungID`) VALUES ('$verantwortlicher','$sendungID');";
		$verant_an = mysqli_query($sql, $verant_ab);
		if($eingeladen_anz > 0) {
			foreach($eingeladen AS $nutzer) {
				$nutzer = intval(mysqli_real_escape_string($sql, trim($nutzer)));
				if($nutzer != $verantwortlicher) {
					$send_nut_ab = "INSERT INTO `nutzer_sendung`(`nutzerID`, `sendungID`) VALUES ('$nutzer','$sendungID');";
					$send_nut_an = mysqli_query($sql, $send_nut_ab);
				}
			}
		}
	}

	if($eingeladen_anz > 0) {if($send_nut_an) {header("Location: sendung.php?sendung=".$sendungID."&erstellt");}}
	elseif($positionen_an) {header("Location: sendung.php?sendung=".$sendungID."&erstellt");}
	else {header("Location: sendung.php?fehl");}
}

#####################################################
#Funktionen, um Positionen der Sendung zu bearbeiten
#####################################################

if(isset($_POST['update_positionen'])) {
	$position = $_POST['pos'];
	$anz_pos = count($position);
	$inhalte = $_POST['inhalt'];
	$typen =  $_POST['typ'];
	$d =  $_POST['dauer'];
	$kum_dauer = date("H:i:s", strtotime("00:00:00"));
	$sendungID = mysqli_real_escape_string($sql, intval(trim($_POST['sendungID'])));

	$check_ab = "SELECT * FROM positionen WHERE sendungID = '".$sendungID."';";
	$check_an = mysqli_query($sql, $check_ab);
	$check_anz = mysqli_num_rows($check_an);


	if($anz_pos > $check_anz) {
		$pos = intval($anz_pos) - intval($check_anz);
		$p = $check_anz;
		for($i=1; $i<=$pos; $i++) {
			$p++;
			$insert_ab = "	INSERT INTO `positionen`(`sendungID`, `position`, `typID`)
							VALUES ('$sendungID','$p','1');";
			$insert_an = mysqli_query($sql, $insert_ab);
		}
	}

	for($i=0; $i<$anz_pos; $i++) {

		$pos = intval($i+1);

		#Gesamtzeiten berechnen
		#######################
		#aktuelle Gesamtzeit in Sekunden umrechnen, wenn nicht 00:00:00
		if($kum_dauer != "00:00:00") {
			$kum_dauer = explode(":", $kum_dauer);
			$kum_sekunden = (intval($kum_dauer[0] * 3600)) + (intval($kum_dauer[1] * 60)) + (intval($kum_dauer[2]));
		}
		else {$kum_sekunden = intval("0");}
		#aktuelle Positionsdauer in Sekunden umrechnen, wenn nicht 00:00:00
		if($d[$i] != "00:00:00") {
			$dauer_s = explode(":", $d[$i]);
			$dauer_sekunden = (intval($dauer_s[0] * 3600)) + (intval($dauer_s[1] * 60)) + (intval($dauer_s[2]));
		}
		else {$dauer_sekunden = intval("0");}
		#beide Sekundenwerte wieder zusammenfassen
		$kum_dauer = $kum_sekunden + $dauer_sekunden;
		#neue Gesamtzeit (Sekunden) wieder aufsplitten
		$kum_dauer = 	(str_pad(floor($kum_dauer/3600), 2 ,'0', STR_PAD_LEFT)).":".		#Gesamtsekunden durch 3600 rechnen, dann immer abrunden und wenn Zahl keine 2 Stellen hat, mit 0 vorne auffüllen
						(str_pad(floor(($kum_dauer%3600)/60), 2 ,'0', STR_PAD_LEFT)).":".	#Den bei der vorigen Rechnung übrigen Rest durch 60 teilen und dann wie oben
						(str_pad(floor($kum_dauer%60), 2 ,'0', STR_PAD_LEFT));				#Den bei der vorigen Rechnung übrigen Rest als Sekunden nehmen und wie oben

		if(!empty($inhalte[$i])) {$inhalt = mysqli_real_escape_string($sql, $inhalte[$i]);} else {$inhalt = "";}
		if(!empty($typen[$i])) {$typ = intval(mysqli_real_escape_string($sql, $typen[$i]));} else {$typ = "1";}
		if(!empty($d[$i])) {$dauer = mysqli_real_escape_string($sql, $d[$i]);} else {$dauer = "00:00:00";}

		#Daten eintragen
		################
		$update_ab = "	UPDATE `positionen` 
						SET `inhalt`='$inhalt',`typID`='$typ',`dauer`='$dauer',`dauer_ges`='$kum_dauer'
						WHERE sendungID = '".$sendungID."' AND position = '".$pos."';";
		$update_an = mysqli_query($sql, $update_ab);
		
	}
	if($update_an) {header("Location: sendung.php?sendung=".$sendungID."&update");}
	else {header("Location: sendung.php?sendung=".$sendungID."&fehl");}
}

###############################################
#Funktionen, um Daten der Sendung zu bearbeiten
###############################################

if(isset($_POST['update_sendung'])) {
	$name = mysqli_real_escape_string($sql, trim($_POST['sendungName']));
	$start = date("Y-m-d", strtotime(mysqli_real_escape_string($sql, trim($_POST['sendungGeplStart']))));
	$dauer = mysqli_real_escape_string($sql, trim($_POST['sendungGeplDauer']));
	$verantwortlicher = mysqli_real_escape_string($sql, trim($_POST['sendungVerantwortlicher']));
	$sendungID = intval(mysqli_real_escape_string($sql, trim($_POST['sendungID'])));

	$sendUpdate_ab = "	UPDATE `sendungen` 
						SET `name`='$name',`datum`='$start',`dauer`='$dauer',`verantwortlicher`='$verantwortlicher'
						WHERE sendungID = '".$sendungID."';";
	$sendUpdate_an = mysqli_query($sql, $sendUpdate_ab);
	
	if($sendUpdate_an) {header("Location: sendung.php?sendung=".$sendungID."&update");}
	else {header("Location: sendung.php?sendung=".$sendungID."&fehl");}
}

##################################
#Funktionen, um Sendung zu löschen
##################################

if(isset($_POST['delete_sendung'])) {
	$sendungID = intval(mysqli_real_escape_string($sql, trim($_POST['sendungID'])));

	$delete_ab = "DELETE FROM sendungen WHERE sendungID = '".$sendungID."';";
	$delete_an = mysqli_query($sql, $delete_ab);

	if($delete_an) {header("Location: sendung.php?del");}
}

?>