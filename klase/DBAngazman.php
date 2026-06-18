<?php


class DBAngazman extends Tabela
{
    private $konekcija;

    public $IDPredstave;
    public $IDGlumca;
    public $Uloga;

    public function __construct($konekcija, $tabela)
    {
        parent::__construct($konekcija, $tabela);
        $this->konekcija = $konekcija;
    }


public function DodajAngazman($IDPredstave, $IDGlumca, $Uloga)
{
    $IDPredstave = (int)$IDPredstave;
    $IDGlumca   = (int)$IDGlumca;

    $sql = "INSERT INTO Angazman (IDPredstave, IDGlumca, Uloga) VALUES (?, ?, ?)";
    $stmt = $this->konekcija->konekcijaDB->prepare($sql);

    if (!$stmt) {
        return "Greška u pripremi upita (Angazman): " . $this->konekcija->konekcijaDB->error;
    }

    $stmt->bind_param("iis", $IDPredstave, $IDGlumca, $Uloga);

    if (!$stmt->execute()) {
        $greska = "Greška pri unosu angažmana: " . $stmt->error;
        $stmt->close(); 
        return $greska;
    }

    $stmt->close(); 
    return ""; 
}




    public function ObrisiAngazmaneZaPredstavu($IDPredstave)
    {
        $sql = "DELETE FROM Angazman WHERE IDPredstave = ?";
        $stmt = $this->konekcija->konekcijaDB->prepare($sql);

        if (!$stmt) return "Greška u pripremi brisanja angažmana.";

        $stmt->bind_param("i", $IDPredstave);

        if (!$stmt->execute()) return "Greška pri brisanju angažmana.";

        return "";
    }


    public function VratiAngazmaneZaPredstavu($IDPredstave)
    {
        $sql = "SELECT 
                    g.IDGlumca,
                    g.Ime,
                    g.Prezime,
                    a.Uloga
                FROM Angazman a
                JOIN Glumac g ON g.IDGlumca = a.IDGlumca
                WHERE a.IDPredstave = ?";

        $stmt = $this->konekcija->konekcijaDB->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $IDPredstave);
        $stmt->execute();

        $rezultat = $stmt->get_result();
        return $rezultat->fetch_all(MYSQLI_ASSOC);
    }
}
