
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
<td align="left">
<b><font face="Trebuchet MS" color="black" size="3px">Unos Nove Predstave</b></br>
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



<form name="FormaZaUnosPredstava"
      action="klase/PredstavaController.php"
      method="POST"
      enctype="multipart/form-data">
<input type="hidden" name="akcija" value="dodaj">
<table style="width:95%;" bgcolor="#D8E7F4">


<tr>
<td align="right" valign="bottom">     
<b><font face="Trebuchet MS" color="black" size="2px">IDPredstave&nbsp;&nbsp;</font></b>
</td>
<td align="left" valign="bottom">
<input
    name="idPredstave"
    type="text"
    maxlength="10"
    pattern="[0-9]{1,10}"
    inputmode="numeric"
    placeholder="Unesite IDPredstave"
    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
/>
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
<input
    name="naziv"
    type="text"
    size="50"
    placeholder="Unesite naziv"
    pattern="[A-Z0-9a-zčćšđžČĆŠĐŽ ]+"
    oninput="this.value = this.value.replace(/[^A-Z0-9a-zčćšđžČĆŠĐŽ ]/g, '')"
/>
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
<input
    name="opis"
    type="text"
    size="50"
    placeholder="Unesite opis"
    pattern="[A-Z0-9a-zčćšđžČĆŠĐŽ ]+"  
    oninput="this.value = this.value.replace(/[^A-Z0-9a-zčćšđžČĆŠĐŽ ]/g, '')"
/>
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
<b><font face="Trebuchet MS" color="black" size="2px">Zanr&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<select name="oznakaZanra" required TABINDEX=7>		
	<option value="">izaberite...</option>
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


</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="black" size="2px">
Angažovani glumci&nbsp;&nbsp;
</font></b>
</td>

<td align="left">
<table id="tabelaGlumaca" border="0" cellpadding="3">
<tbody id="tbodyGlumaca">
<tr class="redGlumac">
<td>1</td>
<td>
<select name="idGlumca[]" required>
    <option value="">izaberite glumca...</option>
    <?php foreach ($glumci as $g): ?>
        <option value="<?= $g['IDGlumca'] ?>">
            <?= $g['Ime'] ?> <?= $g['Prezime'] ?>
        </option>
    <?php endforeach; ?>
</select>
</td>
<td><input type="text" name="uloga[]" placeholder="Uloga" required size="20"></td>
<td><button type="button" class="ukloniGlumca">Уклони</button></td>
</tr>
</tbody>
</table>

<button type="button" id="dodajGlumca">+ Додај глумца</button>


<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<b><font face="Trebuchet MS" color="black" size="2px">Фотографија&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="nazivFajlaFotografije" type="file" size="50" placeholder="Унесите назив фајла фотографије"/>
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

<hr>




<tr>

<td align="right">
<b><font face="Trebuchet MS" size="2px">Datum izvođenja&nbsp;&nbsp;</font></b>
</td>
<td>
<input type="date" name="DatumIzvodjenja" required>
</td>
</tr>

<tr>
<td align="right">
<b><font face="Trebuchet MS" size="2px">Vreme izvođenja&nbsp;&nbsp;</font></b>
</td>
<td>
<input type="time" name="VremeIzvodjenja" required>
</td>
</tr>

<tr>
<td align="right">
<b><font face="Trebuchet MS" size="2px">Mesto&nbsp;&nbsp;</font></b>
</td>
<td>
<input type="text" name="MestoIzvodjenja" required>
</td>
</tr>



<td>       
</td>
<td><input TYPE="submit" name="snimiButton" value="СНИМИ" TABINDEX=3/>
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

<script>
(function(){
    var tbody = document.getElementById('tbodyGlumaca');

    function numerisi() {
        tbody.querySelectorAll('.redGlumac').forEach((red, i) => {
            red.querySelector('td').innerText = i+1;
        });
    }

document.getElementById('dodajGlumca').onclick = function() {
    var prviRed = tbody.querySelector('.redGlumac');
   var noviRed = prviRed.cloneNode(true);


noviRed.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
noviRed.querySelectorAll('input').forEach(i => i.value = '');


noviRed.querySelectorAll('select').forEach(s => s.name = 'idGlumca[]');
noviRed.querySelectorAll('input').forEach(i => i.name = 'uloga[]');


noviRed.querySelectorAll('.ukloniGlumca').forEach(btn => btn.onclick = ukloni);

tbody.appendChild(noviRed);
numerisi();
};

    function ukloni() {
        if(tbody.querySelectorAll('.redGlumac').length > 1) {
            this.closest('tr').remove();
            numerisi();
        }
    }

    tbody.querySelectorAll('.ukloniGlumca').forEach(btn => btn.onclick = ukloni);
})();
</script>

    