<?php




include("../includes/baglanti.php");
//session başlattık
session_start();
ob_start();

//formdan verileri aldık sorguyu yazdık , syntax hatası olmasın diye textler ayarladık.
$kullaniciRmz = $_POST['rumuz'];
$sifre = $_POST['sifre'];
$sorgu =  "SELECT ID,KullaniciRumuz,KullaniciSifre FROM  kullanicilar Where 
    KullaniciRumuz ='$kullaniciRmz' and KullaniciSifre='$sifre' and KullaniciYetki=1";
$idtext="ID";
$kullanicitext="KullaniciRumuz";
$sifretext="KullaniciSifre";

//if bloğu içinde boş olma durumuna baktık .Boş değilse databaseimize sorgumuza gönderdik.
if ($kullaniciRmz == "" || $sifre = "") {
    echo "Bos bırakmayınız.";
} else {  
    //sorgumuz mysqli alsak da olur
    $sonuc = $baglanti->query($sorgu, MYSQLI_STORE_RESULT);
    //gelen sonuçlar 0 satırsa giriş başarısız çünkü yanlış girmiş kullanıcı bulunamamış.
    if (mysqli_num_rows($sonuc)==0) {       
        echo "Giriş Başarısız.";
    } else {
        //burada fetch yani getir komutu ile bilgileri alıyoruz.
        while ($uyeBilgi=$sonuc->fetch_assoc()) {
            //sessionımıza değerleri atıyoruz ve sayfaya yönlendiriyoruz.
            $_SESSION["saticiAd"] = $uyeBilgi[$kullanicitext];
            $_SESSION["saticiID"] = $uyeBilgi[$idtext];
                
            header("Location: /ProjeE-ticaret/adminGiris/saticiPanel/saticiPanel.php");    
        
        }

        
        
    }
    
}
$baglanti->close();
$sonuc->close();
?>

