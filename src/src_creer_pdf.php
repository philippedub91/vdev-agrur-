<?php
//Cette méthode permet de garder en mémoire le contenu HTML
//de cette page. La création d'un PDF nécessitant une redirection, 
//celle-ci echouera si on affiche le contenu HTML. ob_start() permet
//de garder en mémoire le contenu et de ne pas l'afficher pour afficher
//l'erreur de redirection.
ob_start(); 

//Importe le script de connexion à la base de données
include('bdd_connect.php');

//Importe les fonctions
include('fonctions_traitement.php');

//Importe la classe de création de PDF (html2pdf)
require_once('../html2pdf/html2pdf.class.php');


//Vérifie que $_GET(livraison) est set
if(isset($_GET['livraison']))
{
	//Récupère les informations de la livraison
	$sql = $connexion->prepare('SELECT * FROM livraison WHERE id_livraison = :id_livraison');
	$sql->bindParam(':id_livraison', $_GET['livraison']);
	try
	{
		$sql->execute();
		$donnees_livraison = $sql->fetch();
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage.'<br/>');
		echo('<a href="../interface/espace_gestionnaire.php>Cliquez ici pour retourner à la liste des livraisons</a>');
	}
}
else
{
	header('location: ../interface/livraison_gestionnaire.php');
}




?>
<body style="padding: 30px; font-family:arial;">

<table>
	<tr>
		<td><img src="../images/logo.png" height="100"></td>
		<td>
			<b>Coopérative AGRUR</b><br/>
			Avenue De La Noix de Grenoble<br/>
			Bp 42 00075, 38470 Vinay<br/>
			04 76 36 80 33
		</td>
	</tr>
</table>

<br><br><br>

<table style="margin-bottom:30px;">
	<tr style="border-style:solid; border-width:1px; border-color:black; background-color:gray;">
		<td style="text-align:center; width:500px;"><b>LIVRAISONS</b></td>
	</tr>
</table>

<table style="margin-bottom:30px;">
	<tr>
		<td style="width:290px;"><b>Code Livraison : </b><?php echo($donnees_livraison['id_livraison']); ?></td>
		<td><b>Date Livraison : </b><?php echo($donnees_livraison['date_livraison']); ?></td>
	</tr>

	<tr>
		<td style="width:290px;"><b>Producteur :</b></td>
		<td><b>Verger :</b></td>
	</tr>
	<tr>
		<td style="width:290px;">
			Nom de la sociéte<br/>
			Adresse<br/>
			Ville<br/>
		</td>

		<td style="width:290px;">
			<?php echo($donnees_livraison['id_verger'].' - '.getNomVerger($donnees_livraison['id_verger'])); ?>
		</td>
	</tr>
</table>

<table style="margin-bottom:30px;">
	<tr>
		<td style="width:290px;"><b>Variété : </b><?php echo(getLibelleVariete($donnees_livraison['id_variete'])); ?></td>
		<td><b>Quantité :</b><?php echo($donnees_livraison['poids']); ?> Kg</td>
	</tr>
	<tr>
		<td style="width:290px;"><b>Type de produit : </b><?php echo(getNomType($donnees_livraison['type'])); ?></td>
	</tr>
</table>

<table style="margin-bottom:30px;">
	<tr style="border-style:solid; border-width:1px; border-color:black; background-color:gray;">
		<td style="text-align:center; width:500px;"><b>LOTS</b></td>
	</tr>
</table>

<table style="">
	<tr style="border:solid 1mm #000000;">
		<th style="text-align:center; width:100px;">Numéro de lot</th>
		<th style="text-align:center; width:200px;">Calibre</th>
		<th style="text-align:center; width:300px;">Quantité</th>
	</tr>
	<?php
	$sql = $connexion->prepare('SELECT * FROM lot_production WHERE id_livraison = :id_livraison');
	$sql->bindParam(':id_livraison', $donnees_livraison['id_livraison']);
	try
	{
		$sql->execute();
		while($donnees_lot = $sql->fetch())
		{
		?>
			<tr>
				<td style="text-align=center;"><?php echo($donnees_lot['id_lot']); ?></td>
				<td style="text-align=center;"><?php echo(getLibelleCalibre($donnees_lot['calibre'])); ?></td>
				<td style="text-align=center;"><?php echo($donnees_lot['poids']); ?> Kg</td>
			</tr>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
	?>
</table>


<?php
	$content = ob_get_clean();
	try
	{
		$html2pdf = new HTML2PDF("P", "A4", "fr");

		$html2pdf->setDefaultFont("Arial");
		$html2pdf->writeHTML($content);
		$html2pdf->Output("Livraison_L0512.pdf");
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e);
	}
?>











