<?php
session_start();

if (empty($_SESSION['korisnik'])) {
    header('Location:../index.php');
    exit;
}

require __DIR__ . "/BaznaKonekcija.php";
require __DIR__ . "/BaznaTabela.php";
require __DIR__ . "/DBIzvodjenje.php";
require __DIR__ . "/DBPredstava.php";
require __DIR__ . "/BaznaTransakcija.php";

class IzvodjenjeController
{
    private $Konekcija;

    public function __construct()
    {
        $this->Konekcija = new Konekcija(__DIR__ . "/BaznaParametriKonekcije.xml");
        $this->Konekcija->connect();

        if (!$this->Konekcija->konekcijaDB) {
            $_SESSION['poruka'] = "Greška: Nije moguće povezati se na bazu!";
            header('Location:../IzvodjenjeLista.php');
            exit;
        }
    }

    public function dodaj($data)
    {
        $DatumIzvodjenja = $data['DatumIzvodjenja'] ?? '';
        $VremeIzvodjenja = $data['VremeIzvodjenja'] ?? '';
        $Mesto = $data['Mesto'] ?? '';
        $IDPredstave = $data['IDPredstave'] ?? '';

        if (!$DatumIzvodjenja || !$VremeIzvodjenja || !$Mesto || !$IDPredstave) {
            $_SESSION['poruka'] = "Greška: Nisu popunjena sva polja!";
            return;
        }

        $Transakcija = new Transakcija($this->Konekcija);
        $Transakcija->ZapocniTransakciju();

        $Izvodjenje = new DBIzvodjenje($this->Konekcija, 'Izvodjenje');
        $Izvodjenje->DatumIzvodjenja = $DatumIzvodjenja;
        $Izvodjenje->VremeIzvodjenja = $VremeIzvodjenja;
        $Izvodjenje->Mesto = $Mesto;
        $Izvodjenje->IDPredstave = $IDPredstave;

        $greska = $Izvodjenje->DodajNovoIzvodjenje();
        $Transakcija->ZavrsiTransakciju($greska);

        $_SESSION['poruka'] = $greska ? "Greška: $greska" : "Novo izvođenje uspešno dodato!";
    }

    public function obrisi($IDIzvodjenja)
    {
        if (!$IDIzvodjenja) {
            $_SESSION['poruka'] = "Greška: Nije prosleđen ID izvođenja.";
            return;
        }

        $Transakcija = new Transakcija($this->Konekcija);
        $Transakcija->ZapocniTransakciju();

        $Izvodjenje = new DBIzvodjenje($this->Konekcija, 'Izvodjenje');
        $greska = $Izvodjenje->ObrisiIzvodjenje($IDIzvodjenja);

        $Transakcija->ZavrsiTransakciju($greska);

        $_SESSION['poruka'] = $greska ? "Greška: $greska" : "Izvođenje uspešno obrisano!";
    }

    public function __destruct()
    {
        $this->Konekcija->disconnect();
    }
}


$akcija = $_POST['akcija'] ?? null;
$controller = new IzvodjenjeController();

switch ($akcija) {
    case 'dodaj':
        $controller->dodaj($_POST);
        break;

    case 'obrisi':
        $controller->obrisi($_POST['IDIzvodjenja'] ?? null);
        break;

    default:
        $_SESSION['poruka'] = "Nepoznata akcija!";
        break;
}

header('Location:../IzvodjenjeLista.php');
exit;
