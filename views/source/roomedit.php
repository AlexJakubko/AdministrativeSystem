
<?php
include '../partials/header.php';
?>

<?php include '../../connectdb.php';

if (!empty($_POST["zmazizbu"])) {
    $sql = 'DELETE FROM `izby` WHERE id_izba = "' . $_POST["zmazizbu"] . '"';
    if ($conn->query($sql) === TRUE) {
        echo "<br>Izba úspešne zmazaná.. Budete automaticky presmerovaný<br>";
        header("refresh:3; url=/Jakubko/public_html/views/daco/roomlist.php");
    } else {
        echo "<br>Nemôžem Zmazať izbu: <br>" . $conn->error;
    }
}

if (isset($_POST["lozok"]) && isset($_POST["pohlavie"]) && !empty($_POST["id_izba"])) {
    $sql = 'UPDATE izby SET pocet_lozok="' . $_POST["lozok"] . '",pohlavie="' . $_POST["pohlavie"] . '" WHERE id_izba = "' . $_POST["id_izba"] . '"';
    if ($conn->query($sql) === TRUE) {
        echo "<br>Izba úspešne zmenená.. Budete automaticky presmerovaný<br>";
        header("refresh:3; url=/Jakubko/public_html/views/daco/roomlist.php");
    } else {

        echo "<br>Nemôžem zmeniť izbu: <br>" . $conn->error;
    }
}
$conn->close();
?>

<?php
include '../partials/footer.php';
?>