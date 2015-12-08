<?php
	$title = basename(__FILE__, ".php");
	include_once "../includes/navbar.php";
?>


<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
			<h1 style="text-align:center" class="page-header">Studiouhr</h1>
			<div class="container">
				<div class="row">
					<div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4 col-md-offset-2 col-md-4">
						<?php 	if(isset($_GET['del'])) {echo "<div class='alert alert-success' role='alert'><b>Super!</b> Sendung wurde erfolgreich gel&ouml;scht</div>";}
								if(isset($_GET['fehl'])) {echo "<div class='alert alert-danger' role='alert'><b>Oh Oh!</b> Etwas ist bei der Erstellung schief gelaufen!</div>";}
						?>
						<table>
							<tr><td><button type="submit" class="btn btn-primary" style="height:125px; width: 300px; font-size: 30px; margin: 5px;">Nutzer hinzufügen</button></td></tr>
							<tr><td style="text-align:center;"><h3>oder</h3></td></tr>
							<tr><td>
								<form action="nutzer.php" method="GET">
									<div class="input-group" style="width:300px; margin: 5px;">
									    <div class="btn-group bootstrap-select input-group-btn form-control">
											<select id="search" style="height: 125px;" name="nutzer" class="selectpicker show-tick form-control" title="Nutzer auswählen" data-live-search="true">
											<optgroup label="verfügbare Nutzer">
											<?php
												$nutzer_ab = "SELECT * FROM nutzer ORDER BY name ASC;";
												$nutzer_an = mysqli_query($sql, $nutzer_ab);
												while($nutzer = mysqli_fetch_array($nutzer_an)) {
													echo "<option value='".$nutzer['nutzerID']."' data-subtext='Login: ".$nutzer['login']."'>".$nutzer['vorname']." ".$nutzer['name']."</option>";
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
	</div>
</div>



<?php
include "../includes/footer.php";
?>