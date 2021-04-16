<?php
include '../partials/header.php';
?>

<?php
include '../../connectdb.php';

if (isset($_GET["id_izba"])) {
    $sql = 'SELECT * ,zapis.id_student student FROM `zapis` inner join studenti on zapis.id_student=studenti.id_student where zapis.id_izba="' . $_GET["id_izba"] . '"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Meno</th>';
        echo '<th scope="col">Priezvisko</th>';
        echo '<th scope="col">Rodné Čislo</th>';
        echo '<th scope="col">Pohlavie</th>';
        echo '<th scope="col">Ročník</th>';
        echo '<th scope="col">Stupeň</th>';
        echo '<th scope="col">Fakulta</th>';
        echo '<th scope="col">Izba</th>';
        echo '<th scope="col">Dátum zápisu</th>';
        echo '</tr>';
        echo '</thead>';

        while ($row = $result->fetch_assoc()) {
            //jednoriadkovy zapis if s priradenim do premennej
            $pohlavie = ($row["pohlavie"] == 0) ? 'muz' : 'zena';
            echo '<tbody>';
            echo '<tr>';
            echo '<td>' . $row["meno"] . '</td>
        <td scope="row">' . $row["priezvisko"] . '</td>
        <td scope="row">' . $row["rodne_cislo"] . '</td>
        <td scope="row">' . $pohlavie . '</td>
        <td scope="row">' . $row["rocnik"] . '</td>
        <td scope="row">' . $row["stupen"] . '</td>
        <td scope="row">' . $row["fakulta"] . '</td>
        <td scope="row">' . $row["id_izba"] . '</td>
        <td scope="row">' . $row["datum_pridania"] . '</td>
        <td scope="row">
            <form method="post" action="/Jakubko/public_html/views/daco/studentlist.php">
            <input type="hidden" name="odubytuj" value="' . $row["id_student"] . '">

            <input type="hidden" name="vratma" value="/Jakubko/public_html/views/daco/roomdetail.php?id_izba=' . $_GET["id_izba"] . '">

            <button class="btn btn-warning btn-sm" type="submit" value="Odubytuj">Odubytovat</button>
            </form>
        </td>' . PHP_EOL;
            echo '
    </tr>';
            echo '</tbody>';
        }
        echo '</table>';
    } else {
        echo '0 študentov';
    }

    $sql2 = 'SELECT id_izba, pocet_lozok, pohlavie from izby where id_izba = "' . $_GET["id_izba"] . '"';
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        // output data of each row
        while ($row2 = $result2->fetch_assoc()) {
            echo '
                <form method="post" action="/Jakubko/public_html/views/daco/roomedit.php">
                         <input type="hidden" name="zmazizbu" value="' . $row2["id_izba"] . '">
                            <button class="btn btn-danger align-self-end" class="form-control" type="submit">Zmaz izbu</button>
                </form> 
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6">

            <div class="row">
                <div class="row align-items-center mt-4">
                    <form method="post" action="/Jakubko/public_html/views/daco/roomedit.php">
                        <div class="row">
                            <div class="col">
                                <p class="lead">Uprava izby</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <input placeholder="Pocet lozok" class="form-control" type="number" name="lozok" min="1" max="6" value="' . $row2[" pocet_lozok"] . '" required>
                             </div>
                        </div>
                                <div class="row mt-2">
                                    <div class="col">
                                       <select class="form-control" name="pohlavie">
                                              <option value="0" ';
            if ($row2["pohlavie"] == 0) {
                echo "selected";
            }
            echo '>Muž</option>
                                              <option value="1" ';
            if ($row2["pohlavie"] == 1) {
                echo "selected";
            }
            echo '>Žena</option>
                                        </select>
                                     </div>
                                 </div>
                    <div class="row mt-2">
                        <div class="col">
                           <input type="hidden" name="id_izba" value="' . $row2["id_izba"] . '">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <button value="Upraviť izbu" class="btn btn-success align-self-end" class="form-control" type="submit">Upravit izbu</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
</div>
</div>
';
        }
    }
}
$conn->close();
?>

<?php
include '../partials/footer.php';
?>

