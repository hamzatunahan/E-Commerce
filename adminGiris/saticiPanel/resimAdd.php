<?php 
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    include("../../includes/baglanti.php");    
    $urunID = $_GET['id'];
    $resimAd = $_FILES["resim"]["name"];
    $resimAdYol = $_FILES["resim"]["tmp_name"];
    $resimTur = $_FILES["resim"]["type"];
    $resimBoyut = $_FILES["resim"]["size"];
    if($resimTur != "image/jpeg" && $resimTur != "image/png" && $_FILES["file_resim"]["size"] > 960000){
        echo "<h1> Eklenen Dosyanın Türü 'jpeg' veya 'png' olmalıdır. Yönlendiriliyorsunuz... </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php";
        header("Refresh: 4; url=$url");
    }else {

        $indexKacSorgu = "SELECT ResimIndex From urunresimler Where UrunID=$urunID ORDER BY id DESC LIMIT 1";        
        $indexKacSonuc = $baglanti->query($indexKacSorgu);
        $indexKacCikti = $indexKacSonuc->fetch_assoc();
        $index = $indexKacCikti['ResimIndex']+1;
    
        copy($resimAdYol,'../../images/urunResimler/'.$resimAd);
        $images = "../images/urunResimler/".$resimAd;
        
        $sorgu = "INSERT INTO urunresimler(UrunID,ResimURL,ResimIndex,AnaResimIndex) VALUES($urunID,'$images',$index,0)";
      
        $sonuc = $baglanti->query($sorgu);
        if ($sonuc) {
        echo "<h1> Resim başarıyla eklendi. Yönlendiriliyorsunuz... </h1>";
        $url = "/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php";
        header("Refresh: 4; url=$url");
        }

    }

    







}

?>