<?php
class DBZanr extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $OznakaZanra;
public $Naziv; 
public $UkupanBrojPredstava;

// METODE

// konstruktor

public function UcitajKolekcijuSvihZanrova()
{
$SQL = "select * from `Zanr` ORDER BY Naziv ASC";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
//return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function InkrementirajBrojPredstava($IDZanr)
{
    $KriterijumFiltriranja = "OznakaZanra='" . $IDZanr . "'";
    $StaraVrednostUkBrPredstava = $this->DajVrednostJednogPoljaPrvogZapisa(
        'UkupanBrojPredstava',
        $KriterijumFiltriranja,
        'UkupanBrojPredstava'
    );

    $NovaVrednostUkBrPredstava = $StaraVrednostUkBrPredstava + 1;

    $SQL = "UPDATE `" . $this->NazivBazePodataka . "`.`Zanr` 
            SET UkupanBrojPredstava=" . $NovaVrednostUkBrPredstava . " 
            WHERE OznakaZanra='" . $IDZanr . "'";

    $greska = $this->IzvrsiAktivanSQLUpit($SQL);

    return $greska;
}

public function DekrementirajBrojPredstava($IDZanr)
{
    $KriterijumFiltriranja = "OznakaZanra='" . $IDZanr . "'";
    $StaraVrednostUkBrPredstava = $this->DajVrednostJednogPoljaPrvogZapisa(
        'UkupanBrojPredstava',
        $KriterijumFiltriranja,
        'UkupanBrojPredstava'
    );

    $NovaVrednostUkBrPredstava = $StaraVrednostUkBrPredstava - 1;

    $SQL = "UPDATE `" . $this->NazivBazePodataka . "`.`Zanr` 
            SET UkupanBrojPredstava=" . $NovaVrednostUkBrPredstava . " 
            WHERE OznakaZanra='" . $IDZanr . "'";

    $greska = $this->IzvrsiAktivanSQLUpit($SQL);

    return $greska;
}

}
?>