<?php


include("../includes/baglanti.php");

session_start();
ob_start();


if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {

    $id = $_SESSION['id'];
    $sepet = "SELECT KullaniciID From sepet Where KullaniciID = '$id'";

    $sepetVar = $baglanti->query($sepet, MYSQLI_STORE_RESULT);
    if (mysqli_num_rows($sepetVar) == 0) {

        $sorgu = "INSERT INTO sepet(KullaniciID) VALUES($id)";

        $sonuc = mysqli_query($baglanti, $sorgu);


        if ($sonuc == 0) {
            echo "Sepet Ekleme Başarısız oldu";
        }
    } else {
        $ids = $_SESSION['id'];
        $sepetid = "SELECT ID FROM sepet Where KullaniciID = '$ids'";
        $sepetID = $baglanti->query($sepetid);
        while ($sepetIDsonuc = $sepetID->fetch_assoc()) {
            $sepetIDresult = $sepetIDsonuc['ID'];
        }

        $idurun = $_GET['id'];
        $urunSorgu = "SELECT UrunFiyat FROM urunler Where ID = '$idurun'";
        $urunBagla = $baglanti->query($urunSorgu);
        while ($urunSonuc = $urunBagla->fetch_assoc()) {
            $urunFiyat = $urunSonuc['UrunFiyat'];
        }
        $adet = 1;

        
        $sorguKontrol = "SELECT
	    su.SepetID,
	    s.KullaniciID,
        u.ID,
	    u.UrunAdi ,
	    su.UrunAdet,
	    su.UrunFiyat
        FROM
	    sepeturunu AS su
	    INNER JOIN urunler AS u ON su.UrunID = u.ID
	    INNER JOIN sepet AS s ON s.ID = su.SepetID
        Where s.KullaniciID = $ids and u.ID = $idurun
        ";
    

        $sonucKontrol = mysqli_query($baglanti,$sorguKontrol,MYSQLI_STORE_RESULT);

        if (mysqli_num_rows($sonucKontrol)>0) {
            
            echo "
            
            <div style='font-size:5rem; text-align:center'>Bu ürün zaten sepette var.<div/>
            <div style='font-size:3rem; text-align:center'>Yönlendiriliyorsunuz .<div/>

            
            ";

            $url = "/ProjeE-ticaret/anaIslemler/sepetListele.php";

            header("Refresh: 4; url=$url");


        }else{

            $ekleurunQuery = "INSERT INTO sepeturunu(SepetID , UrunID , UrunAdet , UrunFiyat) VALUES ('$sepetIDresult','$idurun','$adet','$urunFiyat')";

            if ($baglanti->query($ekleurunQuery)) {
                header("Location: /ProjeE-ticaret/anaIslemler/sepetListele.php");
            } else {
                echo "Sepet Urun Ekleme Başarısız oldu " . $urunFiyat . " " . $idurun . " " . $adet . " " . $sepetIDresult;
            }


        }


        
    }
}
$baglanti->close();
