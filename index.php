<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SKRIPSI</title>

     <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<?php 

require_once("config.php");

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE Username=:Username OR Email=:Email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":Username" => $Username,
        ":Email" => $Username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($Password, $User["Password"])){
            // buat Session
            session_start();
            $_SESSION["User"] = $User;
            // login sukses, alihkan ke halaman timeline
            header("Location: timeline.php");
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/body.css">

    <title>SKRIPSI</title>
</head>

<body>

    <div class="container-fluid">

        <!-- Card Login -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">

                            <!-- cover -->
                            <div class="col-lg-6 d-none d-lg-block position-relative">
                                <img src="img/Background.png" width="100%" height="100%" class="cover">
                            </div>

                            <!-- form login -->
                            <div class="col-lg-6 position-relative"">
                                <div class="row mt-5 mb-5">
                                    <div class="card mx-auto style="width: 30rem;">
                                        <div class="card-body">
                                            <div class="p-5">
                                                <div class="text-center mt-5">
                                                 <h1 class="h4 judul text-bold">IMPLEMENTASI ALGORITMA PAILLIER CRYPTOSYSTEM </h1></br>
                                                 <h1 class="h4 judul text-bold">PADA ESIGNATURE DALAM PROSES BISNIS </h1>
                                                <h3>Login</h3>
                                                </div>
                                    
                                            </div>
                                           <button type="button" class="btn btn-primary btn-lg btn-block">Login</button>
                                            <a href="registrasi.php" class="btn btn-outline-primary btn-lg btn-block" role="button" aria-pressed="true">Create Account</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.js"></script>

</body>

</html>
</html>