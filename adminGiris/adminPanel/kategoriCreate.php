<?php

include("../../includes/baglanti.php");
if (isset($_POST['kAd'], $_POST['kAciklama'], $_POST['ustKat'])) {
    $kAd = $_POST['kAd'];
    $kAciklama = $_POST['kAciklama'];
    $ustKat = $_POST['ustKat'];


    $sorgu = "INSERT INTO urunkategoriler(KategoriBaslik , KategoriAciklama , UstID) 
VALUES('$kAd','$kAciklama',$ustKat)";

    $sonuc = $baglanti->query($sorgu);

    if ($sonuc == 0) {
        echo "bir hata oluştu.";
    } else {
        header("Location: /ProjeE-ticaret/adminGiris/adminPanel/kategoriler.php");
    }
} else {
    echo "<h1 style='margin-left: 10rem; '>Doğru değerler girdiğinizden emin olun. Yönlendiriliyorsunuz...</h1>";
    $url = "/ProjeE-ticaret/adminGiris/adminPanel/kategoriler.php";

    header("Refresh: 4; url=$url");
}

?>