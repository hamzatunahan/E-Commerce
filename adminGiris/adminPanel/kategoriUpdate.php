<?php 

include("../../includes/baglanti.php");

$id = $_GET['id'];

$kAd = $_POST['kAd'];
$kAciklama = $_POST['kAciklama'];
$ustKat = $_POST['ustKat'];

$sorgu  = "UPDATE urunkategoriler SET KategoriBaslik = '$kAd' , KategoriAciklama = '$kAciklama' , UstID = '$ustKat' Where ID = $id";

$sonuc = $baglanti->query($sorgu);

if ($sonuc) {
    header("Location: /ProjeE-ticaret/adminGiris/adminPanel/kategoriler.php");
}else{
    echo "güncelleme başarısız.";
}

$baglanti->close();


?>