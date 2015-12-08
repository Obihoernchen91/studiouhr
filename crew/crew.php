<?php
	$title = basename(__FILE__, ".php");
	include "../includes/navbar.php";

		if(sendung_check($sql, $_GET['sendung'])) {

			if(isset($_GET['sendung']) AND $_GET['sendung'] != '') {
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

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
		<div id="realtimeClock"></div>
		<h1 style="text-align:center" class="page-header">&Uuml;bersicht f&uuml;r Studiocrew</h1>		
			<form method="post" action="c_sendung.php">
				<table class="table table-hover table-responsive" id="crew">
					<thead>
						<tr><th></th>
							<th>Position</th>
							<th>Inhalt</th>
							<th>Typ</th>
							<th>Dauer</th>
							<th>Dauer ges.</th>
						</tr>
					</thead>
					<tbody>
					<?php
						while($positionen = mysqli_fetch_array($positionen_an)) {
							echo "<tr><td style='text-align:center; vertical-align:middle;'><span class='glyphicon glyphicon-resize-vertical'></span></td>";
							echo "<td style='vertical-align:middle;'><input type='number' name='pos[]' style='width: 35px; text-align:center;' value='".$positionen['position']."' readonly></td>";
							echo "<td style='vertical-align:middle;'><input type='text' value='".$positionen['inhalt']."' name='inhalt[]' style='width: 200px;'></td>";
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
							echo "<td style='vertical-align:middle;'><input id='time' type='text' value='".$positionen['dauer']."' name='dauer[]' style='width: 80px;' placeholder='hh:mm:ss'></td>";
							echo "<td style='vertical-align:middle;'><input id='time' type='text' value='".$positionen['dauer_ges']."' name='dauer_ges[]' style='width: 80px;' placeholder='hh:mm:ss'></td>";
						}
						echo "<tr style='display:none;'><td colspan='6'><input type='text' name='sendungID' value='".intval(mysqli_real_escape_string($sql, trim($_GET['sendung'])))."'></td></tr>";
						?>
					</tbody>
				</table>
				<input type="submit" value="Speichern" name="update_sendung" class="btn btn-primary" style="float:left; margin:0 5px;">
				<a href="../start/start.php"><button type="button" class="btn btn-primary">Zur&uuml;ck zum Hauptmen&uuml;</button></a>
			</form>
		</div>
	</div>
</div>

<?php
}}
else {
?>

	<div class="row">
		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
			<h1 style="text-align:center" class="page-header">&Uuml;bersicht f&uuml;r Studiocrew</h1>
			<div class="row">
				<div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4">
					<table>
						<tr><td>
							<form action="" method="get">
								<div class="input-group" style="width:300px; margin: 5px;">
								    <div class="btn-group bootstrap-select input-group-btn form-control">
										<select id="search" style="height: 125px;" name="sendung" class="selectpicker show-tick form-control" title="Sendung w&auml;hlen" data-live-search="true">
										<optgroup label="Ihre verfügbaren Sendungen">
										<?php
											$sendung_ab = "SELECT * FROM sendungen ORDER BY zeitstempel ASC;";
											$sendung_an = mysqli_query($sql, $sendung_ab);
											while($sendung = mysqli_fetch_array($sendung_an)) {
												echo "<option name='sendung' value='".$sendung['sendungID']."'>".$sendung['name']."</option>";
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

<?php
}}
else {header("Location: ../start/start.php?entry");}
include "../includes/footer.php";
?>