<?php
	$title = basename(__FILE__, ".php");
	include_once "../includes/navbar.php";


		##############################################
		#Menü, wenn man eine Sendung bearbeiten möchte
		##############################################

		if(isset($_GET['sendung']) AND $_GET['sendung'] != '') {
			if(sendung_check($sql, $_GET['sendung'])) {
				$sendung_ab = "SELECT * FROM sendungen WHERE sendungID = '".intval(mysqli_real_escape_string($sql, trim($_GET['sendung'])))."';";
				$sendung_an = mysqli_query($sql, $sendung_ab);
				$sendung_anz = mysqli_num_rows($sendung_an);
					if($sendung_anz == 1) {
						$positionen_ab = "	SELECT * FROM positionen 
											WHERE sendungID = '".intval(mysqli_real_escape_string($sql, trim($_GET['sendung'])))."'
											ORDER BY position ASC;";
						$positionen_an = mysqli_query($sql, $positionen_ab);

						$sendung = mysqli_fetch_array($sendung_an);

	?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
			<h1 style="text-align:center" class="page-header">Sendung bearbeiten</h1>

			<!--Meldungen ausgeben-->
			<?php 	if(isset($_GET['update'])) {echo "<div class='alert alert-success' role='alert' style='text-align:center;'>
														<button type='button' class='close' data-dismiss='alert' aria-label='Schließen'>
														  <span aria-hidden='true'>&times;</span>
														</button>
														<b>Super!</b> Sendung wurde erfolgreich geupdated!</div>";}
					if(isset($_GET['fehl'])) {echo "<div class='alert alert-danger' role='alert' style='text-align:center;'>
														<button type='button' class='close' data-dismiss='alert' aria-label='Schließen'>
														  <span aria-hidden='true'>&times;</span>
														</button>
														<b>Oh Oh!</b> Es ist ein Fehler beim Speichern aufgetreten.</br>Bitte noch einmal versuchen.</div>";}
					if(isset($_GET['erstellt'])) {echo "<div class='alert alert-success' role='alert' style='text-align:center;'>
														<button type='button' class='close' data-dismiss='alert' aria-label='Schließen'>
														  <span aria-hidden='true'>&times;</span>
														</button>
														<b>Super!</b> Die Sendung wurde erfolgreich erstellt.</div>";}
			?>
				

						<form method="post" action="c_sendung.php">
							<div class="btn-group">
								<button type="submit" name="update_positionen" class="btn btn-success">Speichern</button>
								<button type="button" id="toggle" class="btn btn-default">Info ein- / ausblenden</button>
							</div>
								<button type="submit" name="delete_sendung" class="btn btn-danger">Sendung l&ouml;schen</button>
							
							<table class="table table-hover">
								<thead>
									<tr><th>Position</th>
										<th>Inhalt</th>
										<th>Typ</th>
										<th>Dauer</th>
										<th>Dauer ges.</th>
									</tr>
								</thead>
								<tbody>
								<?php
									while($positionen = mysqli_fetch_array($positionen_an)) {
										
										echo "<tr><td><input type='number' name='pos[]' style='width: 35px; text-align:center;' value='".$positionen['position']."' readonly></td>";
										echo "<td><input type='text' value='".$positionen['inhalt']."' name='inhalt[]' style='width: 200px;'></td>";
										echo "<td>";
											echo "<select name='typ[]' class='selectpicker form-control'>";
												$typ_ab = "SELECT * FROM typen ORDER BY typ ASC;";
												$typ_an = mysqli_query($sql, $typ_ab);
												while($typen = mysqli_fetch_array($typ_an)) {
													if($typen['typID'] == $positionen['typID']) {
														echo "<option selected value='".$typen['typID']."'>".$typen['typ']."</option>";
													}
													else {echo "<option value='".$typen['typID']."'>".$typen['typ']."</option>";}
												}
											echo "</select>";
										echo "</td>";
										echo "<td><input id='time' type='text' value='".$positionen['dauer']."' name='dauer[]' style='width: 80px;' placeholder='hh:mm:ss'></td>";
										echo "<td><input id='time' type='text' value='".$positionen['dauer_ges']."' style='width: 80px;' placeholder='hh:mm:ss' readonly='readonly'></td>";

									}
									echo "<input type='text' name='sendungID' value='".intval(mysqli_real_escape_string($sql, trim($_GET['sendung'])))."' style='display:none;'>";
									?>
								</tbody>
							</table>	
						</form>

				
			</div>

			<div id="sideInfo" class="row">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<h3 style="text-align:center">Sendungsdaten</h3><hr>
						<form class="form-horizontal" action="c_sendung.php" method="POST">
							<div class="form-group">
						    	<label for="sendungName" class="col-sm-4 control-label">Name</label>
							    <div class="col-sm-8">
							    	<input type="text" class="form-control" id="sendungName" name="sendungName" <?php echo "value='".$sendung['name']."'"; ?> placeholder="Name der Sendung..." required>
							    </div>
							</div>
							<div class="form-group">
								<label for="sendungErstelltAm" class="col-sm-4 control-label">erstellt am</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="sendungErstelltAm" name="sendungErstelltAm" <?php echo "value='".date("d.m.Y", strtotime($sendung['zeitstempel']))."'"; ?> placeholder="erstellt am..." required>
								</div>
							</div>
							<div class="form-group">
								<label for="datum" class="col-sm-4 control-label">geplanter Start</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="datum" name="sendungGeplStart" <?php echo "value='".date("d.m.Y", strtotime($sendung['datum']))."'"; ?> placeholder="geplanter Start..." required>
								</div>
							</div>
							<div class="form-group">
								<label for="sendungGeplDauer" class="col-sm-4 control-label">geplante Dauer</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="sendungGeplDauer" name="sendungGeplDauer" <?php echo "value='".$sendung['dauer']."'"; ?> placeholder="geplante Dauer..." required>
								</div>
							</div>
							<div class="form-group">
								<label for="sendungVerantwortlicher" class="col-sm-4 control-label">Verantwortlicher</label>
								<div class="col-sm-8">
									<?php
									echo "<select name='sendungVerantwortlicher' class='selectpicker form-control' data-live-search='true' title='Verantwortlichen w&auml;hlen' required>";
										$nutzer_ab = "SELECT * FROM nutzer ORDER BY vorname ASC;";
										$nutzer_an = mysqli_query($sql, $nutzer_ab);
										while($nutzer = mysqli_fetch_array($nutzer_an)) {
											if($nutzer['nutzerID'] == $sendung['verantwortlicher']) {
												echo "<option selected value='".$nutzer['nutzerID']."'>".$nutzer['vorname']." ".$nutzer['name']."</option>";
											}
											else {
												echo "<option value='".$nutzer['nutzerID']."'>".$nutzer['vorname']." ".$nutzer['name']."</option>";
											}
										}
									echo "</select>";
									?>
								</div>
							</div>
							<input type="text" name="sendungID" <?php echo "value='".$_GET['sendung']."'"; ?> style="display:none;">
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-4">
									<button type="submit" name="update_sendung" class="btn btn-success">&Auml;nderungen speichern</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="addPos">
				
			</div>

		</div>
	</div>
	<?php
	}}
	else {header("Location: ../start/start.php?entry");}
	}

	###################################
	#Ansonsten wird Auswahlmenü gezeigt
	###################################
	else {
	?>

	<div class="row">
		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
			<h1 style="text-align:center" class="page-header">Studiouhr</h1>
			<div class="row">
				<div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4">
					<?php 	if(isset($_GET['del'])) {echo "<div class='alert alert-success' role='alert'><b>Super!</b> Sendung wurde erfolgreich gel&ouml;scht</div>";}
							if(isset($_GET['fehl'])) {echo "<div class='alert alert-danger' role='alert'><b>Oh Oh!</b> Etwas ist bei der Erstellung schief gelaufen!</div>";}
					?>
					<table>
						<tr><td><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#create" style="height:125px; width: 300px; font-size: 30px; margin: 5px;">Sendung erstellen</button></td></tr>
						<tr><td style="text-align:center;"><h3>oder</h3></td></tr>
						<tr><td>
							<form action="" method="get">
								<div class="input-group" style="width:300px; margin: 5px;">
								    <div class="btn-group bootstrap-select input-group-btn form-control">
										<select id="search" style="height: 125px;" name="sendung" class="selectpicker show-tick form-control" title="Sendung bearbeiten" data-live-search="true">
										<optgroup label="verfügbare Sendungen">
										<?php
											$sendung1_ab = "SELECT * FROM sendungen, nutzer_sendung 
												        	WHERE sendungen.sendungID = nutzer_sendung.sendungID
												        	AND nutzer_sendung.nutzerID = '".$_SESSION['nutzerID']."'
												        	ORDER BY datum ASC;";
											$sendung1_an = mysqli_query($sql, $sendung1_ab);
											while($sendung1 = mysqli_fetch_array($sendung1_an)) {
												$datum = date("d.m.Y", strtotime($sendung1['datum']));
												echo "<option name='sendung' value='".$sendung1['sendungID']."' data-subtext='gepl. Start: ".$datum."'>".$sendung1['name']."</option>";
											}
										?>
										</optgroup>
										</select>
									</div>
									<span class="input-group-btn">
										<input type="submit" value="Los!" class="btn btn-primary">
									</span>
								</div>
							</form>
						</td></tr>
					</table>
				</div>
			</div>
		</div>
	</div>




<!--Modals für Button-->
	<!--Modal zum Erstellen einer Sendung-->
	<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<form method="POST" action="c_sendung.php">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="createLabel">Sendung erstellen</h4>
	      		</div>
	      		<div class="modal-body">
	        		<table class="table">
	        			<tr><td><div class="input-group">
	        						<span class="input-group-addon" id="name">Name der Sendung</span>
	        						<input type="text" class="form-control" placeholder="Name der Sendung..." aria-describedby="name" name="name" required>
	        					</div>
	        			</td></tr>
	        			<tr><td><div class="input-group">
	        						<span class="input-group-addon" id="pos">Anzahl der Positionen</span>
	        						<input type="number" class="form-control" aria-describedby="pos" name="pos" min="1" required>
	        					</div>
	        			</td></tr>
	        			<tr><td><div class="input-group">
	        						<span class="input-group-addon">Sendungsdatum</span>
	        						<input type="text" class="form-control" aria-describedby="datum" id="datum" name="datum" placeholder="tt.mm.jjjj" required>
	        					</div>
	        			</td></tr>
	        			<tr><td><div class="input-group">
	        						<span class="input-group-addon" id="dauer">geplante Dauer</span>
	        						<input type="text" class="form-control" aria-describedby="dauer" name="dauer" placeholder="hh:mm:ss" required>
	        					</div>
	        			</td></tr>
	        			<tr><td><div class="input-group">
	        						<span class="input-group-addon" id="verantwortlicher">Sendeverantwortung</span>
	        						<?php
	        						echo "<select name='verantwortlicher' class='selectpicker form-control'  data-live-search='true' title='Nutzer ausw&auml;hlen' required>";
	        							$nutzer_ab = "SELECT * FROM nutzer ORDER BY vorname ASC;";
	        							$nutzer_an = mysqli_query($sql, $nutzer_ab);
	        							while($nutzer = mysqli_fetch_array($nutzer_an)) {
	        									echo "<option value='".$nutzer['nutzerID']."'>".$nutzer['vorname']." ".$nutzer['name']."</option>";
	        							}
	        						echo "</select>";
	        						?>
	        					</div>
	        			</td></tr>
	        			<tr><td><div class="input-group">
	        						<span class="input-group-addon" id="einladen">einladen</span>
	        						<?php
	        						echo "<select name='einladen' class='selectpicker form-control' title='Nutzer zu Sendung einladen' data-live-search='true' multiple>";
	        							$einladen_ab = "SELECT * FROM nutzer ORDER BY vorname ASC;";
	        							$einladen_an = mysqli_query($sql, $einladen_ab);
	        							while($einladen = mysqli_fetch_array($einladen_an)) {
	        									echo "<option value='".$einladen['nutzerID']."'>".$einladen['vorname']." ".$einladen['name']."</option>";
	        							}
	        						echo "</select>";
	        						?>
	        					</div>
	        			</td></tr>
	        		</table>
	      		</div>
	      		<div class="modal-footer">
			        <button type="submit" class="btn btn-primary" name="create_sendung">Sendung erstellen</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
				</div>
			</form>
	    </div>
	  </div>
	</div>
	<!--Modal für Studiocrew Ende-->
<!--Modals Ende-->

<?php
}
include "../includes/footer.php";
?>
