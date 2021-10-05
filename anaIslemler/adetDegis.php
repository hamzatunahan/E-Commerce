<?php 

include("../includes/baglanti.php");

$adet = $_POST['adetValue'];
$urunID = $_GET['id'];


$sorgu = "UPDATE sepeturunu SET UrunAdet ='$adet' WHERE ID=$urunID";



if ($baglanti->query($sorgu)) {
    
    //Burası link verme gibi çalışıyor. 
    header("Location: /ProjeE-ticaret/anaIslemler/sepetListele.php");
    
}else{

    echo "<p> Ekleme Başarısız. </p>";
}
$baglanti->close();
?>