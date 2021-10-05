<?php





if (isset($_POST["ad"], $_POST["mail"], $_POST["rumuz"], $_POST["sifre"])) {



    include("../includes/baglanti.php");


    $ad = $_POST["ad"];
    $mail = $_POST["mail"];
    $rumuz = $_POST["rumuz"];
    $sifre = $_POST["sifre"];
    $saticiMi = "";
    if (isset($_POST["saticiMi"])) {
        $saticiMi = $_POST["saticiMi"];
    } else {
        $saticiMi = 0;
    }

    $varMiMail = "SELECT * From kullanicilar Where KullaniciEmail = '$mail'";    
    $varMiMailSorgu = $baglanti->query($varMiMail);
    if (mysqli_num_rows($varMiMailSorgu) == 0) {

        $varMiRumuz = "SELECT * From kullanicilar Where KullaniciRumuz = '$rumuz'";
        $varMiRumuzSorgu = $baglanti->query($varMiRumuz);
        
        if (mysqli_num_rows($varMiRumuzSorgu) != 0) {
            $sorgu =  "INSERT INTO kullanicilar(KullaniciAd , KullaniciEmail , KullaniciRumuz , KullaniciSifre , KullaniciDurum) VALUES ('$ad','$mail','$rumuz','$sifre','$saticiMi')";

            $cikti = mysqli_query($baglanti, $sorgu);

            if ($cikti == 0) {
                echo "<p> Ekleme Başarısız. </p>";
            } else {

                //Burası link verme gibi çalışıyor. 
                header("Location: /ProjeE-ticaret/adminGiris/loginForms/kullaniciGirisYap.php");
            }

            $cikti->close();
            $baglanti->close();
        } else {

            echo "
                <h1>Bu kullanıcı adı daha önce alınmış.</h1>
                <br>
                <h1>Lütfen yeni bir kullanıcı adı almayı deneyin.</h1>
                <br>
                <h1>Yönlendiriliyorsunuz...</h1>
                ";
            $url = "/ProjeE-ticaret/adminGiris/uyeForm.php";
            header("Refresh: 5; url=$url");
        }
    } else {

        echo "
        <h1>Bu mail adresine ait bir kayıt daha önce yapıldı.</h1>
        <br>
        <h1>Yönlendiriliyorsunuz...</h1>
        ";
        $url = "/ProjeE-ticaret/adminGiris/uyeForm.php";
        header("Refresh: 5; url=$url");
    }
}
