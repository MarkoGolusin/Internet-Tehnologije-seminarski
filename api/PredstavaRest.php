<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit(0);

require_once __DIR__ . "/../klase/BaznaKonekcija.php";

$db = new Konekcija(__DIR__ . "/../klase/BaznaParametriKonekcije.xml");
$db->connect();
$conn = $db->konekcijaDB;

$method = $_SERVER['REQUEST_METHOD'];
$input  = json_decode(file_get_contents("php://input"), true);

switch ($method) {

    case 'GET':


        if (isset($_GET['masterdetail'])) {
            $id = intval($_GET['masterdetail']);
            $sql = "SELECT IDIzvodjenja, DatumIzvodjenja, VremeIzvodjenja, Mesto 
                    FROM Izvodjenje 
                    WHERE IDPredstave = $id 
                    ORDER BY DatumIzvodjenja, VremeIzvodjenja";
            $res = $conn->query($sql);
            $data = [];
            while ($r = $res->fetch_assoc()) $data[] = $r;
            echo json_encode($data);
            break;
        }


        if (isset($_GET['glumci'])) {
            $id = intval($_GET['glumci']);
            $sql = "SELECT g.IDGlumca, g.Ime, g.Prezime, a.Uloga 
                    FROM Angazman a
                    JOIN Glumac g ON g.IDGlumca = a.IDGlumca
                    WHERE a.IDPredstave = $id
                    ORDER BY g.Prezime, g.Ime";
            $res = $conn->query($sql);
            $data = [];
            while ($r = $res->fetch_assoc()) $data[] = $r;
            echo json_encode($data);
            break;
        }


        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM SviPodaciOPredstavama WHERE IDPredstave=$id";
            $predstava = $conn->query($sql)->fetch_assoc();
            echo json_encode($predstava);
            break;
        }


        $sql = "SELECT * FROM SviPodaciOPredstavama ORDER BY Naziv";
        $res = $conn->query($sql);
        $data = [];
        while ($r = $res->fetch_assoc()) $data[] = $r;
        echo json_encode($data);
        break;

    case 'POST':
        $stmt = $conn->prepare("CALL DodajPredstavu(?,?,?,?,?)");
        $stmt->bind_param(
            "issss",
            $input['IDPredstave'],
            $input['Naziv'],
            $input['Opis'],
            $input['NazivFajlaFotografije'],
            $input['OznakaZanra']
        );
        echo json_encode(["success"=>$stmt->execute()]);
        break;

    case 'PUT':
        $id = intval($_GET['id']);
        $sql = "UPDATE Predstava SET
                Naziv='{$input['Naziv']}',
                Opis='{$input['Opis']}',
                NazivFajlaFotografije='{$input['NazivFajlaFotografije']}',
                OznakaZanra='{$input['OznakaZanra']}'
                WHERE IDPredstave=$id";
        echo json_encode(["success"=>$conn->query($sql)]);
        break;

    case 'DELETE':
        $id = intval($_GET['id']);
        echo json_encode(["success"=>$conn->query("DELETE FROM Predstava WHERE IDPredstave=$id")]);
}

$db->disconnect();
