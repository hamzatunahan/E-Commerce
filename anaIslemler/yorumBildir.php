<?php

session_start();
ob_start();

if (isset($_SESSION['id'],$_SESSION['kullaniciAd'],$_SESSION['sifre'])) {
    $bildirenID = $_SESSION['id'];
    $Yorumid = $_GET['id'];
    include("../includes/baglanti.php");

    $sorguVarMi = "SELECT * From yorumlarbildirilen Where BildirenID = $bildirenID and YorumID = $Yorumid";
    $sonucVarMi = $baglanti->query($sorguVarMi);
    //sonuç kontrolu yaptık ,sonuç yoksa if bloğuna gir amaç birden fazla kez bildirilme olmasın.
    if (mysqli_num_rows($sonucVarMi)==0) {
    //burada ürünün satıcısının idsini mesaj içeriğini ve yorumun yorum tablosundaki bildiriliş sayısını alıyoruz.
    $sorgu = "SELECT u.UrunEkleyenID,y.Mesaj,y.YorumBildirim From yorumlar y INNER JOIN urunler u ON y.UrunID = u.ID Where y.ID = $Yorumid";

    $sonuc = $baglanti->query($sorgu);
    $cikti = $sonuc->fetch_assoc();
    $yeniDeger = $cikti['YorumBildirim'] + 1;
    //aldığımız yorumbildirim değeri bildiriliş sayısıdır ve bu değeri bir artırıyoruz aşağıda da yorumlarbildirilen sayfasına insert yapıyoruz.
    $sorguBildir = "INSERT INTO yorumlarbildirilen( Mesaj , BildirenID , YorumID) VALUES('$cikti[Mesaj]',$bildirenID,$Yorumid )";
  
    $sonucBildir = $baglanti->query($sorguBildir);

    if ($sonucBildir) {
        //başarıyla insert yapıldıysa burada yorumlar tablosundaki yorumun bildiriliş değerini bir artırıyoruz.
        $sorguGonder = "UPDATE yorumlar SET YorumBildirim = $yeniDeger Where ID = $Yorumid";
        $sonucGonder = $baglanti->query($sorguGonder);

        if ($sonucGonder) {
            echo "<h1> Yorum başarıyla bildirildi. İnceleme sonucu silinip silinmemesine karar vereceğiz. Teşekkürler.. </h1>";
            $url = "/ProjeE-ticaret/anaIslemler/anasayfa.php";
            header("Refresh: 4; url=$url");
        } else {
            echo "bir hata oluştu burada.";
        }
    }else {
        echo "bir hata oluştu şurada";
    }

    }else{
            echo "<h1> Yorum zaten bildirildi. İnceleme sonucu silinip silinmemesine karar vereceğiz. Teşekkürler.. </h1>";
            $url = "/ProjeE-ticaret/anaIslemler/anasayfa.php";
            header("Refresh: 4; url=$url");
    }

    $baglanti->close();
}

?>