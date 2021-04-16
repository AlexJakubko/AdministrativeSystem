<?php
include '../partials/header.php';
?>
<section class="fdb-block">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                <div class="row">
                    <div class="col text-center">
                        <h1>Register</h1>
                    </div>
                </div>
                <form method="post" action="/Jakubko/public_html/views/daco/studentadmin.php">
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input class="form-control" type="text" name="firstname" placeholder="Krstné meno" required>
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="lastname" placeholder="Priezvisko" required>
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input class="form-control" type="text" name="rc" placeholder="Rodné čislo" required>
                        </div>
                        <div class="col">
                            <input class="form-control" type="date" name="bday" placeholder="Dátum narodenia" required>
                        </div>
                    </div>

                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <select class="form-control" name="pohlavie">
                                <option value="" selected>Pohlavie</option>
                                <option value="0">Muž</option>
                                <option value="1">Žena</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="stupen">
                                <option value="" selected>Stupeň</option>
                                <option value="1">I.</option>
                                <option value="2">II.</option>
                                <option value="3">III.</option>
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <select class="form-control" name="fakulta">
                                <option value="" selected>Fakulta</option>
                                <option value="FEI">FEI</option>
                                <option value="FBERG">FBERG</option>
                                <option value="EKF">EKF</option>
                                <option value="HF">HF</option>
                                <option value="LF">LF</option>
                                <option value="FU">FU</option>
                                <option value="SJF">SJF</option>
                                <option value="FVT">FVT</option>
                                <option value="SVF">SVF</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="rocnik">
                                <option value="" selected>Ročník</option>
                                <option value="1">1.</option>
                                <option value="2">2.</option>
                                <option value="3">3.</option>
                                <option value="4">4.</option>
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end mt-4">
                        <button class="btn btn-success" class="form-control" type="submit">Pridať študenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include '../../connectdb.php';
if (!empty($_POST)) {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['rc']) && !empty($_POST['bday']) && isset($_POST['pohlavie']) && !empty($_POST['stupen']) && !empty($_POST['rocnik']) && !empty($_POST['fakulta'])) {
        $sql = "INSERT INTO `Jakubko`.`studenti` (`meno`, `priezvisko`, `rodne_cislo`, `datum_narodenia`, `pohlavie`, `stupen`, `rocnik`, `fakulta`) VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['rc'] . "', '" . $_POST['bday'] . "', '" . $_POST['pohlavie'] . "', '" . $_POST['stupen'] . "', '" . $_POST['rocnik'] . "', '" . $_POST['fakulta'] . "');";
        if ($conn->query($sql) === TRUE) {
            if ($_POST['pohlavie'] == 0) {
                echo "<div class='alert alert-success' role='alert'><br>Študent " . $_POST['firstname'] . " " . $_POST['lastname'] . " pridaná!</div>";
            } else {
                echo "<div class='alert alert-success' role='alert'><br>Študentka " . $_POST['firstname'] . " " . $_POST['lastname'] . " pridaný!</div>";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<div class='alert alert-success' role='alert'>Izba " . $sql . " < br > " . $conn->error;
            " </div>";
        }
        $conn->close();
    } else {
        echo "Nekorektné dáta z formulára";
    }
} ?>

<?php
include '../partials/footer.php';
?>