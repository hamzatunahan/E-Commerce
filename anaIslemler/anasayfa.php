<?php include("../includes/header.php"); ?>
<?php include("../includes/banner.php"); ?>
<?php


include("../includes/baglanti.php");

include("../includes/sayfadegerler.php");



$sorgu = $baglanti->query("SELECT u.ID,u.UrunAdi,u.UrunFiyat,u.UrunDetay,ur.ResimURL,ur.AnaResimIndex From urunler u INNER JOIN urunResimler ur ON u.ID = ur.UrunID Where ur.AnaResimIndex = 1 LIMIT $limit , $sayfaUrunSayisi ");


$IDtext = "ID";
$adtext = "UrunAdi";
$fiyattext = "UrunFiyat";
$detaytext = "UrunDetay";
$resim = "ResimURL";
$anaResim = "AnaResimIndex";
$html = "";



while ($cikti = $sorgu->fetch_array()) {

    if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre']) || isset($_SESSION['adminID'], $_SESSION['adminAd']) || isset($_SESSION['saticiAd'], $_SESSION['saticiID'])) {
        $html .= "
        <div class='col-md-4 '>
        <div class='card m-4' style='width:22rem; height:37rem;'>
        <img class='card-img-top' src='$cikti[ResimURL]' style=' height:18rem;' alt='Card image cap'>
        <div class='card-body'>
            <h3 class='card-title'>$cikti[UrunAdi]</h5>
            <hr>
            <p class='card-text'> <b>$cikti[UrunFiyat] TL</b></p>
    
            <a href='sepet.php?id=" . $cikti[$IDtext] . "' class='btn btn-success'>Sepete Ekle</a>
            <a href='uruneGit.php?id=" . $cikti[$IDtext] . "' class='btn btn-primary ml-3'>Urune Git</a>          
        </div>
        <div class='card-footer'>
            <strong>Ürün adedi artışı için sepete gidin.</strong>
        </div>
        </div>
        </div>
    ";
    } else {
        $html .= "
        <div class='col-md-4 '>
        <div class='card m-4' style='width:22rem; height:35rem;'>
        <img class='card-img-top' src='$cikti[ResimURL]' style=' height:18rem;' alt='Card image cap'>
        <div class='card-body'>
            <h3 class='card-title'>$cikti[UrunAdi]</h5>
            <hr>
            <p class='card-text'> <b>$cikti[UrunFiyat] TL</b></p>
    
            <a href='/ProjeE-ticaret/adminGiris/adminGiris.php' class='btn btn-danger'>Alışveriş için Giriş Yapın</a>
        </div>
    </div>
    </div>
    ";
    }
};


include("../includes/sayfanumaralar.php");

echo    " <div class='row text-center container-fluid'>
        
        $html

        
        <link rel='stylesheet' type='text/css' href='anasayfa.css' >
        
</div>
<div class='text-center text-white' >

$sayfaNumara

</div>

";


$sorgu->close();
$baglanti->close();

?>


<?php include("../includes/footer.php"); ?>