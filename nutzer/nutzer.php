<?php
if(isset($_GET['nutzer']) && $_GET['nutzer'] != '') {
	$title = basename(__FILE__, ".php");
	include "../includes/navbar.php";

		$nutzerID = intval(mysqli_real_escape_string($sql, trim($_GET['nutzer'])));

		$nutzer_ab = "SELECT * FROM nutzer WHERE nutzerID = '".$nutzerID."';";
		$nutzer_an = mysqli_query($sql, $nutzer_ab);
		$nutzer = mysqli_fetch_array($nutzer_an);
?>
		<h1 class="page-header" style="text-align:center;">Nutzerverwaltung f&uuml;r <?php echo $_SESSION['name'] ?></h1>
		<div class="row">
			<div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4 col-md-offset-3 col-md-6">
				<!--Allgemeine Daten in der Nutzerverwaltung-->
				<div class="panel panel-info">
					<div class="panel panel-heading" style="text-align:center; font-size:20px;">
						Allgemeine Daten
					</div>
					<div class="panel-body">
						<div class="input-group">
							<span class="input-group-addon">Vorname</span>
							<input type="text" <?php echo "value='".$nutzer['vorname']."'"; ?> class="form-control" placeholder="Vorname">
						</div>
						</br>
						<div class="input-group">
							<span class="input-group-addon">Nachname</span>
							<input type="text" <?php echo "value='".$nutzer['name']."'"; ?> class="form-control" placeholder="Nachname">
						</div>
						</br>
						<div class="input-group">
							<span class="input-group-addon">Login</span>
							<input type="text" <?php echo "value='".$nutzer['login']."'"; ?> class="form-control" placeholder="Login">
						</div>
						</br>
						<div class="input-group">
							<span class="input-group-addon">Passwort</span>
							<input type="text" class="form-control" placeholder="Passwort">
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Übersicht über die Sendungen-->
		<div class="row">
			<!--erste Spalte-->
			<div class="col-md-6">
				<!--erste Zeile: Sendungen mit Verantwortlichkeit-->
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-warning">
							<div class="panel-heading" style="text-align:center; font-size:20px;">
								Sendungen mit Verantwortlichkeit
							</div>
							<div class="panel-body">
								<select size="5" multiple class="form-control">
									<?php 
										$verant_ab = "	SELECT * FROM sendungen
														WHERE verantwortlicher = '".$nutzerID."'
														AND datum >= '".date("Y-m-d", time())."'
														ORDER BY datum ASC;";
										$verant_an = mysqli_query($sql, $verant_ab);
										while ($verant = mysqli_fetch_array($verant_an)) {
											echo "<option disabled value='".$verant['sendungID']."'>".$verant['name']."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<!--zweite Zeile: Sendungen zu denen man eingeladen wurde-->
				<div class="row">
					<div class="col-md-10">
						<div class="panel panel-warning">
							<div class="panel-heading" style="text-align:center; font-size:20px;">
								Sendungen mit Zugriff
							</div>
							<div class="panel-body">
								<select size="5" multiple class="form-control">
									<?php 
										$einladung_ab = "	SELECT * FROM sendungen, nutzer_sendung
															WHERE sendungen.sendungID = nutzer_sendung.sendungID
															AND nutzer_sendung.nutzerID = '".$nutzerID."'
															AND datum >= '".date("Y-m-d", time())."'
															ORDER BY datum ASC;";
										$einladung_an = mysqli_query($sql, $einladung_ab);
										while ($einladung = mysqli_fetch_array($einladung_an)) {
											echo "<option value='".$einladung['sendungID']."'>".$einladung['name']."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<!--zweite Zeile, zweite Spalte: Buttons für das Hinzufügen von Sendungen-->
					<div class="col-md-2">
						<?php 
						if($nutzer['rollenID'] == 1) {
							echo "	<button type='button'>&gt;&gt;</button></br>
									<button type='button'>&lt;&lt;</button>";
						}
						?>
					</div>
				</div>
				<!--dritte Zeile: vergangene Sendungen zu denen man Zugang hatte-->
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-warning">
							<div class="panel-heading" style="text-align:center; font-size:20px;">
								vergangene Sendungen mit Zugang
							</div>
							<div class="panel-body">
								<select size="5" multiple class="form-control">
									<?php 
										$vergangen_ab = "	SELECT * FROM sendungen
															WHERE verantwortlicher = '".$nutzerID."'
															AND datum < '".date("Y-m-d", time())."'
															ORDER BY datum ASC;";
										$vergangen_an = mysqli_query($sql, $vergangen_ab);
										while ($vergangen = mysqli_fetch_array($vergangen_an)) {
											echo "<option disabled value='".$vergangen['sendungID']."'>".$vergangen['name']."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--zweite Spalte: verfügbare Sendungen-->
			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading" style="text-align:center; font-size:20px;">
						verf&uuml;gbare Sendungen
					</div>
					<div class="panel-body">
						<select size="28" multiple class="form-control">
							<?php 
								$alle_ab = "	SELECT * FROM sendungen
													WHERE verantwortlicher = '".$nutzerID."'
													AND datum >= '".date("Y-m-d", time())."'
													ORDER BY datum ASC;";
								$alle_an = mysqli_query($sql, $alle_ab);
								while ($alle = mysqli_fetch_array($alle_an)) {
									echo "<option value='".$alle['sendungID']."'>".$alle['name']."</option>";
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>

<?php
}
else {header("Location: ../index.php?berechtigung");}
include "../includes/footer.php";
?>