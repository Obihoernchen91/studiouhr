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
    	$('#sideInfo').toggle('drop', 800);
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
	function realtimeClock() {
		$('#realtimeClock').text(moment().format('H:mm:ss') + " Uhr");
	}
	setInterval(realtimeClock, 1000);

//#########################################################
//Funktion, um eine neue Zeile mit einem Klick hinzuzufügen
//#########################################################
    var laenge = $('tbody tr').length-1;
    //-1, da bei jedem Klick die Länge am Anfang um 1 erhöht werden muss --> es gibt noch ein verstecktes TD mit SendungsID (letztes)
	
	$('#addRow').click(function(){
		laenge += 1;
		    var input1 = '<td style="text-align:center; vertical-align:middle;"><span class="glyphicon glyphicon-resize-vertical"></span></td>';
	    	var input2 = '<td><input type="number" name="pos['+ laenge +']" style="width: 35px; text-align:center;" value="'+ laenge +'" readonly></td>';
	    	var input3 = '<td><input type="text" value="" name="inhalt['+ laenge +']" style="width: 200px;""></td>';
	    	var input4 = '<td><select name="typ['+ laenge +']"><option value="1">MAZ</option><option value="2">Studio</option></select></td>';
	    	var input5 = '<td><input id="time" type="text" value="00:00:00" name="dauer['+ laenge +']" style="width: 80px;" placeholder="hh:mm:ss"></td>';
	    	var input6 = '<td><input id="time" type="text" value="00:00:00" name="dauer_ges['+ laenge +']" style="width: 80px;" placeholder="hh:mm:ss" readonly></td>';
	    var input = '<tr>' + input1 + input2 + input3 + input4 + input5 + input6 + '<tr>';

		$('tbody tr:nth-last-child(2)').after(input);
	});

});
</script>

</body>
</html>