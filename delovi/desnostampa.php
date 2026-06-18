
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="white">

<tr>
<td style="width:15%;" align="right" valign="middle">
<font face="Trebuchet MS" color="darkblue" size="2px">
<b>&nbsp;датум: <?php echo date("d.m.Y.");  ?></b></br> </font>
</td>

<td align="left" valign="middle"> 

</td>

<td style="width:5%;">
</td>
</tr>

<tr>
<td style="width:15%;">
</td>

<td align="center" valign="middle"> 
<font face="Trebuchet MS" color="darkblue" size="5px">
<b>SPISAK PREDSTAVA</br> </font>
</td>

<td style="width:5%;">
</td>
</tr>


<tr>
<td style="width:15%;">
</td>

<td align="left">
<br/>
<font face="Trebuchet MS" color="darkblue" size="4px">

<?php

// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA INDEX.PHP

if ($PredstavaViewObject->BrojZapisa==0)
{
	echo "НЕМА ЗАПИСА У ТАБЕЛИ!";
}
else
{
	// ------------ zaglavlje ----------------
	echo "<table style=\"width:90%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"white\">";
	echo "<tr>";
	echo "<td style=\"width:10%;\">";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">IDPredstave</font><br/>";
	echo "</td>";
	echo "<td style=\"width:20%;\">";
	echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Naziv</font><br/>";
	echo "</td>";
	echo "<td style=\"width:20%;\">";
	echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Opis</font><br/>";
	echo "</td>";
	echo "<td style=\"width:50%;\">";
	echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Naziv Zanra</font><br/>";
	echo "</td>";
	echo "</tr>";

	for ($RBZapisa = 0; $RBZapisa < $PredstavaViewObject->BrojZapisa; $RBZapisa++) 
	{
						
	// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
	$IDPredstave=$PredstavaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($PredstavaViewObject->Kolekcija, $RBZapisa, 0);//mysql_result($result,$row,"REGISTARSKIBROJ");
	$Naziv=$PredstavaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($PredstavaViewObject->Kolekcija, $RBZapisa, 1);
	$Opis=$PredstavaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($PredstavaViewObject->Kolekcija, $RBZapisa, 2);
	$NazivZanra=$PredstavaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($PredstavaViewObject->Kolekcija, $RBZapisa, 4);
	$NazivFajlaFotografije=$PredstavaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($PredstavaViewObject->Kolekcija, $RBZapisa, 3);

	// CRTANJE REDA TABELE SA PODACIMA
	echo "<tr>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$IDPredstave</font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$Naziv</font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$Opis</font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$NazivZanra</font><br/>";
	echo "</td>";
	echo "</tr>";

	}  //za for 

	// ISPOD PODATAKA JE UKUPNO
	echo "<tr>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
	echo "</td>";
	echo "<td align=\"right\" valign=\"middle\">"; 
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">УКУПНO: ".$PredstavaViewObject->BrojZapisa."</font>&nbsp;&nbsp;<br/>";
	echo "</td>";
	echo "</tr>";


	echo "</table>";
}
$KonekcijaObject->disconnect();

?>

</td>

<td style="width:5%;">
</td>

</tr>


<tr>
<td style="width:15%;">
</td>

<td align="right" valign="middle"> 
<?php
	echo "<br/>";
	echo "<br/>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">Одговорно лице</font><br/>";
	echo "<br/>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">_______________________</font><br/>";
	?>
</td>

<td style="width:5%;">
</td>
</tr>

</tr>
</table>

    