<?php
session_start();
ob_start();

if (isset($_SESSION["adminAd"], $_SESSION["adminID"])) {

    $id = $_GET['id'];
    include("../../includes/baglanti.php");

    $sorgu = "SELECT * From kullanicilar Where ID = $id";
    $sonuc = $baglanti->query($sorgu);
    while ($cikti = $sonuc->fetch_assoc()) {
        $ciktiID = $cikti['ID'];
        $ciktiKullAd = $cikti['KullaniciAd'];
        $durum = $cikti['KullaniciDurum'];
        $yetki = $cikti['KullaniciYetki'];
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


            <form action="kullaniciUpdate.php?id=<?php echo $id ?>" method="post">
                <div class="form-group">
                    <label for="kullID">Kullanıcı ID</label>
                    <input type="text" class="form-control" disabled value="<?php echo $id; ?>">
                </div>
                <div class="form-group">
                    <label for="kullad">Kullanıcı Adı</label>
                    <input type="text" name="kullad" class="form-control" value="<?php echo $ciktiKullAd; ?>">
                </div>
                <div class="form-group">

                    <label for="durumValue">Durum</label>

                    <select class='form-control' name='durumValue'>
                        <?php
                        if ($durum == 1) {
                            echo '1';
                        ?>
                            <option value='0'>Satış yetkisi YOK.</option>
                            <option value='1' selected>Satış Yetkisi VAR</option>
                        <?php
                        } else {
                        ?>
                            <option value='0' selected>Satış Yetkisi YOK</option>
                            <option value='1'>Satış Yetkisi VAR</option>

                        <?php } ?>

                    </select>
                </div>
                <div class="form-group"><label for="yetkiValue">Yetki</label>

                    <select class='form-control' name='yetkiValue'>

                        <?php
                        if ($durum == 1) {
                            echo '1';
                        ?>
                            <option value='0'>Admin yetkisi YOK.</option>
                            <option value='1' selected>Admin Yetkisi VAR</option>
                        <?php
                        } else {
                        ?>
                            <option value='0' selected>Admin Yetkisi YOK</option>
                            <option value='1'>Admin Yetkisi VAR</option>

                        <?php } ?>

                    </select>
                </div>

                <input type="submit" class="btn btn-success mt-3" value="Güncelle"></input>
            </form>

        </div>
    </body>


<?php
}
?>