<?php
include '../partials/header.php';
?>
<?php
include '../../connectdb.php';

if (isset($_POST["odubytuj"]) && !empty($_POST["odubytuj"])) {
    $sqlodubyt = "delete from zapis where id_student = " . $_POST["odubytuj"] . ";";
    if ($conn->query($sqlodubyt) === TRUE) {
        echo "<div class='alert alert-warning' role='alert'>Student odubytovany!</div>";
    } else {
        echo "Error" . $conn->error;;
    }
}

if (isset($_POST["zmazstudenta"]) && !empty($_POST["zmazstudenta"])) {
    $sqlodubyt = "delete from studenti where id_student = " . $_POST["zmazstudenta"] . ";";
    if ($conn->query($sqlodubyt) === TRUE) {
        echo "<div class='alert alert-danger' role='alert'>Student zmazany!</div>";
    } else {
        echo "Error" . $conn->error;;
    }
}

if (isset($_GET["lastname"])) {
    $priezviskosearch = 'where priezvisko LIKE "%' . $_GET["lastname"] . '%"';
} else {
    $priezviskosearch = '';
}
?>


</form>
</div>
</div> <?php
        include 'connectdb.php';
        $sql = "SELECT studenti.id_student id_student, meno, priezvisko, rodne_cislo, pohlavie, rocnik, stupen, fakulta, id_izba, datum_pridania FROM studenti left join zapis on studenti.id_student=zapis.id_student " . $priezviskosearch;
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
                $pohlavie =  ($row["pohlavie"] == 0) ? 'muz' : 'zena';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $row["meno"] . '</td>
        <td>' . $row["priezvisko"] . '</td>
        <td>' . $row["rodne_cislo"] . '</td>
        <td>' . $pohlavie . '</td>
        <td>' . $row["rocnik"] . '</td>
        <td>' . $row["stupen"] . '</td>
        <td>' . $row["fakulta"] . '</td>
        <td>' . $row["id_izba"] . '</td>
        <td>' . $row["datum_pridania"] . '</td>
        <td>
        <form method="post" action="">
            <input type="hidden" name="zmazstudenta" value="' . $row["id_student"] . '">
            <button class="btn btn-danger btn-sm" type="submit" value="Zmazat">Zmazat</button>
        </form>
        </td>
        <td>
         <form method="post" action="">
         <input type="hidden" name="odubytuj" value="' . $row["id_student"] . '">
            <button class="btn btn-warning btn-sm" type="submit" value="Odubytuj">Odubytovat</button>
        </form>

    </td>' . PHP_EOL;
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '0 študentov';
        }
        $conn->close();
        ?> <?php
            include '../partials/footer.php';
            ?>