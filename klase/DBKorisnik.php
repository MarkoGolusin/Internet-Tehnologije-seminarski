<?php
class DBKorisnik extends Tabela {
    private $konekcija; 


    private const ENKRIPCIJSKI_KLJUC = 'moja_super_tajna_sifra_123';


    public $IDKorisnika;
    public $Prezime;
    public $Ime;
    public $Email;
    public $KorisnickoIme;
    public $Sifra;
    public $Stari_IDKorisnika;

    public function __construct($konekcija, $tabela) {
        parent::__construct($konekcija, $tabela);
        $this->konekcija = $konekcija;
    }


    public function UcitajSveKorisnike() {
        $SQL = "SELECT * FROM korisnik";
        $this->UcitajSvePoUpitu($SQL);
    }


    public function SnimiKorisnika($ime, $prezime, $email, $korisnickoime, $sifra, $status = 'активан') {
        $sifraKriptovana = $this->kriptujLozinku($sifra);

        $sql = "INSERT INTO korisnik (IME, PREZIME, EMAIL, KORISNICKOIME, SIFRA, statusucesca)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->konekcija->konekcijaDB->prepare($sql);
        $stmt->bind_param("ssssss", $ime, $prezime, $email, $korisnickoime, $sifraKriptovana, $status);
        return $stmt->execute();
    }


    public function DaLiPostojiKorisnik($username, $password) {
        $sql = "SELECT * FROM korisnik WHERE KORISNICKOIME = ?";
        $stmt = $this->konekcija->konekcijaDB->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $korisnik = $res->fetch_assoc();
            $plainLozinka = $this->dekriptujLozinku($korisnik['SIFRA']);
            if ($plainLozinka === $password) {
                return $korisnik; 
            }
        }
        return false;
    }


    public function DajImePrezimePoUsername($username, $password) {
        $korisnik = $this->DaLiPostojiKorisnik($username, $password);
        if ($korisnik) {
            return $korisnik['PREZIME'] . ' ' . $korisnik['IME'];
        }
        return 'NEPOZNAT KORISNIK';
    }

    public function DajIDPoUsername($username, $password) {
        $korisnik = $this->DaLiPostojiKorisnik($username, $password);
        return $korisnik ? $korisnik['IDKORISNIKA'] : 0;
    }


    private function kriptujLozinku($plainText) {
        $metod = 'AES-256-CBC';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($metod));
        $kriptovana = openssl_encrypt($plainText, $metod, self::ENKRIPCIJSKI_KLJUC, 0, $iv);
        return base64_encode($iv . $kriptovana);
    }

    private function dekriptujLozinku($kriptovana) {
        $metod = 'AES-256-CBC';
        $sifraBin = base64_decode($kriptovana);
        $iv_len = openssl_cipher_iv_length($metod);
        $iv = substr($sifraBin, 0, $iv_len);
        $kriptovanaLozinka = substr($sifraBin, $iv_len);
        return openssl_decrypt($kriptovanaLozinka, $metod, self::ENKRIPCIJSKI_KLJUC, 0, $iv);
    }
}
?>
