<?php
$host="localhost";
$user="root";
$password="";
$db="web_crud_bem_test";

//buat koneksi
$koneksi = new mysqli($host, $user, $password, $db);

$id = "";
$nama = "";
$nim= "";
$dinas= "";
$divisi= "";
$errorMessage="";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET
    if(!isset($_GET["id_user"])){
        header("location: /web_crud_bem_test/index.php");
        exit;
    }

    $id = $_GET["id_user"];
    $temp = $id;

    //read baris
    $sql = "SELECT * FROM user WHERE id_user=$id";
    $result= $koneksi->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /web_crud_bem_test/index.php");
        exit;
    }

    $nama = $row["NAMA"];
    $nim= $row["NIM"];
    $dinas= $row["DINAS"];
    $divisi= $row["DIVISI"];
} else {
    //POST
    $id= $_POST["id_user"];
    $nama= $_POST["NAMA"];
    $nim= $_POST["NIM"];
    $dinas= $_POST["DINAS"];
    $divisi= $_POST["DIVISI"];

    do{
        if(empty($id) || empty($nama) || empty($nim) ||empty($dinas) ||empty($divisi)){
            $errorMessage="ALL the fields are required";
            break;
        }

        $sql = "UPDATE user SET NAMA = '$nama', NIM = '$nim', DINAS = '$dinas', DIVISI = '$divisi' WHERE id_user = $id ";
        $result= $koneksi->query($sql);
    
        if (!$result){
            $errorMessage="Invalid query: ".$koneksi->error;
            break;
        }

        $successMessage = "SUCCESS";

        header("location: /web_crud_bem_test/index.php");
        exit;
    
    }while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB CRUD BEM TEST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"</script>
</head>
<body>
    <div class="container my-5">
        <h2>Add List</h2>

        <!--if error-->
        <?php
        if(!empty("$errorMessage")){
            echo "
            <divc lass='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        
        <form method="post">
            <input type="hidden" name="id_user" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">NAMA</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="NAMA" value="<?php echo $nama; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="NIM" value="<?php echo $nim; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">DINAS</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="DINAS" value="<?php echo $dinas; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">DIVISI</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="DIVISI" value="<?php echo $divisi; ?>">
                </div>
            </div>

            <!--if success-->
            <?php
            if(!empty("$successMessage")){
                echo "
                <divc lass='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>


            <div class="row mb-3">
                <!-- <label class="col-sm-3 col-form-label">SUBMIT</label> -->
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/web_crud_bem_test/index.php" role='button'>CANCEL</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>