<?php
include '../partials/header.php';
?>
<section class="fdb-block py-0">
    <div class="container py-5 my-5" style="background-image: url(http://147.232.47.244/Jakubko/public_html/imgs/shapes/6.svg);">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                <form method="post" action="/Jakubko/public_html/views/daco/roomadmin.php">
                    <div class="row">
                        <div class="col">
                            <h1>Registrácia izieb</h1>
                            <p class="lead">Tento formulár slúží na registráciu izieb.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <input class="form-control" placeholder="Číslo izby (napríklad 234)" type="text" name="CisloIzby" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <select class="form-control" name="blok" required>
                                <option value="" selected>Blok</option>
                                <option value="A">A-ružová</option>
                                <option value="B">B-modrá</option>
                                <option value="C">C-zelená</option>
                                <option value="D">D-hnedá</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <select class="form-control" name="poschodie" required>
                                <option value="" selected>Poschodie</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <input class="form-control" type="number" placeholder="Pocet lôžok (1-4)" name="lozok" min="1" max="4" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <select class="form-control" name="pohlavie" required>
                                <option value="" selected>Druh izby</option>
                                <option value="0">Mužská</option>
                                <option value="1">Ženská</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4 ">
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-success align-self-end" class="form-control" type="submit">Vytvorit izbu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include '../../connectdb.php';
if (!empty($_POST)) {
    if (!empty($_POST['CisloIzby']) && !empty($_POST['blok']) && isset($_POST['poschodie']) && !empty($_POST['lozok']) && isset($_POST['pohlavie'])) {
        $sql = "INSERT INTO `Jakubko`.`izby`(`blok`, `id_izba`, `pocet_lozok`, `pohlavie`, `poschodie`) VALUES ('" . $_POST["blok"] . "', '" . $_POST["blok"] . "" . $_POST['CisloIzby'] . "', '" . $_POST['lozok'] . "', '" . $_POST['pohlavie'] . "', '" . $_POST['poschodie'] . "');";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Izba " . $_POST["blok"] . "" . $_POST['CisloIzby'] . " pridana!</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<div class='alert alert-success' role='alert'>Izba " . $sql . " < br > " . $conn->error;
            " </div>";
        }
        $conn->close();
    } else {
        echo "<br>Nekorektnedata z formulara<br>";
    }
} ?>

<?php
include '../partials/footer.php';
?>