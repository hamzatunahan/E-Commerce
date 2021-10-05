<?php
session_start();
ob_start();
if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {

    include("../../includes/baglanti.php");
    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $ad = $_POST['ad'];
    $kAd = $_POST['kAd'];

    $sorgu = "UPDATE kullanicilar SET KullaniciAd='$ad' , KullaniciEmail='$email' , KullaniciRumuz='$kAd' Where ID=$id";
    $sonuc = $baglanti->query($sorgu);
    if ($sonuc) {
        echo "<h1>Profiliniz Başarıyla Güncellendi...</h1>
              <br>
              <h1>Yönlendiriliyorsunuz...</h1>
              <h2>Sorunlarınız için <a href='mailto:hamzarslan34@gmail.com'>hamzarslan34@gmail.com</a>.</h2>
            ";
        $url = "/ProjeE-ticaret/anaIslemler/anasayfa.php";
        header("Refresh: 5; url=$url");
    } else {
        echo "<h1>Profil Güncellenemedi...</h1>
        <br>
        <h1>Yönlendiriliyorsunuz...</h1>
        <h2>Sorunlarınız için <a href='mailto:hamzarslan34@gmail.com'>hamzarslan34@gmail.com</a>.</h2>
      ";
        $url = "/ProjeE-ticaret/anaIslemler/anasayfa.php";
        header("Refresh: 5; url=$url");
    }
}
