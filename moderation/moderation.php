<?php
	$title = basename(__FILE__, ".php");
	include "../includes/navbar.php";

	$sendungID = intval(trim($_GET['sendung']));
	$sendung_ab = "SELECT * FROM sendungen WHERE sendungID = '{$sendungID}';";
	$sendung_an = mysqli_query($sql, $sendung_ab);
	$sendung = mysqli_fetch_array($sendung_an);
?>

<div class="container">
	<div class="row">
		<div>
			<table class="table" id="moderation">
				<thead>
					<tr><th colspan="3"><?php echo "Titel: ".$sendung['name']; ?></th></tr>
					<tr><th colspan="2"><?php echo "Dauer: ".$sendung['dauer']; ?></th><th><?php echo "Echtzeit: <span id='time'></span>"; ?></th></tr>
				</thead>
				<tbody>

				<?php
				$positionen_ab = "	SELECT * FROM positionen
									WHERE sendungID = '{$sendungID}'
									AND dauer != '00:00:00'
									ORDER BY position ASC
									LIMIT 3;";
				$positionen_an = mysqli_query($sql, $positionen_ab);
				$position = array();
				while($positionen = mysqli_fetch_array($positionen_an)) {
					echo "<tr>";
					echo "<td>".$positionen['position']."</td>";
					echo "<td>".$positionen['inhalt']."</td>";
					echo "<td>".$positionen['dauer']."</td>";
					echo "</tr>";
				}

				function renew() {
					$positionen_ab = "	SELECT * FROM positionen
										WHERE sendungID = '{$sendungID}'
										AND dauer != '00:00:00'
										ORDER BY position ASC
										LIMIT 3;";
					$positionen_an = mysqli_query($sql, $positionen_ab);
					$position = array();
					while($positionen = mysqli_fetch_array($positionen_an)) {
						echo "<tr>";
						echo "<td>".$positionen['position']."</td>";
						echo "<td>".$positionen['inhalt']."</td>";
						echo "<td>".$positionen['dauer']."</td>";
						echo "</tr>";
					}
				}
				?>

				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
include "../includes/footer.php";
?>