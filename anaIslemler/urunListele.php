<?php include("../includes/header.php"); ?>
<?php include("../includes/banner.php"); ?>


<?php 

$id = $_GET['id'];
include("../includes/baglanti.php"); 

$html = "";



$sorgu = $baglanti->query("SELECT u.ID,ur.ResimURL,u.UrunAdi,u.UrunFiyat,u.ID From urunresimler ur  
INNER JOIN urunler u ON ur.UrunID = u.ID 
INNER JOIN urunkategoriler uk ON uk.ID = u.UrunKategoriID
where u.UrunKategoriID = $id    
");

$IDtext = "ID";

while($cikti = $sorgu->fetch_array()) {
    
    $html .= "
    <div class='col-md-3 '>
    <div class='card m-4' style='width:18rem;'>
    <img class='card-img-top' src='$cikti[ResimURL]' style=' height:18rem;' alt='Card image cap'>
    <div class='card-body'>
        <h3 class='card-title'>$cikti[UrunAdi]</h5>
        <hr>
        <p class='card-text'> <b>$cikti[UrunFiyat] TL</b></p>

        <a href='sepet.php?id=".$cikti[$IDtext]."' class='btn btn-success'>Sepete Ekle</a>
        <a href='uruneGit.php?id=".$cikti[$IDtext]."' class='btn btn-primary ml-3'>Urune Git</a>
    </div>
</div>
</div>
";
};


echo    " <div class='row text-center container-fluid'>
        
        $html

        
        <link rel='stylesheet' type='text/css' href='anasayfa.css' >

</div>";

?>


<?php include("../includes/footer.php"); ?>