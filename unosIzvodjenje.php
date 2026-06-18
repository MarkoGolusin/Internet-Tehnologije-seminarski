<?php
session_start();

// Provera korisnika
$korisnik = $_SESSION['korisnik'] ?? null;
if (!$korisnik) {
    header('Location:index.php');
    exit;
}


require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";
require "klase/DBPredstava.php";
require "klase/DBIzvodjenje.php";


$KonekcijaObject = new Konekcija("klase/BaznaParametriKonekcije.xml");
$KonekcijaObject->connect();


$PredstavaObject = new DBPredstava($KonekcijaObject, "Predstava");
$PredstavaObject->DajKolekcijuSvihPredstava();
$Predstave = $PredstavaObject->Kolekcija;


$IzvodjenjeObject = new DBIzvodjenje($KonekcijaObject, "Izvodjenje");
$Izvodjenja = $IzvodjenjeObject->DajKolekcijuSvihIzvodjenja();
?>

<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<title>Unos izvođenja - ТФ М Пупин Зрењанин</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php include 'css/stil.php'; ?>
</head>
<body class="bg-light">

<?php include 'delovi/zaglavljewelcome.php'; ?>

<div class="container-fluid mt-3">
    <div class="row">

        
        <aside class="col-lg-2 col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Meni</div>
                <div class="card-body p-2">
                    <?php include 'delovi/menilevoadmin.php'; ?>
                </div>
            </div>
        </aside>

        
        <main class="col-lg-10 col-md-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <h4 class="mb-3">Dodavanje novog izvođenja</h4>

                    
                    <form method="post" action="klase/IzvodjenjeController.php">
                        <input type="hidden" name="akcija" value="dodaj">

                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label for="datum" class="form-label">Datum izvođenja</label>
                                <input type="date" id="datum" name="DatumIzvodjenja" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label for="vreme" class="form-label">Vreme izvođenja</label>
                                <input type="time" id="vreme" name="VremeIzvodjenja" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label for="mesto" class="form-label">Mesto</label>
                                <input type="text" id="mesto" name="Mesto" class="form-control" placeholder="Unesite mesto" required>
                            </div>

                            <div class="col-md-3">
                                <label for="predstava" class="form-label">Predstava</label>
                                <select id="predstava" name="IDPredstave" class="form-select" required>
                                    <option value="">Izaberite predstavu...</option>
                                    <?php foreach ($Predstave as $p): ?>
                                        <option value="<?= $p['IDPredstave'] ?>">
                                            <?= $p['Naziv'] ?> (ID: <?= $p['IDPredstave'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Dodaj izvođenje</button>
                    </form>
                </div>
            </div>



        </main>
    </div>
</div>

<?php include 'delovi/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
