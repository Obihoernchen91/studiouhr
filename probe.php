<!DOCTYPE html>
<html>
<head>
  <title>Studiouhr</title>


	<link rel="stylesheet" href="includes/style.css">
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap-theme.min.css">

    <script type="text/javascript" src="includes/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="includes/jquery-ui-1.11.4/jquery-ui.min.css">
    <script type="text/javascript" src="includes/jquery-2.1.4.min.js"></script>

    <link rel="stylesheet" href="includes/bootstrap-select/dist/css/bootstrap-select.css">
    <script src="includes/bootstrap-select/dist/js/bootstrap-select.js"></script>

    <script type="text/javascript" src="includes/jquery.countdown.js"></script>

    <script src="includes/bootstrap/js/bootstrap.min.js"></script>


<!--
  <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="includes/bootstrap-datepicker/css/datepicker.css">

  <script type="text/javascript" src="includes/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="includes/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="includes/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="includes/moment.min.js"></script>
  <script type="text/javascript" src="includes/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
-->
  
	<script type="text/javascript">
    $(document).ready(function() {

      $('#toggle').click(function(){
        $('#sideInfo').slideToggle('slow'); //fadeToggle slideToggle
      })

      $('#clock').countdown('2015/11/06 09:00', function(event) {
        $(this).html(event.strftime('%D Tage und %H:%M:%S'));
        
      })

    })
  </script>

<!--
<script type="text/javascript">
  $(document).ready(function(){
    //$('#datetimepicker1').val('Hallo');
    $('#datetimepicker1 input').datetimepicker();
  })
</script>
-->

</head>
<body>
<h1 style="text-align:center" class="page-header">Probecenter</h1>



<!--JQuery Countdown Probe-->
<div id="clock"></div>



<!--Bootstrap Date - Time - Picker Probe
<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <input type="text" class="form-control"  id="datetimepicker1"/>
        </div>
    </div>
</div>
-->

</body>
</html>