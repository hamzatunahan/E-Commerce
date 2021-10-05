<?php 

session_start();
ob_start();

$id = $_GET['id'];

include("../../includes/baglanti.php");

$sorgu = "UPDATE kullanicilar 
SET KullaniciAd = '$_POST[kAd]',KullaniciEmail = '$_POST[kEmail]',KullaniciRumuz = '$_POST[kRumuz]' Where ID = $id";

$sonuc = $baglanti->query($sorgu);

if ($sonuc) {

    session_destroy();
    header("Location: /ProjeE-ticaret/adminGiris/loginForms/SaticiGirisYap.php");
}else{
    echo "hata oluştu.";
}
$baglanti->close();


?>