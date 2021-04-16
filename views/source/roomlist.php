<?php
include '../partials/header.php';
?>

<?php
include '../../connectdb.php';
$sql = "select i.id_izba id_izba, blok, poschodie, pocet_lozok, obsadenie_izby, pohlavie from izby i left join (SELECT id_izba, count(*) obsadenie_izby FROM zapis group by id_izba) z on i.id_izba=z.id_izba order by id_izba;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $prevblok = "XYZ";
    $prevposchodie = -9999;
    echo '<table style="width:80%" border="1">';
    while ($row = $result->fetch_assoc()) {
        if ($row["obsadenie_izby"] == NULL) {
            $row["obsadenie_izby"] = 0;
        }
        if (isset($row["pohlavie"])) {
            if ($row["pohlavie"] == 0) {
                $pohlavie = 'mužská';
                $style = ' bgcolor="lightblue"';
            } else {
                $pohlavie = 'ženská';
                $style = ' bgcolor="pink"';
            }
        } else {
            $pohlavie = 'error';
        }
        if ($row["blok"] != $prevblok) {
            echo "<tr><th>Blok " . $row["blok"] . "</th></tr>";
        }
        if ($row["poschodie"] != $prevposchodie) {
            echo "<tr><th>Poschodie " . $row["poschodie"] . "</th></tr>";
        }
        echo '<td' . $style . '><a href="/Jakubko/public_html/views/daco/roomdetail.php?id_izba=' . $row["id_izba"] . '">' . $row["id_izba"] . ' -' . $row["obsadenie_izby"] . '/' . $row["pocet_lozok"] . ' / ' . $pohlavie . '</a>
        </td>';
        $prevblok = $row["blok"];
        $prevposchodie = $row["poschodie"];
    }

    echo '</table>';
} else {
    echo "0 výsledkov";
}
$conn->close();
?>

<?php
include '../partials/footer.php';
?>
