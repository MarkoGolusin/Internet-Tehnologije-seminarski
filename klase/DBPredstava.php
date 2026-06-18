<?php
class DBPredstava extends Tabela 
{
   
    private $konekcija;

    public $IDPredstave;
    public $Naziv;
    public $Opis;
    public $OznakaZanra; 
    public $NazivFajlaFotografije;

  
    public function __construct($konekcija, $tabela) {
        parent::__construct($konekcija, $tabela);
        $this->konekcija = $konekcija;
    }

   
    public function DajKolekcijuSvihPredstava() {
        $SQL = "SELECT * FROM Predstava ORDER BY Naziv ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }


    public function UcitajPoIDPredstave($IDPredstaveParametar) {
        $SQL = "SELECT * FROM Predstava WHERE IDPredstave = '$IDPredstaveParametar'";
        $this->UcitajSvePoUpitu($SQL);
    }


    public function DodajNovogPredstava() {
        if ($this->PostojiZapis("IDPredstave = '$this->IDPredstave'")) {
            return "GREŠKA: IDPredstave već postoji!";
        }

        $SQL = "INSERT INTO Predstava (IDPredstave, Naziv, Opis, OznakaZanra, NazivFajlaFotografije)
                VALUES ('$this->IDPredstave', '$this->Naziv', '$this->Opis', '$this->OznakaZanra', '$this->NazivFajlaFotografije')";

        return $this->IzvrsiAktivanSQLUpit($SQL);
    }


public function IzmeniPredstavu($StariIDPredstave, $IDPredstave, $Naziv, $Opis, $OznakaZanra, $nazivFajlaFotografije)
{
    
    $SQL = "UPDATE `Predstava` 
            SET IDPredstave='$IDPredstave', 
                Naziv='$Naziv', 
                Opis='$Opis', 
                NazivFajlaFotografije='$nazivFajlaFotografije',
                OznakaZanra='$OznakaZanra', 
                NazivFajlaFotografije='$nazivFajlaFotografije' 
            WHERE IDPredstave='$StariIDPredstave'";

    $rezultat = $this->IzvrsiAktivanSQLUpit($SQL);

    if ($rezultat !== false) {
    return true;
} else {
    return $rezultat;
}
}



    public function ObrisiPredstavu($IDZaBrisanje) {
        $SQL = "DELETE FROM Predstava WHERE IDPredstave = '$IDZaBrisanje'";
        return $this->IzvrsiAktivanSQLUpit($SQL);
    }


    public function UcitajPredstavePoZanru($OznakaZanra) {
        $SQL = "SELECT p.IDPredstave, p.Naziv, p.Opis, z.Naziv AS NazivZanra, p.NazivFajlaFotografije
                FROM Predstava p
                INNER JOIN Zanr z ON p.OznakaZanra = z.OznakaZanra
                WHERE p.OznakaZanra = '$OznakaZanra'
                ORDER BY p.Naziv ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }

    public function DajOznakuZanraPredstava($IDPredstave) {
    $KriterijumFiltriranja = "IDPredstave = '$IDPredstave'";

    return $this->DajVrednostJednogPoljaPrvogZapisa('OznakaZanra', $KriterijumFiltriranja, 'IDPredstave');
}


}
?>
