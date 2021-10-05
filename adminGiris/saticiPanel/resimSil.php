<?php 
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    $resimID = $_GET['id'];


    include("../../includes/baglanti.php");

    $sorgu = "DELETE FROM urunresimler Where ID = $resimID";

    $sonuc = $baglanti->query($sorgu);

    if ($sonuc) {
        echo "<h1> Fotoğraf başarıyla silindi. Ürün işlemleri sayfasına yönlendirileceksiniz... </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php";
        header("Refresh: 4; url=$url");
    }else {
        echo "sorun oluştu.";
    }
    







}

?>