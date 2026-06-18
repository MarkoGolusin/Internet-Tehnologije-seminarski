<?php 
class Repertoar extends Tabela
{

    public function DaLiImaMestaZaRepertoar($OznakaZanraParametar)
    {
        $odgovor = "NE";


        $xmlPutanja = __DIR__ . "/" . $OznakaZanraParametar . ".xml";

        if (!file_exists($xmlPutanja)) {
            die("XML fajl sa ograničenjem ne postoji: " . $xmlPutanja);
        }

        $xml = simplexml_load_file($xmlPutanja);
        if (!$xml) {
            die("Nije uspesno ucitavanje fajla sa ogranicenjem!");
        }

        $maxBrojPredstava = (int)$xml->MaxBrPredstava;


        $NazivTrazenogPolja = "COUNT(`IDPredstave`)";
        $KriterijumFiltriranja = "`OznakaZanra` = '".$OznakaZanraParametar."'";
        $KriterijumSortiranja = "`IDPredstave`";

        $trenutanBrojPredstava =
            (int)$this->DajVrednostJednogPoljaPrvogZapisa(
                $NazivTrazenogPolja,
                $KriterijumFiltriranja,
                $KriterijumSortiranja
            );

        if ($trenutanBrojPredstava < $maxBrojPredstava) {
            $odgovor = "DA";
        }

        return $odgovor;
    }
}
?>
