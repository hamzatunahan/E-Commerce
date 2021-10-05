<?php
session_start();
ob_start();

if (isset($_SESSION["kullaniciAd"], $_SESSION["id"], $_SESSION['sifre'])) {

    $id = $_GET['id'];
    include("../../includes/baglanti.php");

    $sorgu = "SELECT * From kullanicilar Where ID = $id";
    $sonuc = $baglanti->query($sorgu);
    while ($cikti = $sonuc->fetch_assoc()) {
        $ciktiID = $cikti['ID'];
    }
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


            <form action="sifreDegis.php?id=<?php echo $id ?>" method="post">
                <div class="form-group">
                    <label for="kullID">Kullanıcı ID</label>
                    <input type="text" class="form-control" disabled value="<?php echo $id; ?>">
                </div>
                <div class="form-group">
                    <label for="ms">Mevcut Kullanımdaki Şifre</label>
                    <input type="password" name="ms" class="form-control" placeholder="Şifrenizi girin">
                </div>
                <div class="form-group">
                    <label for="ys">Yeni Şifre</label>
                    <input type="password" name="ys" class="form-control" placeholder="Yeni şifrenizi girin">
                </div>
                <div class="form-group">
                    <label for="yst">Yeni Şifre Tekrar</label>
                    <input type="password" name="yst" class="form-control" placeholder="Yeni şifrenizi tekrar girin">
                </div>

                <input type="submit" class="btn btn-success mt-3" value="Güncelle"></input>
            </form>

        </div>
    </body>


<?php
}
?>