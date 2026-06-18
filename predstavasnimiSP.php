<?php

$name = $_FILES["nazivFajlaFotografije"]["name"];
$tmp_name = $_FILES["nazivFajlaFotografije"]["tmp_name"];

if (!empty($name)) {
    $location = "SlikePredstava/";
    move_uploaded_file($tmp_name, $location . $name);
}


require_once __DIR__ . "/klase/DBPredstavaVM.php";

$vm = new PredstavaVM();
$vm->setIDPredstave($_POST['idPredstave']);
$vm->setNaziv($_POST['naziv']);
$vm->setOpis($_POST['opis']);
$vm->setOznakaZanra($_POST['oznakaZanra']);
$vm->setNazivFajlaFotografije($name);


require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";

$KonekcijaObject = new Konekcija("klase/BaznaParametriKonekcije.xml");
$KonekcijaObject->connect();

if ($KonekcijaObject->konekcijaDB)
{

    require_once "klase/BaznaTransakcija.php";
    $TransakcijaObject = new Transakcija($KonekcijaObject);
    $TransakcijaObject->ZapocniTransakciju();


    require_once "klase/DBPredstavaSP.php";
    $PredstavaObject = new DBPredstava($KonekcijaObject, "predstava");

    $PredstavaObject->IDPredstave = $vm->getIDPredstave();
    $PredstavaObject->Naziv = $vm->getNaziv();
    $PredstavaObject->Opis = $vm->getOpis();
    $PredstavaObject->OznakaZanra = $vm->getOznakaZanra();
    $PredstavaObject->NazivFajlaFotografije = $vm->getNazivFajlaFotografije();

    $greska1 = $PredstavaObject->DodajNovogPredstava();


    require_once "klase/DBZanr.php";
    $ZanrObject = new DBZanr($KonekcijaObject, "zanr");
    $greska2 = $ZanrObject->InkrementirajBrojPredstava(
        $vm->getOznakaZanra()
    );


    $UtvrdjenaGreska = $greska1 . $greska2;
    $TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
}


$KonekcijaObject->disconnect();


if (!empty($UtvrdjenaGreska)) {
    echo "Greška: $UtvrdjenaGreska<br><br>";
} else {
    echo "Snimljeno!<br><br>";
}

echo "<a href='PredstavaLista.php'>POVRATAK</a>";
?>
