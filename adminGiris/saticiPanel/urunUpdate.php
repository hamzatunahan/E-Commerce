<?php 
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

$urunId = $_GET['id'];
$urun = $_POST['urun'];
$fiyat = $_POST['fiyat'];
$stok = $_POST['stok'];
$anaResimIndex = $_POST['secim'];
include("../../includes/baglanti.php");





$sorguUrun = "UPDATE urunler 
SET UrunAdi ='$urun' , 
    UrunFiyat =$fiyat ,
    UrunStok =$stok 
    Where ID =$urunId;
";


$sorguResim = "UPDATE urunresimler 
SET AnaResimIndex=0
    Where UrunID = $urunId and ResimIndex != $anaResimIndex;
";

$sorguAnaResim = "UPDATE urunresimler 
SET AnaResimIndex=1
    Where UrunID = $urunId and ResimIndex = $anaResimIndex;
";

$sonucUrun = $baglanti->query($sorguUrun);
$sonucResim = $baglanti->query($sorguResim);
$sonucAnaResim = $baglanti->query($sorguAnaResim);

if ($sonucUrun&&$sonucResim&&$sonucAnaResim) {
    echo "<h1>Ürün başarıyla güncellendi, ürünler sayfasına yönlendirileceksiniz...</h1>";
    $url = "/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php";
    header("Refresh: 4; url=$url");
}else {
    echo "hata";    
}


}
?>