
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="#D8E7F4">
<tr>
<td style="width:5%;">
</td>

<td align="left">
<br/>
<b><font face="Trebuchet MS" color="darkblue" size="4px">  </font></b>
<table style="width:100%;" bgcolor="#D8E7F4" padding:0" align="center" cellspacing="0" cellpadding="0" border="0">

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<b><font face="Trebuchet MS" color="black" size="3px">IZMENA PODATAKA PREDSTAVA</b></br>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>

<td align="center">


<!------------------------FORMA ZA UNOS ---- ACTION="predstavasnimi.php" --->
<table style="width:50%;" bgcolor="#D8E7F4" padding:0" align="center" cellspacing="0" cellpadding="0" border="0">
<form name="FormaZaUnosPredstava" action="klase/PredstavaController.php" METHOD="POST" enctype="multipart/form-data" >
<input type="hidden" name="akcija" value="izmeni">
<tr>
<td align="right" valign="bottom">     
<b><font face="Trebuchet MS" color="black" size="2px">IDPredstave&nbsp;&nbsp;</font></b>
</td>
<td align="left" valign="bottom">
<input
    name="idPredstave"
    type="text"
    size="50"
    maxlength="10"
    pattern="[0-9]{1,10}"
    inputmode="numeric"
    placeholder="Unesite IDPredstave"
    value="<?php echo htmlspecialchars($StariIDPredstave); ?>"
    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    readonly
/>

<input
    type="hidden"
    name="StariIDPredstave"
    value="<?php echo htmlspecialchars($StariIDPredstave); ?>"
>

</td>
</tr>

<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<b><font face="Trebuchet MS" color="black" size="2px">Naziv&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="Naziv" type="text" size="50" pattern="[A-Z0-9a-zčćšđžČĆŠĐŽ ]+"
    oninput="this.value = this.value.replace(/[^A-Z0-9a-zčćšđžČĆŠĐŽ ]/g, '')" value="<?php echo $StaroNaziv; ?>"/>
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<b><font face="Trebuchet MS" color="black" size="2px">Opis&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="Opis" type="text" size="50" pattern="[A-Z0-9a-zčćšđžČĆŠĐŽ ]+"
    oninput="this.value = this.value.replace(/[^A-Z0-9a-zčćšđžČĆŠĐŽ ]/g, '')" value="<?php echo $StaroOpis; ?>"/>
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="black" size="2px">Zanr&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<select name="oznakaZanra" required TABINDEX=7>		
	<option value="">изаберите...</option>
	<?php
	
		
	// PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisa>0) 
	{					
		for ($brojacZanrova = 0; $brojacZanrova < $UkupanBrojZapisa; $brojacZanrova++) 
			{
				$oznakaZanra =$ZanrObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacZanrova, 0);				
				$nazivZanra=$ZanrObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacZanrova, 1);				
				echo "<option value=\"$oznakaZanra\">$nazivZanra</option>";						
			} //for
										
	} // 
	
	?>
		
</select>

<br/>
<font face="Trebuchet MS" color="black" size="2px">Stara Oznaka Zanra: <?php echo $StaraOznakaZanra; ?></font>
<input type="hidden" name="StaraOznakaZanra" value="<?php echo $StaraOznakaZanra; ?>">

</td>
</tr>


<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="black" size="2px">Фотографија&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="nazivFajlaFotografije" type="file" size="50" placeholder="Унесите назив фајла фотографије"/> <br/>
<font face="Trebuchet MS" color="black" size="2px">Стари назив фајла фотографије: <?php echo $StariNazivFajlaFotografije; ?></font>
<input type="hidden" name="StariNazivFajlaFotografije" value="<?php echo $StariNazivFajlaFotografije; ?>">
</td>
</tr>


<!-------------------------- prazan red ------->
<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<tr>

<td>       
</td>
<td><input TYPE="submit" name="snimiButton" value="СНИМИ ИЗМЕНУ" TABINDEX=3/>
</td>
</form>
</table>

</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>
</table>
</td>

<td style="width:5%;">
</td>

</tr>
</table>
<img src="images/sredinadole.jpg" width="100%" height="5" alt="" class="flt1" /> 
    