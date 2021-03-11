<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>PHP CRUD</title>
</head>
<body>
    <?php require_once 'processo.php'; ?>

    <?php 
        if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    <div class="container col-5 pt-3">
    <div class="container">
    <?php 
            $mysqli = new mysqli('localhost', 'root', '', 'CRUD') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            //pre_r($result);
            ?>
             
            <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>regiao</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>  

            <?php 
                while($row = $result->fetch_assoc()): ?>   
            <tr>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['regiao']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Edit</a>
                        <a href="processo.php?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger">Delete</a>
                    </td>
            </tr>
            <?php endwhile; ?>
                    </table>
            </div>
            <?php
            function pre_r( $array ){
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
    ?>
    
    <div class="row justify-content-center">
    <form action="processo.php" method="POST">
    <img src="./img/logo2.gif" alt="" width="320" height="200" class="mx-auto d-block">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label for="">Nome</label>
            <input type="text" name="nome" class="form-control"
                   value="<?php echo $nome; ?>" placeholder="Digite seu nome">
            </div>
            <div class="form-group">
            <label for="">Reigiao</label>
            <input type="text" name="regiao"  class="form-control" 
                   value="<?php echo $regiao; ?>" placeholder="Digite sua regiao">
            </div>
            <div class="form-group">
            <?php 
                if ($update == true):
            ?>
            <button type="submit"  class="btn btn-info" name="update">Update</button>
            <?php else: ?>
            <button type="submit"  class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
    </form>
    </div>
    </div>
    </div>
</body>
</html>