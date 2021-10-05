<?php
session_start();
ob_start();

if (isset($_SESSION["adminAd"], $_SESSION["adminID"])) {

    $id = $_GET['id'];
    include("../../includes/baglanti.php");

    $sorgu = "SELECT * From urunkategoriler Where ID = $id";

    $sonuc = $baglanti->query($sorgu);
    while ($cikti = $sonuc->fetch_assoc()) {
        $ciktiID = $cikti['ID'];
        $ciktiKad = $cikti['KategoriBaslik'];
        $ciktiKaciklama = $cikti['KategoriAciklama'];
    }

    function selectIcerik()
    {


        include("../../includes/baglanti.php");
        $sorgu = "SELECT * From urunkategoriler";
        $sonuc = $baglanti->query($sorgu);
        $html = "";
        while ($cikti = $sonuc->fetch_array()) {
            $html = "
            <option value='$cikti[ID]'>$cikti[KategoriBaslik]</option>            
            ";
            echo $html;
        }
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


            <form action="kategoriUpdate.php?id=<?php echo $id ?>" method="post">
                <div class="form-group">
                    <label for="kullID">Kategori ID</label>
                    <input type="text" class="form-control" disabled value="<?php echo $id; ?>">
                </div>
                <div class="form-group">
                    <label for="kAd">Kategori Adı</label>
                    <input type="text" name="kAd" class="form-control" value="<?php echo $ciktiKad; ?>">
                </div>
                <div class="form-group">
                    <label for="kAciklama">Açıklama</label>
                    <input type="text" name="kAciklama" class="form-control" value="<?php echo $ciktiKaciklama; ?>">
                </div>
                <div class="form-group">

                    <label for="ustKat">Durum</label>

                    <select class='form-control' name='ustKat'>
                        <option value='' selected disabled hidden>
                            Ürün bir üst kategoriye aitse, ait olduğu kategoriyi seçiniz.
                        </option>
                        <?php selectIcerik() ?>

                    </select>
                </div>

                <input type="submit" class="btn btn-success mt-3" value="Güncelle"></input>
            </form>

        </div>
    </body>


<?php
}
?>