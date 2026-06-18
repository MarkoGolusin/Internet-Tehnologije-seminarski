<?php
session_start();

require __DIR__ . "/BaznaKonekcija.php";
require __DIR__ . "/BaznaTabela.php";
require __DIR__ . "/DBPredstava.php";
require __DIR__ . "/DBZanr.php";
require __DIR__ . "/Repertoar.php";
require __DIR__ . "/BaznaTransakcija.php";
require __DIR__ . "/DBGlumac.php";
require __DIR__ . "/DBAngazman.php";
require __DIR__ . "/DBIzvodjenje.php";

class PredstavaController
{
    private $konekcija;

    public function __construct()
    {
        $this->ProveriSesiju();

        $this->konekcija = new Konekcija(__DIR__ . "/BaznaParametriKonekcije.xml");
        $this->konekcija->connect();

        if (!$this->konekcija->konekcijaDB) {
            $_SESSION['poruka'] = "Greška: Nije moguće povezati se na bazu!";
            header('Location:../PredstavaLista.php');
            exit;
        }
    }

    private function ProveriSesiju()
    {
        $korisnik = $_SESSION["korisnik"] ?? null;
        if (!$korisnik) {
            header('Location:../index.php');
            exit;
        }
    }

    public function Pokreni()
    {
        $akcija = $_POST['akcija'] ?? null;

        switch ($akcija) {
            case 'dodaj':
                $this->DodajPredstavu();
                break;
            case 'obrisi':
                $this->ObrisiPredstavu();
                break;
            case 'izmeni':
                $this->IzmeniPredstavu();
                break;
            default:
                $_SESSION['poruka'] = "Nepoznata akcija!";
                break;
        }

        $this->konekcija->disconnect();
        header('Location:../PredstavaLista.php');
        exit;
    }

    private function DodajPredstavu()
{
    $IDPredstave = $_POST['idPredstave'] ?? '';
    $Naziv       = $_POST['naziv'] ?? '';
    $Opis        = $_POST['opis'] ?? '';
    $OznakaZanra = $_POST['oznakaZanra'] ?? '';
    $idGlumaca   = $_POST['idGlumca'] ?? [];
    $uloge       = $_POST['uloga'] ?? [];

    // IZVOĐENJE
    $DatumIzvodjenja = $_POST['DatumIzvodjenja'] ?? '';
    $VremeIzvodjenja = $_POST['VremeIzvodjenja'] ?? '';
    $MestoIzvodjenja = $_POST['MestoIzvodjenja'] ?? '';

    if (count($idGlumaca) < 1) {
        die("Mora se uneti bar jedan glumac!");
    }

    if (!$DatumIzvodjenja || !$VremeIzvodjenja || !$MestoIzvodjenja) {
        die("Moraju se uneti svi podaci o izvođenju!");
    }

    
    $NazivFajlaFotografije = null;
    if (!empty($_FILES['nazivFajlaFotografije']['name'])) {
        $uploadDir = __DIR__ . '/../SlikePredstava/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $NazivFajlaFotografije = basename($_FILES['nazivFajlaFotografije']['name']);
        move_uploaded_file(
            $_FILES['nazivFajlaFotografije']['tmp_name'],
            $uploadDir . $NazivFajlaFotografije
        );
    }

    
    $Repertoar = new Repertoar($this->konekcija, 'Predstava');
    if ($Repertoar->DaLiImaMestaZaRepertoar($OznakaZanra) !== "DA") {
        die("Ne možete uneti još jednu predstavu – nema mesta po repertoaru.");
    }

    
    $Transakcija = new Transakcija($this->konekcija);
    $Predstava   = new DBPredstava($this->konekcija, 'Predstava');
    $Zanr        = new DBZanr($this->konekcija, 'Zanr');
    $Angazman    = new DBAngazman($this->konekcija, 'Angazman');
    $Izvodjenje  = new DBIzvodjenje($this->konekcija, 'Izvodjenje');

    $Transakcija->ZapocniTransakciju();

    
    $Predstava->IDPredstave = $IDPredstave;
    $Predstava->Naziv = $Naziv;
    $Predstava->Opis = $Opis;
    $Predstava->OznakaZanra = $OznakaZanra;
    $Predstava->NazivFajlaFotografije = $NazivFajlaFotografije;

    $greska1 = $Predstava->DodajNovogPredstava();
    $greska2 = $Zanr->InkrementirajBrojPredstava($OznakaZanra);

   
    $greska3 = '';
    for ($i = 0; $i < count($idGlumaca); $i++) {
        $greskaTmp = $Angazman->DodajAngazman(
            $IDPredstave,
            $idGlumaca[$i],
            $uloge[$i]
        );
        if ($greskaTmp) {
            $greska3 .= $greskaTmp;
        }
    }

    
    $Izvodjenje->IDPredstave     = $IDPredstave;
    $Izvodjenje->DatumIzvodjenja = $DatumIzvodjenja;
    $Izvodjenje->VremeIzvodjenja = $VremeIzvodjenja;
    $Izvodjenje->Mesto           = $MestoIzvodjenja;

    $greska4 = $Izvodjenje->DodajNovoIzvodjenje();

   
    $greska = trim($greska1 . $greska2 . $greska3 . $greska4);
    $Transakcija->ZavrsiTransakciju($greska);

    $_SESSION['poruka'] = $greska
        ? "Greška pri snimanju: $greska"
        : "Predstava, angažmani i izvođenje su uspešno dodati.";
}


