<?php
if(isset($_GET['id_user'])){
    $id=$_GET['id_user'];

    $host="localhost";
    $user="root";
    $password="";
    $db="web_crud_bem_test";

    //buat koneksi
    $koneksi = new mysqli($host, $user, $password, $db);

    $sql="DELETE FROM user WHERE id_user=$id";
    $koneksi->query($sql);
}

header("location: /web_crud_bem_test/index.php");
exit;
?>