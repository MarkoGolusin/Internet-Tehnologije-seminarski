<?php
class DBPredstava extends Tabela 
// rad sa stored procedurom za snimanje novog Predstava
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $IDPredstave;
public $Naziv;
public $Opis;
public $OznakaZanra;
public $NazivFajlaFotografije;

// METODE

// konstruktor

public function DodajNovogPredstava()
{
    // setovanje parametara za stored procedure
    $GreskarezultatPar1 = $this->IzvrsiAktivanSQLUpit("SET @IDPredstaveParametar='".$this->IDPredstave."'");
    $GreskarezultatPar2 = $this->IzvrsiAktivanSQLUpit("SET @NazivParametar='".$this->Naziv."'");
    $GreskarezultatPar3 = $this->IzvrsiAktivanSQLUpit("SET @OpisParametar='".$this->Opis."'");
    $GreskarezultatPar4 = $this->IzvrsiAktivanSQLUpit("SET @NazivFajlaFotografijeParametar='".$this->NazivFajlaFotografije."'");
    $GreskarezultatPar5 = $this->IzvrsiAktivanSQLUpit("SET @OznakaZanraParametar='".$this->OznakaZanra."'");

    // pozivanje stored procedure sa 5 parametara
    $GreskarezultatCall = $this->IzvrsiAktivanSQLUpit(
        "CALL `DodajPredstavu`(@IDPredstaveParametar,@NazivParametar,@OpisParametar,@NazivFajlaFotografijeParametar,@OznakaZanraParametar);"
    );

    // kombinovanje rezultata
    $greska = $GreskarezultatPar1 . $GreskarezultatPar2 . $GreskarezultatPar3 .
              $GreskarezultatPar4 . $GreskarezultatPar5 . $GreskarezultatCall;

    return $greska;
}



}
?>