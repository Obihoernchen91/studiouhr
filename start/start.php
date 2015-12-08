<?php
$title = basename(__FILE__, ".php");
include "../includes/navbar.php";

?>
<!--Anzeige der Button im Startmenü-->

			<h1 style="text-align:center" class="page-header">Studiouhr</br><small>Zeit bis zu den Vortr&auml;gen: </small><small id="clock"></small></h1>
			<div class="row">
				<div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4">
				<?php
				if(isset($_GET['login'])) {echo "<div class='alert alert-success' role='alert' style='text-align:center;'>
													Du hast dich erfolgreich eingeloggt
												</div>";}
				if(isset($_GET['entry'])) {echo "<div class='alert alert-danger' role='alert' style='text-align:center;'>
													<b>Oh Oh!</b></br>Du hast nicht die n&ouml;tigen Berechtigungen, um auf diese Sendung zuzugreifen.</br>
													Bitte wende dich an den entsprechenden Verantwortlichen!
												</div>";}
				?>

				<a href="../planung/sendung.php" style="text-decoration:none;"><button type="submit" class="btn btn-primary" id="startButton">Planung</button></a>
				<button type="button" class="btn btn-primary" id="startButton" data-toggle="modal" data-target="#crew">Studio Crew</button>
				<button type="button" class="btn btn-primary" id="startButton" data-toggle="modal" data-target="#moderation">Moderation</button>
				<a href="../nutzer/nutzerverwaltung.php" style="text-decoration:none;"><button type="submit" class="btn btn-warning" id="startButton" style="height:62px;">Nutzerverwaltung</button></a>

			</div>
		</div>
	</div>
<!--Ende der Anzeige-->

<?php
include "../includes/footer.php";
?>