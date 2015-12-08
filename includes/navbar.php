<!DOCTYPE html>
<html>
<head>
  <title>Studiouhr - <?php echo $title; ?></title>

  <link rel="stylesheet" href="../includes/style.css">
  <link rel="stylesheet" href="../includes/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../includes/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="../includes/jquery-ui-1.11.4/jquery-ui.min.css">
  <link rel="stylesheet" href="../includes/bootstrap-select/dist/css/bootstrap-select.css">

  <style type="text/css">
    .ui-datepicker {
      z-index: 1151 !important;
    }
  </style>

</head>
<body>

<?php
  include_once '../includes/functions.php';
  include_once '../includes/connect.php';

  if(!isset($_SESSION)) {sec_session_start();}
  if(!login_check($sql)) {header("Location: ../index.php?anmelden");}

?>

<div class="row">
  <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Titel und Schalter werden für eine bessere mobile Ansicht zusammengefasst -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Navigation ein-/ausblenden</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">
          <span class="glyphicon glyphicon-time"></span>
        </a>
        <a class="navbar-brand" href="../start/start.php" style="font-size: 22px;">
          Studiouhr
        </a>
      </div>

      <!-- Alle Navigationslinks, Formulare und anderer Inhalt werden hier zusammengefasst und können dann ein- und ausgeblendet werden -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left" style="font-size: 18px;">
          <li><a href="../planung/sendung.php">Planung</a></li>
          <li><a href="" data-toggle="modal" data-target="#crew">Studio Crew</a></li>
          <li><a href="" data-toggle="modal" data-target="#moderation">Moderation</a></li>
          <li><a href="../nutzer/nutzerverwaltung.php">Nutzerverwaltung</a></li>
        </ul>
          <a href="../login/logout.php"><button type="submit" class="btn btn-danger navbar-btn" style="float:right;">Logout</button></a>
          <p class="navbar-text" style="float:right;">angemeldet als <?php echo "<a href='../nutzer/nutzer.php?nutzer=".$_SESSION['nutzerID']."'>".$_SESSION['name']."</a> ";?> </p>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <!--Modals für die Button-->
    <!--Modal für Studiocrew-->
    <div class="modal fade" id="crew" tabindex="-1" role="dialog" aria-labelledby="crewLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="GET" action="../crew/crew.php">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="crewLabel">Sendung w&auml;hlen f&uuml;r die Studiocrew</h4>
              </div>
              <div class="modal-body">
                <select id="search" style="height: 125px;" name="sendung" class="selectpicker show-tick form-control" title="Sendung w&auml;hlen" data-live-search="true">
                <optgroup label="Ihre verfügbaren Sendungen">
                <?php
                  $sendung_ab = " SELECT * FROM sendungen, nutzer_sendung 
                          WHERE sendungen.sendungID = nutzer_sendung.sendungID
                          AND nutzer_sendung.nutzerID = '".$_SESSION['nutzerID']."'
                          ORDER BY datum ASC;";
                  $sendung_an = mysqli_query($sql, $sendung_ab);
                  while($sendung = mysqli_fetch_array($sendung_an)) {
                    $datum = date("d.m.Y", strtotime($sendung['datum']));
                    echo "<option name='sendung' value='".$sendung['sendungID']."' data-subtext='l&auml;uft am ".$datum."'>".$sendung['name']."</option>";
                  }
                ?>
                </optgroup>
                </select>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Los!</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <!--Modal für Studiocrew Ende-->
    <!--Modal für die Moderation-->
    <div class="modal fade" id="moderation" tabindex="-1" role="dialog" aria-labelledby="moderationLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="GET" action="../moderation/moderation.php">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="crewLabel">Sendung w&auml;hlen f&uuml;r die Moderation</h4>
              </div>
              <div class="modal-body">
                <select id="search" style="height: 125px;" name="sendung" class="selectpicker form-control" title="Sendung w&auml;hlen" data-live-search="true">
                <optgroup label="Ihre verfügbaren Sendungen">
                <?php
                  #angezeigte Sendung nach Rolle
                  if($_SESSION['rolle'] == 2) {$aktiv = "AND aktiv = '1'";}
                  else {$aktiv = "";}

                  $sendung_ab = " SELECT * FROM sendungen, nutzer_sendung 
                              WHERE sendungen.sendungID = nutzer_sendung.sendungID
                              AND nutzer_sendung.nutzerID = '".$_SESSION['nutzerID']."'
                              ".$aktiv."
                              ORDER BY datum ASC;";
                  $sendung_an = mysqli_query($sql, $sendung_ab);
                  while($sendung = mysqli_fetch_array($sendung_an)) {
                    $datum = date("d.m.Y", strtotime($sendung['datum']));
                    echo "<option name='sendung' value='".$sendung['sendungID']."' data-subtext='l&auml;uft am ".$datum."'>".$sendung['name']."</option>";
                  }
                ?>
                </optgroup>
                </select>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Los!</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <!--Modal für Studiocrew Ende-->
  <!--Ende der Modals-->