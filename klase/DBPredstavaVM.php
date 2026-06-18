<?php
class PredstavaVM
{
    
    private $IDPredstave;
    private $Naziv;
    private $Opis;
    private $OznakaZanra;
    private $NazivFajlaFotografije;


    public function getIDPredstave() {
        return $this->IDPredstave;
    }

    public function getNaziv() {
        return $this->Naziv;
    }

    public function getOpis() {
        return $this->Opis;
    }

    public function getOznakaZanra() {
        return $this->OznakaZanra;
    }

    public function getNazivFajlaFotografije() {
        return $this->NazivFajlaFotografije;
    }

    public function setIDPredstave($v) {
        $this->IDPredstave = $v;
    }

    public function setNaziv($v) {
        $this->Naziv = $v;
    }

    public function setOpis($v) {
        $this->Opis = $v;
    }

    public function setOznakaZanra($v) {
        $this->OznakaZanra = $v;
    }

    public function setNazivFajlaFotografije($v) {
        $this->NazivFajlaFotografije = $v;
    }
}
?>
