<?php 
    session_start();
	require_once("config.php");
    require_once("paillier.php");

	$code = $_GET['code'];
	$sql  = "SELECT * FROM data WHERE kode='$code'";
	$records = $db->query($sql);
    $msg0 = "<div class='alert alert-success'>Signature Uploaded</div>";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Query Data Demo</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/form.css" rel="stylesheet">

    </head>
    <body>
         <!-- Card Login -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <!-- cover -->
                            <div class="col-lg-6 d-none d-lg-block position-relative">
                                <img src="img/Background.png" width="110%" height="100%" class="cover">
                            </div>
                            <!--Form Registrasi-->
                            <div class="row mt-5 mb-5">
                            <div class="card mx-auto" style="width: 30rem;">
                                <div class="card-body">
                                    <h5 class="card-title">DATA TELAH DI PROSES</h5>
                                    <p class="card-text text-danger">Pada langkah ini data telah disimpan dan di komputasi</p>
                                    

                                    <div class="form-group">

                                        <?php 
                                        while ($row = $records->fetch())
                                        {
                                            echo "Username : ".$row['username']."<br>";
                                            echo "Email : ".$row['email']."<br>";
                                            echo "Location File : ".$row['signature']."<br>"."<br>";

                                            echo isset($msg0)?$msg0:'';
                                            echo "File : ".'<img  height="300" width="433" src="data:image/jpeg;base64,'.base64_encode( $row['file'] ).'"/>'."<br>";
                                        }
                                        ?>
                                                               
                                    </div>
                                    <div  class="container">
                                        <div>
                                             <!--TAMPILKAN PUBLIK DAN PRIVET KEY-->
                                            <?php 
                                            { 
                                                $paillier = paillierKey();
                                                echo "Public Key : (". $paillier[0][0]. "," . $paillier[0][1] . ")" . "<br>";
                                                echo "Private Key : (". $paillier[1][0]. "," . $paillier[1][1] . ")" . "<br>";

                                                echo "Kelipatan n : "; var_dump(kelipatanBiner($paillier[0][0])); echo "<br>";
                                                $kelipatanN = kelipatanBiner($paillier[0][0]);
                                            }
                                            ?>
                                        </div>
                                        <div> 
                                            <!--TAMPILKAN KESELURUHAN RGBA-->
                                            <div class="float-sm-end bg-warning">
                                                <?php 
                                                    {
                                                    var_dump($_SESSION['colors']);
                                                    }
                                                ?> 
                                            </div><br>
                                        <div>
                                             <!--TAMPILKAN KOMPUTASI ENKRIPSI-->
                                        </div>
                                    </div>
                                        <button type="button" class="btn btn-danger" id="reset-btn">
                                            <a href="login.php" style="color:white">Keluar</a>
                                        </button>

                                        <button type="submit" class="btn btn-success " id="btn-save">
                                            <a href="user.php" style="color:white">Lanjutkan</a>
                                        </button>
                                </div>
                             </div>
                         </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </body>
</div>
</html>