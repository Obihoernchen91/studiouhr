<?php
include_once 'connect.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // vergib einen Sessionnamen
    session_name($session_name);
    session_start();            // Startet die PHP-Sitzung 
    session_regenerate_id();    // Erneuert die Session, löscht die alte. 

}


function login_check($sql) {
    // Überprüfe, ob alle Session-Variablen gesetzt sind 
    if (isset($_SESSION['nutzerID'], $_SESSION['name'], $_SESSION['login_string'])) {
        $nutzerID = $_SESSION['nutzerID'];
        $login_string = $_SESSION['login_string'];
        $name = $_SESSION['name'];
 
        // Hole den user-agent string des Benutzers.
        $nutzer_browser = $_SERVER['HTTP_USER_AGENT'];

        $login_ab = "SELECT * FROM nutzer WHERE nutzerID = '".$nutzerID."';";
        if($login_an = mysqli_query($sql, $login_ab)) {
            if(mysqli_num_rows($login_an) == 1) {
                $login = mysqli_fetch_array($login_an);
                $login_check = hash('sha512', $login['passwort'] . $nutzer_browser);
                
                if ($login_check == $login_string) {
                    // Eingeloggt!!!! 
                    return true;
                } 
                else {
                    // Nicht eingeloggt
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}

function sendung_check($sql, $sendung) {
    if (isset($_SESSION['berechtigung'])) {
        $zugang = intval("0");
        $berechtigung = $_SESSION['berechtigung'];
        $berechtigung_anz = count($berechtigung);

        if($berechtigung_anz > 0) {
            foreach($berechtigung AS $b) {
                if($b == $sendung) {
                    $zugang++;
                }
            }
        }
        if($zugang == intval("1")) {return true;}
        else {return false;}
    }
    else {return false;}
}
?>