<?php
$host="localhost";
$user="root";
$password="";
$db="web_crud_bem_test";

$koneksi= mysqli_connect($host, $user, $password, $db);
if(!$koneksi){
    die("Koneksi Gagal: ".mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB CRUD BEM TEST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Calon Staff BEM 2024</h2>
        <a class="btn btn-primary" href="/web_crud_bem_test/create.php" role="button">Add List</a>
        <a class="btn btn-primary" href="/web_crud_bem_test/reset.php" role="button">Reset ID</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>NIM</th>
                    <th>DINAS</th>
                    <th>DIVISI</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //read all row from database table
                // $query = "SELECT * FROM user";
                $sql = "SELECT * FROM user";
                $result= $koneksi->query($sql);

                if(!$result){
                    die("Queri Invalid: ".mysqli_connect_error());
                }
                
                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo"
                    <tr>
                    <td>$row[id_user]</td>
                    <td>$row[NAMA]</td>
                    <td>$row[NIM]</td>
                    <td>$row[DINAS]</td>
                    <td>$row[DIVISI]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/web_crud_bem_test/edit.php?id_user=$row[id_user]'>EDIT</a>
                    </td>
                    <td>
                        <a class='btn btn-danger btn-sm' href='/web_crud_bem_test/delete.php?id_user=$row[id_user]'>DELETE</a>
                    </td>
                    </tr>
                    ";
                    
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>