<?php
session_start();

$IDPredstaveZaStampu = $_POST['IDPredstaveFilter'] ?? null;


	require "klase/BaznaKonekcija.php";
	$KonekcijaObject = new Konekcija("klase/BaznaParametriKonekcije.xml");
	$KonekcijaObject->connect();
	
	
	require "klase/BaznaTabela.php";
	require "klase/DBPredstavaV.php";
	$PredstavaObject = new DBPredstava($KonekcijaObject, 'Predstava');
	$PredstavaObject->DajSvePodatkeOPredstavama($IDPredstaveZaStampu);
	$KolekcijaZapisaPredstava= $PredstavaObject->Kolekcija;
	$UkupanBrojZapisaPredstava = $PredstavaObject->BrojZapisa;
	
	if ($UkupanBrojZapisaPredstava>0) 
	{
		$row=0;  
		$IDPredstave=$PredstavaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaPredstava, $row, 0);
		$Naziv=$PredstavaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaPredstava, $row, 1);
		$Opis=$PredstavaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaPredstava, $row, 2);
		$NazivZanra=$PredstavaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaPredstava, $row, 4);
		$NazivFajlaFotografije=$PredstavaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaPredstava, $row, 3);
	}         

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>ТФ М Пупин</title>
<meta charset="UTF-8">
<!-----STIL PRIKAZA CSS---->
<!-----<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">--->
<!----- POSTAVLJEN U PHP DA BI SE ODMAH VIDELA PROMENA, A NE DA VUCE IZ KESIRANOG FOLDERA U BROWSERU---->
<?php include 'css/stil.php';?>
</head>
<body>

<!-----VELIKA TABELA KOJA SADRZI SVE---->
<!-----10% SADRZAJ 10%---->
<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" style="border-spacing: 0;">

<!-------------------------- ZAGLAVLJE ------->
<?php include 'delovi/zaglavljestampa.php';?>


<!-------------------------- DONJI DEO  ------->
<tr style="padding:0px;">

<!-----LEVO PRAZNINA---->
<td style="width:10%;">
</td>

<!------------------------------------------------------------------------------------------->
<!---------------------- SREDINA DONJEG DELA SA SADRZAJEM pocinje ovde ---------------------->
<td align="center" valign="middle" style="width:80%; padding:0" > 

<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">

<tr>
<td style="width:1%;">
</td>

<?php echo "<td align=\"right\" valign=\"middle\">"; ?>
<!------- GLAVNI SADRZAJ desno ----------->  
<?php include 'delovi/desnostampaopredstavi.php';?>
</td>

<td style="width:1%;">
</td>

</tr>
</table>

</td>
<!---------------------- SADRZAJ zavrsava ovde ---------------------->

<!-----DESNO PRAZNINA---->
<td style="width:10%;">
</td>

</tr>
<!---------------------- DONJI DEO zavrsava ovde ---------------------->


<tr style="padding:0px;">
<td style="width:10%;"></td>
<td align="center" valign="middle"></td>
<td style="width:10%;"></td>
</tr>
<!--- DONJI DEO sa donjom ivicom zavrsava ovde  ------->
<!-- footer panel starts here -->
<?php include 'delovi/footerstampa.php';?>

</table>

</body>
</html>