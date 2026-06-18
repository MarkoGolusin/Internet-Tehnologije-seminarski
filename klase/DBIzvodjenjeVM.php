<?php
class VMIzvodjenje
{
    
    private $IDIzvodjenja;
    private $DatumIzvodjenja;
    private $VremeIzvodjenja;
    private $Mesto;
    private $IDPredstave;

    
    public function __construct($IDIzvodjenja = null, $DatumIzvodjenja = null, $VremeIzvodjenja = null, $Mesto = null, $IDPredstave = null)
    {
        $this->IDIzvodjenja = $IDIzvodjenja;
        $this->DatumIzvodjenja = $DatumIzvodjenja;
        $this->VremeIzvodjenja = $VremeIzvodjenja;
        $this->Mesto = $Mesto;
        $this->IDPredstave = $IDPredstave;
    }


    public function getIDIzvodjenja()
    {
        return $this->IDIzvodjenja;
    }

    public function getDatumIzvodjenja()
    {
        return $this->DatumIzvodjenja;
    }

    public function getVremeIzvodjenja()
    {
        return $this->VremeIzvodjenja;
    }

    public function getMesto()
    {
        return $this->Mesto;
    }

    public function getIDPredstave()
    {
        return $this->IDPredstave;
    }

    public function setIDIzvodjenja($IDIzvodjenja)
    {
        $this->IDIzvodjenja = $IDIzvodjenja;
    }

    public function setDatumIzvodjenja($DatumIzvodjenja)
    {
        $this->DatumIzvodjenja = $DatumIzvodjenja;
    }

    public function setVremeIzvodjenja($VremeIzvodjenja)
    {
        $this->VremeIzvodjenja = $VremeIzvodjenja;
    }

    public function setMesto($Mesto)
    {
        $this->Mesto = $Mesto;
    }

    public function setIDPredstave($IDPredstave)
    {
        $this->IDPredstave = $IDPredstave;
    }
}
?>