    private function ObrisiPredstavu()
    {
        $idPredstave = $_POST['IDPredstave'] ?? null;
        if (!$idPredstave) {
            $_SESSION['poruka'] = "Greška: Nije prosleđen ID predstave.";
            return;
        }

        $Transakcija = new Transakcija($this->konekcija);
        $Transakcija->ZapocniTransakciju();

        $Predstava = new DBPredstava($this->konekcija, 'Predstava');
        $Angazman = new DBAngazman($this->konekcija, 'Angazman');

        
        $greska0 = $Angazman->ObrisiAngazmaneZaPredstavu($idPredstave);

        $OznakaZanra = $Predstava->DajOznakuZanraPredstava($idPredstave);
        $greska1 = $Predstava->ObrisiPredstavu($idPredstave);

        $Zanr = new DBZanr($this->konekcija, 'Zanr');
        $greska2 = $Zanr->DekrementirajBrojPredstava($OznakaZanra);

        $UtvrdjenaGreska = $greska0 . $greska1 . $greska2;
        $Transakcija->ZavrsiTransakciju($UtvrdjenaGreska);

        $_SESSION['poruka'] = $UtvrdjenaGreska
            ? "Greška: $UtvrdjenaGreska"
            : "Predstava uspešno obrisana!";
    }

    private function IzmeniPredstavu()
    {
        $StariIDPredstave = $_POST['StariIDPredstave'] ?? null;
        $IDPredstave      = $_POST['idPredstave'] ?? null;
        $Naziv            = $_POST['Naziv'] ?? '';
        $Opis             = $_POST['Opis'] ?? '';
        $OznakaZanra      = $_POST['oznakaZanra'] ?? '';
        $NazivFajlaFotografije = $_POST['StariNazivFajlaFotografije'] ?? '';

        if (!empty($_FILES['nazivFajlaFotografije']['name'])) {
            $uploadDir = __DIR__ . '/../SlikePredstava/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $NazivFajlaFotografije = basename($_FILES['nazivFajlaFotografije']['name']);
            move_uploaded_file($_FILES['nazivFajlaFotografije']['tmp_name'], $uploadDir . $NazivFajlaFotografije);
        }

        $Transakcija = new Transakcija($this->konekcija);
        $Transakcija->ZapocniTransakciju();

        $Predstava = new DBPredstava($this->konekcija, 'Predstava');

        $greska = $Predstava->IzmeniPredstavu(
            $StariIDPredstave,
            $IDPredstave,
            $Naziv,
            $Opis,
            $OznakaZanra,
            $NazivFajlaFotografije
        );

        $Transakcija->ZavrsiTransakciju($greska !== true ? $greska : '');

        $_SESSION['poruka'] = $greska === true
            ? "Predstava uspešno izmenjena!"
            : "Došlo je do greške: $greska";
    }
}


$Kontroler = new PredstavaController();
$Kontroler->Pokreni();
