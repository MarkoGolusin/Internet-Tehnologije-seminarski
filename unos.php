<?php
// START SESIJE I PROVERA KORISNIKA
session_start();
$korisnik = $_SESSION['korisnik'] ?? null;
if (!$korisnik) {
    header('Location:index.php');
    exit;
}

// KONEKCIJA NA BAZU
require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";
require "klase/DBZanr.php";
require "klase/DBGlumac.php";


$KonekcijaObject = new Konekcija("klase/BaznaParametriKonekcije.xml");
$KonekcijaObject->connect();


$ZanrObject = new DBZanr($KonekcijaObject, "zanr");
$ZanrObject->UcitajKolekcijuSvihZanrova();
$KolekcijaZapisa = $ZanrObject->Kolekcija;
$UkupanBrojZapisa = $ZanrObject->BrojZapisa;

$DBGlumac = new DBGlumac($KonekcijaObject->konekcijaDB);
$glumci = $DBGlumac->VratiSveGlumce();

?>

<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<title>ТФ М Пупин Зрењанин</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<?php include 'css/stil.php'; ?>
</head>
<body class="bg-light">


<?php include 'delovi/zaglavljewelcome.php'; ?>


<div class="container-fluid mt-3">
    <div class="row">

     
        <aside class="col-lg-2 col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    Meni
                </div>
                <div class="card-body p-2">
                    <?php include 'delovi/menilevoadmin.php'; ?>
                </div>
            </div>
        </aside>

        
        <main class="col-lg-10 col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">

                    <?php include 'delovi/desnounos.php'; ?>

                </div>
            </div>
        </main>

    </div>
</div>


<?php include 'delovi/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
