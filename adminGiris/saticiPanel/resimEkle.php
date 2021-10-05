<?php 
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    $urunID = $_GET['id'];




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


            <form action="resimAdd.php?id=<?php echo $urunID ?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="resim">Resmin dosya yolunu seçin</label>
                    <input type="file" name="resim" class="form-control" value="">
                </div>
                

                <input type="submit" class="btn btn-success mt-3" value="Resim Ekle"></input>
            </form>

        </div>
    </body>





<?php

}

?>