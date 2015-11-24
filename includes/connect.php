<?php
#include ("config.php");

date_default_timezone_set("Europe/Berlin");

if(!$sql = new mysqli( 'localhost', 'root', '', 'studiouhr')) {
	die( 'Verbindung zum Datenbankserver konnte nicht hergestellt werden.' );
}

mysqli_set_charset($sql, "utf8");
header("Content-Type: text/html; charset=utf-8");