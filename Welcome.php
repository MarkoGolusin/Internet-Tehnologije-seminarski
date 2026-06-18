<?php
session_start();

// čitanje vrednosti iz sesije
$korisnik = $_SESSION["korisnik"] ?? null;

// ako nije prijavljen korisnik, vraća ga na početnu stranicu
if (!$korisnik) {
    header("Location: index.php");
    exit;
}
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

        
        <div class="col-lg-1 d-none d-lg-block"></div>

        
        <div class="col-lg-10">
            <div class="row">

                
                <aside class="col-md-3 col-lg-2 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            Administracija
                        </div>
                        <div class="card-body p-2">
                            <?php include 'delovi/menilevoadmin.php'; ?>
                        </div>
                    </div>
                </aside>

               
                <main class="col-md-9 col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-body">

                          
                            <div class="alert alert-info">
                                Prijavljeni korisnik:
                                <strong><?= htmlspecialchars($korisnik) ?></strong>
                            </div>

                            
                            <?php include 'delovi/desnowelcome.php'; ?>

                        </div>
                    </div>
                </main>

            </div>
        </div>

       
        <div class="col-lg-1 d-none d-lg-block"></div>

    </div>
</div>


<?php include 'delovi/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
