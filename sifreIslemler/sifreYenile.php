<?php

if (isset($_POST['yeniSifre'], $_POST['yeniSifreTekrar'])) {
    include("../includes/baglanti.php");
    $yeniSifre = $_POST['yeniSifre'];
    $yeniSifreTekrar = $_POST['yeniSifreTekrar'];
    $eposta = $_POST['eposta'];
    if ($yeniSifre == $yeniSifreTekrar) {

        $sifreSorgu = "UPDATE kullanicilar SET KullaniciSifre = $yeniSifre Where KullaniciEmail = '$eposta'";

        $sifreSonuc = $baglanti->query($sifreSorgu);
        if ($sifreSonuc) {

            $dogrulamaSil = "DELETE From dogrulama Where Mail = '$eposta'";
            $dogrulamaSilSonuc = $baglanti->query($dogrulamaSil);
            if ($dogrulamaSilSonuc) {

                echo "
                     <h1>Şifreniz Başarıyla Güncellenmiştir.</h1>
                     <br>
                     <br>
                     <h1>Yönlendiriliyorsunuz...</h1>
                     ";
                    $url = "/ProjeE-ticaret/adminGiris/adminGiris.php";
                    header("Refresh: 3; url=$url");
            } else {
                echo "
                    <h1>Doğrulama sırasında hata oluştu tekrar deneyin.</h1>
                    <br>
                    <h1>Yönlendiriliyorsunuz...</h1>
                    ";
                    $url = "/ProjeE-ticaret/sifreIslemler/dogrula.php";
                    header("Refresh: 5; url=$url");
            }
        } else {
            echo "
                    <h1>Doğrulama sırasında hata oluştu tekrar deneyin.</h1>
                    <br>
                    <h1>Yönlendiriliyorsunuz...</h1>
                    ";
                    $url = "/ProjeE-ticaret/sifreIslemler/dogrula.php";
                    header("Refresh: 5; url=$url");
        }
    } else {
        echo "
        <h1>Şifreleriniz aynı değil tekrar deneyin.</h1>
        <br>
        <h1>Yönlendiriliyorsunuz...</h1>
        ";
        $url = "/ProjeE-ticaret/sifreIslemler/dogrula.php";
        header("Refresh: 5; url=$url");
    }
}else {
    echo "
        <h1>Önce Şifremi Unuttum Kısmından E-postanıza Gelen Kodu Girin.</h1>
        <br>
        <h1>Yönlendiriliyorsunuz...</h1>
        ";
        $url = "/ProjeE-ticaret/sifreIslemler/epostaGir.php";
        header("Refresh: 5; url=$url");
}
