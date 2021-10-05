<?php 
$id = $_GET['id'];

include("../includes/baglanti.php");
$sorgu = $baglanti->query("SELECT u.ID,u.UrunAdi,u.UrunFiyat,u.UrunDetay,ur.ResimURL From urunler u 
INNER JOIN urunResimler ur ON u.ID = ur.UrunID Where u.ID = $id");

$IDtext = "ID";
$adtext = "UrunAdi";
$fiyattext = "UrunFiyat"; 
$detaytext = "UrunDetay";
$html = "";
$resimhtml = "";




while ($cikti = $sorgu->fetch_array()) {


    $html .= "
    <img class='card-img-top rounded mx-auto w-25' src='$cikti[ResimURL]' alt='Card image cap'>
   
    ";
    
    echo $html;

};


?>
