<?php 
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    $urunID = $_GET['id'];
    include("../../includes/baglanti.php"); 
    if (file_exists($_FILES['resim1']['tmp_name']) || is_uploaded_file($_FILES['resim1']['tmp_name'])) {
        $resimAd1 = $_FILES["resim1"]["name"];
        $resimAdYol1 = $_FILES["resim1"]["tmp_name"];
        $resimTur1 = $_FILES["resim1"]["type"];
        $resimBoyut1 = $_FILES["resim1"]["size"];
        if($resimTur1 != "image/jpeg" && $resimTur1 != "image/png" && $_FILES["resim1"]["size"] > 960000){
        echo "<h1> Eklenen Dosyanın Türü 'jpeg' veya 'png' olmalıdır ve boyut 96MB altı olmalıdır. Yönlendiriliyorsunuz... </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/fotoEkle.php";
        header("Refresh: 4; url=$url");
        }else {
            $index1 =1;
            copy($resimAdYol1,'../../images/urunResimler/'.$resimAd1);
            $imagesPath1 = "../images/urunResimler/".$resimAd1;
            $sorgu1 = "INSERT INTO urunresimler(UrunID,ResimURL,ResimIndex,AnaResimIndex) 
            VALUES($urunID,'$imagesPath1',$index1,1)";
            $sonuc1=$baglanti->query($sorgu1);
            if (!$sonuc1) {
                echo "1.resimde hata...";
            }
        }
    }
    if (file_exists($_FILES['resim2']['tmp_name']) || is_uploaded_file($_FILES['resim2']['tmp_name'])) {
        $resimAd2 = $_FILES["resim2"]["name"];
        $resimAdYol2 = $_FILES["resim2"]["tmp_name"];
        $resimTur2 = $_FILES["resim2"]["type"];
        $resimBoyut2 = $_FILES["resim2"]["size"];
        if($resimTur2 != "image/jpeg" && $resimTur2 != "image/png" && $_FILES["resim2"]["size"] > 960000){
        echo "<h1> Eklenen Dosyanın Türü 'jpeg' veya 'png' olmalıdır ve boyut 96MB altı olmalıdır. Yönlendiriliyorsunuz... </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/fotoEkle.php";
        header("Refresh: 4; url=$url");
        } else {
            $index2 =2;
            copy($resimAdYol2,'../../images/urunResimler/'.$resimAd2);
            $imagesPath2 = "../images/urunResimler/".$resimAd2;
            $sorgu2 = "INSERT INTO urunresimler(UrunID,ResimURL,ResimIndex,AnaResimIndex) 
            VALUES($urunID,'$imagesPath2',$index2,0)";
            $sonuc2 = $baglanti->query($sorgu2);
            if (!$sonuc2) {
                echo "2.resimde hata...";
            }
        } 
    }
    if (file_exists($_FILES['resim3']['tmp_name']) || is_uploaded_file($_FILES['resim3']['tmp_name'])) {
        $resimAd3 = $_FILES["resim3"]["name"];
        $resimAdYol3 = $_FILES["resim3"]["tmp_name"];
        $resimTur3 = $_FILES["resim3"]["type"];
        $resimBoyut3 = $_FILES["resim3"]["size"];
        if($resimTur3 != "image/jpeg" && $resimTur3 != "image/png" && $_FILES["resim3"]["size"] > 960000){
        echo "<h1> Eklenen Dosyanın Türü 'jpeg' veya 'png' olmalıdır ve boyut 96MB altı olmalıdır. Yönlendiriliyorsunuz... </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/fotoEkle.php";
        header("Refresh: 4; url=$url");
        }else {
            $index3 =3;
            copy($resimAdYol3,'../../images/urunResimler/'.$resimAd3);
            $imagesPath3 = "../images/urunResimler/".$resimAd3;
            $sorgu3 = "INSERT INTO urunresimler(UrunID,ResimURL,ResimIndex,AnaResimIndex) 
            VALUES($urunID,'$imagesPath3',$index3,0)";
            $sonuc3 = $baglanti->query($sorgu3);
            if (!$sonuc3) {
                echo "3.resimde hata...";
            }
        }
    }

    $sorguKontrol = "SELECT * From urunler u INNER JOIN urunresimler ur ON ur.UrunID = u.ID Where ur.UrunID = $urunID";
    $sonucKontrol = $baglanti->query($sorguKontrol);
    if (mysqli_num_rows($sonucKontrol)) {
        echo "<h1> Ürün başarıyla eklendi. Yönlendiriliyorsunuz... </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php";
        header("Refresh: 4; url=$url");
    }else {
        echo "<h1> Ekleme yapılamadı hata oluştu. Yönlendiriliyorsunuz...  </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php";
        header("Refresh: 4; url=$url");
    }
    
       

    

}

?>