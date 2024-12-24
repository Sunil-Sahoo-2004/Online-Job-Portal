<?php
ob_start();
require "../includes/header.php";
require "../config/config.php";



if (isset($_SESSION['type']) and $_SESSION['type'] !== "Company") {

    header("location: " . APPURL . "");
    exit();

}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM jobs WHERE id='$id'");
    $delete->execute();

    header("location: " . APPURL . "");
    exit();
} else {
    echo "404";
}

ob_end_flush();

?>

<?php require "../includes/footer.php"; ?>