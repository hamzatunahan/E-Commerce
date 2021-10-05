<?php

session_start();
ob_start();

if (isset($_SESSION['saticiAd'], $_SESSION['saticiID'])) {
    $bildirenID = $_SESSION['saticiID'];
    $id = $_GET['id'];
    include("../../includes/baglanti.php");

    $sorguVarMi = "SELECT * From yorumlarbildirilen Where BildirenID = $bildirenID and YorumID = $id";
    $sonucVarMi = $baglanti->query($sorguVarMi);
    //sonuç yoksa if bloğuna gir
    if (mysqli_num_rows($sonucVarMi)==0) {

    $sorgu = "SELECT u.UrunEkleyenID,y.Mesaj,y.YorumBildirim From yorumlar y INNER JOIN urunler u ON y.UrunID = u.ID Where y.ID = $id";

    $sonuc = $baglanti->query($sorgu);
    $cikti = $sonuc->fetch_assoc();
    $yeniDeger = $cikti['YorumBildirim'] + 1;

    $sorguBildir = "INSERT INTO yorumlarbildirilen( Mesaj , BildirenID , YorumID) VALUES('$cikti[Mesaj]',$cikti[UrunEkleyenID],$id )";
  
    $sonucBildir = $baglanti->query($sorguBildir);

    if ($sonucBildir) {
        $sorguGonder = "UPDATE yorumlar SET YorumBildirim = $yeniDeger Where ID = $id";
        $sonucGonder = $baglanti->query($sorguGonder);

        if ($sonucGonder) {
            echo "<h1> Yorum başarıyla bildirildi. İnceleme sonucu silinip silinmemesine karar vereceğiz. Teşekkürler.. </h1>";
            $url = "/ProjeE-ticaret/adminGiris/saticiPanel/yorumlar.php";
            header("Refresh: 4; url=$url");
        } else {
            echo "bir hata oluştu burada.";
        }
    }else {
        echo "bir hata oluştu şurada";
    }

    }else{
            echo "<h1> Yorum zaten bildirildi. İnceleme sonucu silinip silinmemesine karar vereceğiz. Teşekkürler.. </h1>";
            $url = "/ProjeE-ticaret/adminGiris/saticiPanel/yorumlar.php";
            header("Refresh: 4; url=$url");
    }

    $baglanti->close();
}

?>