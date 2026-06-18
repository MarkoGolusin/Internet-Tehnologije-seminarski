<?php
session_start();


$loginUserName = trim($_POST['korisnickoIme']);
$loginPassword = $_POST['sifra'];


require 'klase/BaznaKonekcija.php';
require 'klase/BaznaTabela.php';
require 'klase/DBKorisnik.php';


$objKonekcija = new Konekcija('klase/BaznaParametriKonekcije.xml');
$objKonekcija->connect();

if (!$objKonekcija->konekcijaDB) {
    die("Neuspeh konekcije na bazu podataka!");
}


$objKorisnik = new DBKorisnik($objKonekcija, 'KORISNIK');
$prijavljenKorisnik = $objKorisnik->DaLiPostojiKorisnik($loginUserName, $loginPassword);



$prijavljenKorisnik = $objKorisnik->DaLiPostojiKorisnik($loginUserName, $loginPassword);

if ($prijavljenKorisnik) {
    
    $_SESSION["idkorisnika"] = $prijavljenKorisnik['IDKORISNIKA'];
    $_SESSION["ime"] = $prijavljenKorisnik['IME'];
    $_SESSION["prez"] = $prijavljenKorisnik['PREZIME'];
    $_SESSION["korisnik"] = $prijavljenKorisnik['PREZIME'] . " " . $prijavljenKorisnik['IME'];
    $_SESSION["status"] = $prijavljenKorisnik['statusucesca'];

    
    header('Location: Welcome.php');
    exit;
} else {
    
    header('Location: prijava.php');
    exit;
}
?>
