<?php
class DBPredstava extends Tabela 
// rad sa pogledom
{

// METODE

// konstruktor

public function DajSvePodatkeOPredstavama($filterParametar)
{
	if (isset($filterParametar))
	{
		// nad pogledom se moze dodati filter, jer se pogled koristi kao da je tabela
		$upit="select * from `".$this->NazivBazePodataka."`.`SviPodacioPredstavamaSaSlikom` where `IDPredstave`='".$filterParametar."'";
	}
	else
	{
		$upit="select * from `".$this->NazivBazePodataka."`.`SviPodacioPredstavamaSaSlikom`";
	}
	$this->UcitajSvePoUpitu($upit);
	// sada raspolazemo sa:
	//$this->Kolekcija 
	//$this->BrojZapisa
}


}
?>