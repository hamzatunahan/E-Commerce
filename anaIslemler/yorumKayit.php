<?php 

session_start();
ob_start();

if (isset($_SESSION['id'],$_SESSION['kullaniciAd'],$_SESSION['sifre'])) {
    

include("../includes/baglanti.php");



$urunID = $_GET['id'];
$kullad = $_SESSION['kullaniciAd'];
$kulID = $_SESSION['id'];


$kullaniciSorgu = "SELECT KullaniciEmail From kullanicilar Where  ID = $kulID";

$emailGetir = $baglanti->query($kullaniciSorgu);

while ($sonucEmail = $emailGetir->fetch_array()) {
    $kullaniciEmail = $sonucEmail['KullaniciEmail'];
}
$mesaj = $_POST['mesaj'];
$yorumTarih = date('d/m/Y H:i:s');
$kullaniciIP = $_SERVER["REMOTE_ADDR"];
$urunPuan = $_POST['puan'];


$yorumSorgu = "INSERT INTO yorumlar(UrunID,KullaniciAd,KullaniciEmail,Mesaj,YorumDurum,KullaniciIP,UrunPuan) 
Values($urunID,'$kullad','$kullaniciEmail','$mesaj',1,'$kullaniciIP',$urunPuan)";

$yorumEkle = $baglanti->query($yorumSorgu);

if ($yorumEkle==0) {
    echo "ekleme başarısız.";
}else{
    header("Location: /ProjeE-ticaret/anaIslemler/uruneGit.php?id=".$urunID."");
}


}

?>