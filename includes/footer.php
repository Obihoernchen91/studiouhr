<?php
	
?>
	<script type="text/javascript" src="../includes/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../includes/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../includes/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script type="text/javascript" src="../includes/jquery.countdown.js"></script>
	<script type="text/javascript" src="../includes/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../includes/moment.js"></script>

<script type="text/javascript">
$(document).ready(function() {

//################################################################
//Funktion für die Sidebar auf der Bearbeitungsseite für Sendungen
//################################################################
    $('#toggle').click(function(){
    	$('#sideInfo').toggle('drop', 500);
    })

//################################################
//Funktion für die "Datums"-Felder auf jeder Seite
//################################################
    $.datepicker.regional['de'] = {
	    closeText: 'fertig',
	    prevText: 'früher',
	    nextText: 'später',
	    currentText: 'heute',
	    monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
	    monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez'],
	    dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
	    dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
	    dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
	    weekHeader: 'KW',
	    dateFormat: 'dd.mm.yy',
	    firstDay: 0,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''};
    $( "#datum" ).datepicker($.datepicker.regional[ "de" ]);

//#############################################
//Funktion für den Countdown auf der Startseite
//#############################################
    $('#clock').countdown('2015/12/18 09:15', function(event) {
    	$(this).html(event.strftime('%D Tage %H:%M:%S'));
    })

//###################################################
//Sortierfunktion für die Positionen in den Sendungen
//###################################################
    $( "tbody" ).sortable({
    	placeholder: "ui-state-highlight",
    	stop: function( event, ui ){
	        $(this).find('tr').each(function(i){
	            $(this).find('td:nth-child(2)').each(function(){
	            	$(this).find("input").val(i+1);
	            })
	        });
    	}
    });
    $( "tbody" ).disableSelection();

//############################################
//Echtzeit als Uhr ausgeben für die Studiocrew
//############################################
//in regelmäßigen Abständen das php-script abfragen, was jedesmal die aktuelle Systemzeit als timestamp zurückgibt(theoretisch)
//diesen dann mit moment.js in passendes Format umwandeln (theoretisch) und ausgeben
//vorher den zurückgegebenen Wert mit 'alert' testen

	function realtimeClock() {
		$.ajax({
		    type: 'POST',
		    async: false,   // WICHTIG! 
		    url: '../includes/zeit.php', //habs mal richtig verlinkt
		    data: ({'time': '1'}),
		    success: function(msg) {
		    	alert(msg);
		    	//$('#realtimeClock').text(moment(msg).format('H:mm:ss') + " Uhr");
		    }
		})
	}
	//setInterval(realtimeClock, 2000); //es nervt derzeit ziemlich

//#########################################################
//Funktion, um eine neue Zeile mit einem Klick hinzuzufügen
//#########################################################
    var laenge = $('tbody tr').length-1;
    //-1, da bei jedem Klick die Länge am Anfang um 1 erhöht werden muss --> es gibt noch ein verstecktes td mit SendungsID (letztes)
	
	$('#addRow').click(function(){
		laenge += 1;
		var id = $('#sendungID').val();
		    var input1 = '<td style="text-align:center; vertical-align:middle;"><span class="glyphicon glyphicon-resize-vertical"></span></td>';
	    	var input2 = '<td><input type="number" name="pos['+ laenge +']" style="width: 35px; text-align:center;" value="'+ laenge +'" readonly></td>';
	    	var input3 = '<td><input type="text" value="" name="inhalt['+ laenge +']" style="width: 200px;""></td>';
	    	var input4 = '<td><select name="typ['+ laenge +']"><option value="1">MAZ</option><option value="2">Studio</option></select></td>';
	    	var input5 = '<td><input id="time" type="text" value="00:00:00" name="dauer['+ laenge +']" style="width: 80px;" placeholder="hh:mm:ss"></td>';
	    	var input6 = '<td><input id="time" type="text" value="00:00:00" name="dauer_ges['+ laenge +']" style="width: 80px;" placeholder="hh:mm:ss" readonly></td>';
	    	var input7 = '<td><button id="deleteButton" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-remove-circle"></span></button></td>';
	    var input = '<tr>' + input1 + input2 + input3 + input4 + input5 + input6 + input7 + '<tr>';
		$('tbody tr:nth-last-child(2)').after(input);
		$.ajax({
		    url: "c_sendung.php?addPosition",
		    type: "post",
		    data: {	'nr': laenge,
		    		'id': id},
		    //success: function(msg){prompt('Nachricht', msg);}
		});
		//location.reload();
	});

//###########################################################
//Funktion, um eine einzelne Zeile mit einem Klick zu löschen
//###########################################################
	/*
	$("tbody #deleteButton").on("click",function() {
        var tr = $(this).closest('tr');
        tr.fadeOut(400, function(){
            tr.remove();
        });

        var position = tr.find('td:nth-child(2)').find('input').val();
        var id = $('#sendungID').val();
        $.ajax({
		    url: "c_sendung.php?deletePosition",
		    type: "post",
		    data: {	'pos':		position,
					'sendung':	id}
		});
        location.reload();
    });
	*/
	if($('tbody').find('tr:first').find('td:nth-child(2)').find("input").val() != 1) {
		$('tbody').find('tr').each(function(i){
	        $(this).find('td:nth-child(2)').each(function(){
	        	$(this).find("input").val(i+1);
	        })
    	});
	}

	//########################################################
	//Funktion, um die aktuelle Sendung mit Button zu starten
	//########################################################
	//funktioniert bisher mit einer Position
	//muss noch dynamisch in Schleifen angepasst werden für alle Positionen
	//die echtzeit wird bisher per Javascript erzeugt (lokal) -> muss noch mit php realisiert werden
	//"Countdown" bis zum Anfang der Sendung kann noch mit "setTimeout - Funktion" generiert werden und die Länge mit einer Variable


	var start = 0;
	$("#sendung_start").click(function(){
		start = 1;
	});

	function starten(){

		if(start == 1) {
			start = 0;
			var pos = $('tbody').find('tr:nth-child(1)').find('td:nth-child(5)').text();
			var dauer = parseInt(moment(pos, "HH:mm:ss").format("mm")) * 60 + parseInt(moment(pos, "HH:mm:ss").format("ss"));
			dauer = moment().add(dauer, "seconds").format("YYYY/MM/DD HH:mm:ss");

			$("#time_1").text(function(){
				$(this).countdown(dauer, function(event) {
					$(this).html(event.strftime('%H:%M:%S'));
				})
			})

			function write () {
				var w_dauer = $('#time_1').text();
				var w_id = $("#sendungID").val();
				var w_pos = "1";
				$.ajax({
				    url: "c_crew.php?update",
				    type: "post",
				    data: {	'dauer': 	w_dauer,
							'id' : 		w_id,
							'pos' : 	w_pos},
				});
			}
			setInterval(write, 1000);
			
		};
	};
	setInterval(starten, 500);

	function neu(){
		<?php renew(); ?>
	}
	setInterval(neu, 1000);

	
});
</script>

</body>
</html>