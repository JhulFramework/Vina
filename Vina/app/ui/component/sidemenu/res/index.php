<html>
  <head>




	  <link href="menu.css" rel="stylesheet" type="text/css" />
	  <link href="style.css" rel="stylesheet" type="text/css" />

    <title></title>
    <meta content="">
    <style></style>
  </head>
  <body>
	  <?php require(__DIR__.'/menu.php') ?>
	  <div class="main"> <span id="openmenu">button</span> this is contentt

	  </div>

	  <script
			  src="jquery321.js"
			  integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
			  crossorigin="anonymous"></script>
<script>


	//var sidemenu = $("#sidemenu");

	$( "#openmenu" ).click
	(

		function( )
  		{
			$('#sidemenu').css('transition', '0.5s');
			$('#sidemenu').css('width', '240px');
		}
	);

	$( "#closemenu" ).click
	(

		function( )
  		{
			$('#sidemenu').css('width', '0');
		}
	);

</script>
</body>
</html>
