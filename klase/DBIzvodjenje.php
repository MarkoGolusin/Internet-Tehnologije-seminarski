<?php
class DBIzvodjenje extends Tabela 
{
    // ATRIBUTI
    private $konekcija;

    public $IDIzvodjenja;
    public $DatumIzvodjenja;
    public $VremeIzvodjenja;
    public $Mesto;
    public $IDPredstave;

    // KONSTRUKTOR
    public function __construct($konekcija, $tabela) {
        parent::__construct($konekcija, $tabela);
        $this->konekcija = $konekcija;
    }


    public function DajKolekcijuSvihIzvodjenja() {
        $SQL = "SELECT * FROM Izvodjenje ORDER BY DatumIzvodjenja, VremeIzvodjenja ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }


    public function UcitajPoID($IDIzvodjenjaParametar) {
        $SQL = "SELECT * FROM Izvodjenje WHERE IDIzvodjenja = '$IDIzvodjenjaParametar'";
        $this->UcitajSvePoUpitu($SQL);
    }


    public function DodajNovoIzvodjenje() {
        if ($this->PostojiZapis("IDIzvodjenja = '$this->IDIzvodjenja'")) {
            return "GREŠKA: IDIzvodjenja već postoji!";
        }

        $SQL = "INSERT INTO Izvodjenje (DatumIzvodjenja, VremeIzvodjenja, Mesto, IDPredstave)
                VALUES ('$this->DatumIzvodjenja', '$this->VremeIzvodjenja', '$this->Mesto', '$this->IDPredstave')";

        return $this->IzvrsiAktivanSQLUpit($SQL);
    }


    public function IzmeniIzvodjenje($StariID) {
        $SQL = "UPDATE Izvodjenje
                SET DatumIzvodjenja = '$this->DatumIzvodjenja',
                    VremeIzvodjenja = '$this->VremeIzvodjenja',
                    Mesto = '$this->Mesto',
                    IDPredstave = '$this->IDPredstave'
                WHERE IDIzvodjenja = '$StariID'";

        return $this->IzvrsiAktivanSQLUpit($SQL);
    }

    public function ObrisiIzvodjenje($IDZaBrisanje) {
        $SQL = "DELETE FROM Izvodjenje WHERE IDIzvodjenja = '$IDZaBrisanje'";
        return $this->IzvrsiAktivanSQLUpit($SQL);
    }


    public function UcitajIzvodjenjaPoPredstavi($IDPredstave) {
        $SQL = "SELECT * FROM Izvodjenje WHERE IDPredstave = '$IDPredstave' ORDER BY DatumIzvodjenja, VremeIzvodjenja ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }

public function DajSvaIzvodjenjaSaPredstavom($IDPredstaveFilter = null)
    {
        $SQL = "
            SELECT 
                i.IDIzvodjenja,
                i.DatumIzvodjenja,
                i.VremeIzvodjenja,
                i.Mesto,
                i.IDPredstave,
                p.Naziv AS NazivPredstave
            FROM Izvodjenje i
            LEFT JOIN Predstava p ON i.IDPredstave = p.IDPredstave
        ";

        if ($IDPredstaveFilter) {
            $SQL .= " WHERE i.IDPredstave = '$IDPredstaveFilter'";
        }

        $SQL .= " ORDER BY i.DatumIzvodjenja, i.VremeIzvodjenja ASC";

        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }

}
?>
