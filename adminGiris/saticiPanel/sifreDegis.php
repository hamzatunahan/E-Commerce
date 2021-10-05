<?php

session_start();
ob_start();
if (isset($_SESSION['saticiAd'], $_SESSION['saticiID'])) {
    # code...

    $id = $_GET['id'];

    include("../../includes/baglanti.php");

    $sorguVarMi = "SELECT * From kullanicilar Where KullaniciSifre = '$_POST[ms]' and ID = $id";
    $sonucVarMi = $baglanti->query($sorguVarMi);

    if (mysqli_num_rows($sonucVarMi)>0) {

        if ($_POST['ys'] == $_POST['yst']) {

            $sorguSifre = "UPDATE kullanicilar SET KullaniciSifre = '$_POST[ys]' Where ID = $id";
            $sonucSifre = $baglanti->query($sorguSifre);
            if ($sonucSifre) {
                session_destroy();
                echo "<h1 style='margin-left : auto;'>Şifreniz başarıyla değiştirildi tekrar giriş yapmak için yönlendiriliyorsunuz.</h1>";
                $url2 = "/ProjeE-ticaret/adminGiris/loginForms/SaticiGirisYap.php";                
                header("refresh: 3; url=$url2");
            } else {
                echo "sorgu ulaşmadı.";
            }
        } else {

            echo "<h1>Şifreler aynı değil veya farklı bir hata oluştu , lütfen bekleyin yönlendirileceksiniz.</h1>";
            $url = "/ProjeE-ticaret/adminGiris/saticiPanel/sifre.php?id=$_SESSION[saticiID]";

            header("Refresh: 4; url=$url");
        }

        //header("Location: /ProjeE-ticaret/adminGiris/loginForms/SaticiGirisYap.php");
    } else {
        echo "<h1>Mevcut şifrenizi yanlış girdiniz , lütfen bekleyin yönlendirileceksiniz.</h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/sifre.php?id=$_SESSION[saticiID]";
        header("Refresh: 4; url=$url");
    }
    $baglanti->close();
}
