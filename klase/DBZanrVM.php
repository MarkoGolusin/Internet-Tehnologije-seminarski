<?php

class DBZanrNew extends Tabela
{
    
    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;

    private $OznakaZanra;
    private $Naziv;
    private $UkupanBrojPredstava;



    

    public function getOznakaZanra()
    {
        return $this->OznakaZanra;
    }

    public function setOznakaZanra($id)
    {
        $this->OznakaZanra = $id;
        return $this;
    }

    public function getNaziv()
    {
        return $this->Naziv;
    }

    public function setNaziv($naziv)
    {
        $this->Naziv = $naziv;
        return $this;
    }

    public function getUkupanBrojPredstava()
    {
        return $this->UkupanBrojPredstava;
    }

    public function setUkupanBrojPredstava($broj)
    {
        $this->UkupanBrojPredstava = $broj;
        return $this;
    }


}

?>
