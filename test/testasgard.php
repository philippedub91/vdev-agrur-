<!DOCTYPE html>
	<html>
		<head>
			<link type="text/css" rel="stylesheet" href="../test/jquery/jquery.autocomplete.css" />
			<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
			<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		</head>
		<body>
			<form method="post" action="">
				<p>Nom :</p> <input type="text"  id="auton" name="nom" size="12" /><br />
					<script>
						$(function(){
							$("#auton").autocomplete({
								source: 'autocomplete.php',
							});
						});
					</script>
				<p>Pr&eacute;nom : </p> <input type="text" id="autop" name="prenom" size="12" /><br />
			</form>
		</body>
	</html>