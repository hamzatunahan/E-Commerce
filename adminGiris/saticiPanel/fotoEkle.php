<?php 
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    include("../../includes/baglanti.php");
    $urunAd = $_POST['urunAd'];
    $fiyat = $_POST['fiyat'];
    $stok = $_POST['stok'];
    $urunDetay = $_POST['urunDetay'];
    $ekleyenID = $_SESSION["saticiID"];
    $kategoriID = $_POST['urunKategoriID'];
    
    $sorguUrun = "INSERT INTO urunler(UrunAdi,UrunFiyat,UrunStok,UrunDetay,UrunEkleyenID,UrunKategoriID,UrunClickSayisi)
                              VALUES('$urunAd',$fiyat,$stok,'$urunDetay',$ekleyenID,$kategoriID,0)";
                          
    $sonucUrun = $baglanti->query($sorguUrun);
    if ($sonucUrun) {
    $sorguUrunID = "SELECT ID
    FROM urunler
    ORDER BY ID DESC
    LIMIT 1";
    $sonucUrunID = $baglanti->query($sorguUrunID);
    while ($cikti = $sonucUrunID->fetch_assoc()) {
        $urunID = $cikti['ID'];
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

            <!-- URUNRESIMLER TABLOSUNA INSERT INTO -->
            <form action="fotoAdd.php?id=<?php echo $urunID ?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="resim1">1. Fotoğraf (Varsayılan olarak ana fotoğraf olacaktır.)</label>
                    <input type="file" name="resim1" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="resim2">2. Fotoğraf </label>
                    <input type="file" name="resim2" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="resim3">3. Fotoğraf </label>
                    <input type="file" name="resim3" class="form-control" value="">
                </div>
                

                <input type="submit" class="btn btn-success mt-3" value="Resim Ekle"></input>
            </form>

        </div>
    </body>





<?php
}else {
    echo "hata oluştu.";
}
}

?>