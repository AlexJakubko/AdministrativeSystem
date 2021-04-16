<?php
include '../partials/header.php';
?>

<section class="fdb-block">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 text-center">
                <div class="row">
                    <div class="col">
                        <h1>Zápis študentov</h1>
                    </div>
                </div>
                <form method="post" action="/Jakubko/public_html/views/daco/checking.php">

                    <div class="row align-items-center">
                        <div class="col-12 col-md-5 mt-4">
                            <select class="form-control" name="student">

                                <?php
                                include '../../connectdb.php';
                                $sql = "SELECT studenti.id_student id_student ,meno, priezvisko, fakulta, rocnik, stupen FROM studenti left join zapis on studenti.id_student=zapis.id_student where zapis.id_student is null";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["id_student"] . '">' . $row["meno"] . ' ' . $row["priezvisko"] . ', ' . $row["fakulta"] . ', ' . $row["rocnik"] . 'roc., ' . $row["stupen"] . 'stup.</option>' . PHP_EOL;
                                    }
                                } else {
                                    echo '<option value="0">0 studentov</option>';
                                }
                                ?>

                            </select>
                        </div>

                        <div class="col-12 col-md-5 mt-4">
                            <select class="form-control" name="izba">
                                <?php
                                $sql2 = "SELECT i.id_izba id_izba, pocet_lozok, obsadenie_izby, pohlavie FROM izby i left join (SELECT id_izba, count(*) obsadenie_izby FROM zapis group by id_izba) z on i.id_izba=z.id_izba where obsadenie_izby < pocet_lozok OR obsadenie_izby is NULL";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        if (isset($row2["pohlavie"])) {
                                            if ($row2["pohlavie"] == 0) {
                                                $pohlavie = 'muzska';
                                            } else {
                                                $pohlavie = 'zenska';
                                            }
                                        } else {
                                            $pohlavie = 'error';
                                        }
                                        if ($row2["obsadenie_izby"] == NULL) {
                                            $row2["obsadenie_izby"] = 0;
                                        }
                                        echo '<option value="' . $row2["id_izba"] . '">' . $row2["id_izba"] . ' ' . $row2["obsadenie_izby"] . '/' . $row2["pocet_lozok"] . ', ' . $pohlavie . '</option>' . PHP_EOL;
                                    }
                                } else {
                                    echo '<option value="0">0 izieb</option>';
                                }
                                $conn->close(); ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-2 mt-4">
                            <button class="btn btn-secondary" type="submit" value="Zapísať">Submit</button>
                        </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</section>

<?php
include '../../connectdb.php';
if (!empty($_POST)) {
    if (isset($_POST['student']) && isset($_POST['izba']) && !empty($_POST['izba'])) {
        $check_sex = 'SELECT pohlavie FROM izby WHERE id_izba = "' . $_POST['izba'] . '" and pohlavie=(SELECT pohlavie FROM studenti WHERE id_student="' . $_POST['student'] . '")';
        $resultsex = $conn->query($check_sex);
        if ($resultsex->num_rows > 0) {
            $sql3 = "INSERT INTO zapis (`id_student`, `id_izba`, `datum_pridania`) VALUES ('" . $_POST['student'] . "', '" . $_POST['izba'] . "', NOW());";
            if ($conn->query($sql3) === TRUE) {
                echo "Študent zapísaný!";
            } else {
                echo "Error: " . $sql . " <br>" . $conn->error;
            }
        } else {
            echo "Zápis nepovolený - nesprávne pohlavie";
        }
    } else {
        echo "Nekorektné dáta z formulára";
    }
}
?>

<?php
include '../partials/footer.php';
?>