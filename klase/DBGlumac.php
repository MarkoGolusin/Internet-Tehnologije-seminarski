<?php
require_once "BaznaKonekcija.php";

class DBGlumac {

    private $konekcija;

    // PRIMAJ KONEKCIJU U KONSTRUKTORU
    public function __construct($konekcija) {
        $this->konekcija = $konekcija;
    }

    public function VratiSveGlumce() {
        $sql = "SELECT IDGlumca, Ime, Prezime FROM Glumac ORDER BY Prezime, Ime";
        $rezultat = $this->konekcija->query($sql);

        $glumci = [];
        while ($red = $rezultat->fetch_assoc()) {
            $glumci[] = $red;
        }
        return $glumci;
    }

    public function DodajGlumca($ime, $prezime) {
        $stmt = $this->konekcija->prepare(
            "INSERT INTO Glumac (Ime, Prezime) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $ime, $prezime);
        return $stmt->execute();
    }

    public function GlumacPostoji($ime, $prezime) {
        $stmt = $this->konekcija->prepare(
            "SELECT COUNT(*) FROM Glumac WHERE Ime = ? AND Prezime = ?"
        );
        $stmt->bind_param("ss", $ime, $prezime);
        $stmt->execute();
        $stmt->bind_result($broj);
        $stmt->fetch();
        return $broj > 0;
    }

    public function VratiGlumcaPoID($idGlumca) {
        $stmt = $this->konekcija->prepare(
            "SELECT IDGlumca, Ime, Prezime FROM Glumac WHERE IDGlumca = ?"
        );
        $stmt->bind_param("i", $idGlumca);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
