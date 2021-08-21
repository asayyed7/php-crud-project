<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'documents') or die(mysqli_error($mysqli));

$perDoc = '';
$canDoc = '';
$curDoc = '';
$id = 0;
$update = false;


if (isset($_POST['add'])){
    $perDoc = $_POST['perDoc'];
    $canDoc = $_POST['canDoc'];
    $curDoc = $_POST['curDoc'];

    $mysqli->query("INSERT INTO docs (perDoc, canDoc, curDoc) VALUES('$perDoc', '$canDoc', '$curDoc')") or
            die($mysqli->error);

    $_SESSION['message'] = "Documents has been uploaded!";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM docs WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Documents has been deleted!";

    header("location: index.php");
} 

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM docs WHERE id=$id") or die($mysqli->error());
        $row = $result->fetch_array();
        $perDoc = $row['perDoc'];
        $canDoc = $row['canDoc'];
        $curDoc = $row['curDoc'];
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $perDoc = $_POST['perDoc'];
    $canDoc = $_POST['canDoc'];
    $curDoc = $_POST['curDoc'];

    $mysqli->query("UPDATE docs SET perDoc='$perDoc', canDoc='$canDoc', curDoc='$curDoc' WHERE id=$id") or
    die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";

    header('location: index.php');
}



