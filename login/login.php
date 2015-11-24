<!DOCTYPE html>
<html>
<head>
  <title>Studiouhr - <?php echo basename(__FILE__, ".php"); ?></title>

  	<link rel="stylesheet" href="../includes/bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="../includes/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../includes/jquery-ui-1.11.4/jquery-ui.min.css">

	<script type="text/javascript" src="../includes/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../includes/jquery-2.1.4.min.js"></script>
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
  
</head>
<body>

<?php

	include_once '../includes/functions.php';
	include_once '../includes/connect.php';

	sec_session_start();

	if(!login_check($sql)) {
?>

	<div class="row">
		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
			<h1 style="text-align:center" class="page-header">Login</h1>

			<div class="row">
				<div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4">
				<?php
				if(isset($_GET['fehler'])) {echo "<div class='alert alert-danger' role='alert'><b>Oh nein!</b> Nutzername oder Passwort falsch. Bitte &uuml;berpr&uuml;fe deine Angaben!</div>";}
				if(isset($_GET['anm'])) {echo "<div class='alert alert-danger' role='alert'><b>STOP!</b> Sie m&uuml;ssen sich zuerst anmelden!</div>";}
				if(isset($_GET['out'])) {echo "<div class='alert alert-success' role='alert'><b>Super!</b> Sie haben sich erfolgreich ausgeloggt.</div>";}
				?>
					<form method="POST" action="c_login.php">
						<table class="table">
							<tr><td><div class="input-group" style="width: 400px;">
										<span class="input-group-addon" id="name" style="width: 100px;">Login</span>
										<input type="text" class="form-control" placeholder="Ihr Name..." aria-describedby="name" name="name" required>
									</div>
							</td></tr>
							<tr><td><div class="input-group" style="width: 400px;">
										<span class="input-group-addon" id="password" style="width: 100px;">Passwort</span>
										<input type="password" class="form-control" placeholder="Passwort" aria-describedby="password" name="passwort" required>
									</div>
							</td></tr>
							<tr><td><input type="submit" value="Login" class="btn btn-primary"></td></tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php
	}
	else {header("Location: ../start/start.php");}
?>

</body>
</html>