<?php 
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {
    $id = $_GET['id'];
    include("../../includes/baglanti.php");
    $sorguResim = "DELETE FROM urunresimler Where UrunID = $id";
    $sonucResim = $baglanti->query($sorguResim);
    if ($sonucResim) {
       $sorguUrun = "DELETE FROM urunler Where ID = $id";
         $sonucUrun = $baglanti->query($sorguUrun);
        if ($sonucUrun) {
            echo "<h1> Ürününüz başarıyla silindi, Yönlendiriliyorsunuz... </h1>";
            $url = "/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php";
            header("Refresh: 3; url=$url");
        }else {
            echo "hata var resim.";
        }
    }else {
        echo "hata oluştu urun .";
    }

}

?>