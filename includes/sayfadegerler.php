<?php 



$sayfaUrunSayisi= 6;
$sayfaUrunSorgu = $baglanti->query("SELECT COUNT(*) as adet FROM urunler");
$sayfaUrunSonuc = mysqli_fetch_assoc($sayfaUrunSorgu);
$toplamUrun = $sayfaUrunSonuc['adet'];

$toplamSayfa = ceil($toplamUrun / $sayfaUrunSayisi);

//sayı girilmediyse 1.sayfayı versin
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

if ($sayfa <1) {
    $sayfa = 1;
}

if ($sayfa > $toplamSayfa) {
    $sayfa = $toplamSayfa;
}

$limit = ($sayfa -1)*$sayfaUrunSayisi;


?>