<?php
	
?>
	<script type="text/javascript" src="../includes/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../includes/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../includes/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script type="text/javascript" src="../includes/jquery.countdown.js"></script>
	<script type="text/javascript" src="../includes/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

//Funktion für die Sidebar auf der Bearbeitungsseite für Sendungen
    $('#toggle').click(function(){
    	$('#sideInfo').slideToggle('slow'); //fadeToggle slideToggle
    })

//Funktion für die "Datums"-Felder auf jeder Seite
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

//Funktion für den Countdown auf der Startseite
    $('#clock').countdown('2015/11/18 09:15', function(event) {
    	$(this).html(event.strftime('%D Tage %H:%M:%S'));
    })

})
</script>

</body>
</html>