<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'CRUD') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nome = '';
$regiao = '';

if(isset($_POST['save'])){
    $nome   = $_POST['nome'];
    $regiao = $_POST['regiao'];

    $mysqli->query("INSERT INTO data (nome, regiao) VALUES('$nome', '$regiao')") or 
        die($mysqli->error);

    $_SESSION['message'] = "Record has benn saved!";
    $_SESSION['msg_type']= "success";

    header("location: index.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has benn deletado!";
    $_SESSION['msg_type']= "danger";
    
    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if ($result->num_rows){
        $row = $result->fetch_array();
        $nome = $row['nome'];
        $regiao = $row['regiao'];
    }
}

if (isset($_POST['update'])){
    $id     = $_POST['id'];
    $nome   = $_POST['nome'];
    $regiao = $_POST['regiao'];

    $mysqli->query("UPDATE data SET nome='$nome', regiao='$regiao' WHERE id=$id") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "Warning";

    header("location: index.php");
}