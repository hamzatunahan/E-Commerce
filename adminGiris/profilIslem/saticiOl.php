<?php

session_start();
ob_start();
include("../../includes/headerClear.php");

if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {

    $id  = $_GET['id'];



?>


    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Proje E- ticaret</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
    </head>

    <body>
        <div class="container mt-5 mb-5">


            <form class="border p-5 text-white" action="basvuru.php?id=<?php echo $id ?>" method="post">
                <div class="form-group">
                    <label for="kullID">Kullanıcı ID</label>
                    <input type="text" class="form-control" disabled value="<?php echo $id; ?>">
                </div>
                <div class="form-group">
                    <label for="tanitim">Tanıtım</label>
                    <textarea type="text" placeholder="Kısaca yapacağınız satışlardan bahsedin." name="tanitim" class="form-control" value=""></textarea>
                </div>
                <input type="submit" class="btn btn-success mt-3" value="Güncelle"></input>
            </form>

        </div>
    </body>


<?php

}
?>