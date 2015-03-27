<!--
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Test de vérification de champs</title>
		<meta charset="utf-8">
		<script type="text/javascript" src="jquery.js"></script>
		<script>
			$(document).ready(function(){
				$("input").focus(function(){
					var info_form=$(this).next(".info");
					inf_form.empty();
				});

				$("input").blur(function(){
					var name=($(this).attr("name"));
					var value=($(this).attr("value"));
					var info_form=$(this).next(".info");
					if(value==undefined)
					{
						info_form.append("Obligatoire");
					}
					else if(name=="pseudo")
					{
						
					}
				});
			});
		</script>
	</head>

	<body>
		<form action="action.php">
			<p>
				Pseudo : <input type="text" name="pseudo" onblur="verifPseudo(this)" />
			</p>
		</form>
	</body>
</html>
-->

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>TEST Ajax JQuert</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery/com/jquery-1.10.2.js"></script>
		<script scr="//code.jquery/com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
			$(document).ready(function(){
				$("input").focus(function(){
					var info_form=$(this).next(".info");
					inf_form.empty();
				});

				$("input").blur(function(){
					var name=($(this).attr("name"));
					var value=($(this).attr("value"));
					var info_form=$(this).next(".info");
					if(value==undefined)
					{
						info_form.append("Obligatoire");
					}
					else
					{

					}
				});
			});
		</script>
	</head>

	<body>
		<form action="action.php">
			<p>	
				Commune : <input type="text" name="pseudo" onblur="verifPseudo(this)" />
			</p>
		</form>
	</body>
</html>



<!--
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Autocomplete - Default functionality</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
var availableTags = [
"ActionScript",
"AppleScript",
"Asp",
"BASIC",
"C",
"C++",
"Clojure",
"COBOL",
"ColdFusion",
"Erlang",
"Fortran",
"Groovy",
"Haskell",
"Java",
"JavaScript",
"Lisp",
"Perl",
"PHP",
"Python",
"Ruby",
"Scala",
"Scheme"
];
$( "#tags" ).autocomplete({
source: availableTags
});
});
</script>
</head>
<body>
<div class="ui-widget">
<label for="tags">Tags: </label>
<input id="tags">
</div>
</body>
</html>
-->