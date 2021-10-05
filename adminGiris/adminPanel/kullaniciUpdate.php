<?php 

include("../../includes/baglanti.php");

$id = $_GET['id'];

$kullad = $_POST['kullad'];
$durum = $_POST['durumValue'];
$yetki = $_POST['yetkiValue'];

$sorgu  = "UPDATE kullanicilar SET KullaniciAd = '$kullad' , KullaniciDurum = '$durum' , KullaniciYetki = '$yetki' Where ID = $id";

$sonuc = $baglanti->query($sorgu);

if ($sonuc) {
    header("Location: /ProjeE-ticaret/adminGiris/adminPanel/kullanicilar.php");
}else{
    echo "güncelleme başarısız.";
}

$baglanti->close();


?>