<?php

session_start();
ob_start();


if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {

    include("../../includes/baglanti.php");
    $id  = $_GET['id'];

    $tanitim = $_POST['tanitim'];

    $basvuruVarMi = "SELECT * From saticibasvuru Where KullaniciID = $id";
    $basvuruVarMiSonuc = $baglanti->query($basvuruVarMi);
    if (mysqli_num_rows($basvuruVarMiSonuc) != 0) {
        echo "<h1>Halihazırda bir başvurunuz var. Lütfen biz geri dönüş sağlayana kadar bekleyin...</h1>
              <br>
              <h1>Yönlendiriliyorsunuz...</h1>
              <h2>Sorunlarınız için <a href='mailto:hamzarslan34@gmail.com'>hamzarslan34@gmail.com</a>.</h2>
            ";
        $url = "/ProjeE-ticaret/anaIslemler/anasayfa.php";
        header("Refresh: 5; url=$url");
    } else {
        $basvuruEkle = "INSERT INTO saticibasvuru(KullaniciID,Tanitim) VALUES($id,'$tanitim')";
        $basvuruEkleSonuc = $baglanti->query($basvuruEkle);
        if ($basvuruEkleSonuc) {
        echo "<h1>Başvurunuz alınmıştır. Lütfen biz geri dönüş sağlayana kadar bekleyiniz...</h1>
             <br>
             <h1>Yönlendiriliyorsunuz...</h1>
             <br>
             <h2>Sorunlarınız için <a href='mailto:hamzarslan34@gmail.com'>hamzarslan34@gmail.com</a>.</h2>
           ";
        $url = "/ProjeE-ticaret/anaIslemler/anasayfa.php";
        header("Refresh: 5; url=$url");
        }else {
            echo "<h1>Başvurunuz alınamadı!</h1>
             <br>
             <h1>Yönlendiriliyorsunuz...</h1>
             <br>
             <h2>Sorunlarınız için <a href='mailto:hamzarslan34@gmail.com'>hamzarslan34@gmail.com</a>.</h2>
           ";
        }
    }
}
