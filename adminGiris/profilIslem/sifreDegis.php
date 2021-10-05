<?php

session_start();
ob_start();
if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {
    # code...

    $id = $_GET['id'];

    include("../../includes/baglanti.php");

    $sorguVarMi = "SELECT * From kullanicilar Where KullaniciSifre = $_POST[ms] and ID = $id";

    $sonucVarMi = $baglanti->query($sorguVarMi);

    if ($sonucVarMi) {

        if ($_POST['ys'] == $_POST['yst']) {

            $sorguSifre = "UPDATE kullanicilar SET KullaniciSifre = $_POST[ys] Where ID = $id";
            $sonucSifre = $baglanti->query($sorguSifre);
            if ($sonucSifre) {
                session_destroy();
                echo "<h1 style='margin-left : auto;'>Şifreniz başarıyla değiştirildi tekrar giriş yapmak için yönlendiriliyorsunuz.</h1>";
                $url2 = "/ProjeE-ticaret/adminGiris/loginForms/kullaniciGirisYap.php";                
                header("refresh: 3; url=$url2");
            } else {
                echo "sorgu ulaşmadı.";
            }
        } else {

            echo "Şifreler aynı değil veya farklı bir hata oluştu , lütfen bekleyin yönlendirileceksiniz.";
            $url = "/ProjeE-ticaret/adminGiris/profilIslem/sifre.php?id=$_SESSION[id]";

            header("Refresh: 4; url=$url");
        }

    } else {
        echo "hata oluştu.";
    }
    $baglanti->close();
}
