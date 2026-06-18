<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST Predstava</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">REST Predstava</h2>

    
    <div class="mb-3 text-center">
        <button id="btnGET" class="btn btn-primary m-1">GET: Prikaži predstave</button>
        <button id="btnPOST" class="btn btn-success m-1">POST: Dodaj predstavu</button>
        <button id="btnPUT" class="btn btn-warning m-1">PUT: Izmeni predstavu</button>
        <button id="btnDELETE" class="btn btn-danger m-1">DELETE: Obriši predstavu</button>
    </div>



    
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tabelaGET">
            <thead class="table-dark">
                <tr>
                    <th>IDPredstave</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Fajl fotografije</th>
                    <th>Žanr</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const REST_URL = "http://localhost/ITseminarski/api/PredstavaRest.php";


document.getElementById("btnGET").addEventListener("click", () => {
    fetch(REST_URL)
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("#tabelaGET tbody");
            tbody.innerHTML = "";
            data.forEach(p => {
                const row = `<tr>
                    <td>${p.IDPredstave}</td>
                    <td>${p.Naziv}</td>
                    <td>${p.Opis}</td>
                    <td>${p.NazivFajlaFotografije}</td>
                    <td>${p.NazivZanra}</td>
                </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(err => alert("Greška GET: " + err));
});


document.getElementById("btnPOST").addEventListener("click", () => {
    const novi = {
        IDPredstave: parseInt(prompt("IDPredstave:", "1000")),
        Naziv: prompt("Naziv predstave:", "Nova Predstava"),
        Opis: prompt("Opis:", "Opis predstave"),
        NazivFajlaFotografije: prompt("Naziv fajla:", "slika.jpg"),
        OznakaZanra: prompt("Oznaka žanra:", "KM")
    };

    fetch(REST_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(novi)
    })
    .then(res => res.json())
    .then(d => alert("POST odgovor:\n" + JSON.stringify(d)))
    .catch(err => alert("Greška POST: " + err));
});


document.getElementById("btnPUT").addEventListener("click", () => {
    const id = parseInt(prompt("IDPredstave koju menjamo:", "1000"));
    const izmena = {
        Naziv: prompt("Novi naziv:", "Izmenjena Predstava"),
        Opis: prompt("Novi opis:", "Izmenjeni opis"),
        NazivFajlaFotografije: prompt("Novi fajl:", "nova_slika.jpg"),
        OznakaZanra: prompt("Nova oznaka žanra:", "DM")
    };

    fetch(`${REST_URL}?id=${id}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(izmena)
    })
    .then(res => res.json())
    .then(d => alert("PUT odgovor:\n" + JSON.stringify(d)))
    .catch(err => alert("Greška PUT: " + err));
});


document.getElementById("btnDELETE").addEventListener("click", () => {
    const id = parseInt(prompt("IDPredstave koju brišemo:", "1000"));

    fetch(`${REST_URL}?id=${id}`, { method: "DELETE" })
    .then(res => res.json())
    .then(d => alert("DELETE odgovor:\n" + JSON.stringify(d)))
    .catch(err => alert("Greška DELETE: " + err));
});
</script>

</body>
</html>
