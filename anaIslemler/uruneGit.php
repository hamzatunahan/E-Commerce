<?php

include("../includes/header.php"); 
if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre']) || isset($_SESSION['adminID'], $_SESSION['adminAd']) || isset($_SESSION['saticiAd'], $_SESSION['saticiID'])) {


 
 ?>

<?php
$id = $_GET['id'];
include("../includes/baglanti.php");

$sorgu = $baglanti->query("SELECT u.ID,u.UrunAdi,u.UrunFiyat,u.UrunDetay,ur.ResimURL From urunler u 
INNER JOIN urunResimler ur ON u.ID = ur.UrunID Where $id = ur.UrunID");



$IDtext = "ID";
$adtext = "UrunAdi";
$fiyattext = "UrunFiyat"; 
$detaytext = "UrunDetay";
$html = "";
$resimhtml = "";
$urunyorumlar = "";
$urunYorumlarOrt="";
while ($cikti = $sorgu->fetch_array()) {

       
    $resimhtml .="
    <div class = 'col-md-4'>
    <img class='rounded mx-auto d-inline w-100' src='$cikti[ResimURL]' alt='Card image cap'>
    </div>
    ";
    $ad = $cikti[$adtext];
    $detay = $cikti[$detaytext]; 
    $fiyat = $cikti[$fiyattext];
    $idsepet = $cikti[$IDtext];
 }

if ($baglanti->query("SELECT u.ID,u.UrunAdi,u.UrunFiyat,u.UrunDetay,ur.ResimURL From urunler u 
INNER JOIN urunResimler ur ON u.ID = ur.UrunID Where $id = ur.UrunID")) {
     $html .= "<div class='card text-dark p-5' id='marg' style='width: 48rem;'>
     <div class='row'> 
     $resimhtml
    </div>
    <h2 class='card-title text-center mt-4'>$ad</h2>
        <div class='card-body bg-secondary rounded mt-3 border border-white'>
        <p class='card-text'>$detay</p>
            <br>
            <p class='card-text'> <b>$fiyat TL</b></p>
    
            <a href='sepet.php?id=".$idsepet."' class='btn btn-success'>Sepete Ekle</a>
    
        </div>
        <div class='card-footer'> 
        <form class=' container-fluid' action='yorumKayit.php?id=".$id."' method='post'> 
        <div class='row mt-2 '>            
            <div class = 'col-sm-12 h-100 p-5 border'>
                    <select class='form-control w-100 d-inline' name='puan'>
                        <option value='1'>1 Puan</option>
                        <option value='2'>2 Puan</option>
                        <option value='3'>3 Puan</option>
                        <option value='4'>4 Puan</option>
                        <option value='5'>5 Puan</option>
                    </select>
                    <input class='form-control mt-3 h-100' type='textarea' name='mesaj' placeholder='yorumunuzu girin.'> 
                    <input type='submit' value='Kaydet' class='btn btn-primary mt-3 btn-sm'>
            </div> 
            
        </div> 
        </form>
        </div>
    
    
    </div> 
    ";
    
}

$urunyorumSorgu = "SELECT * FROM yorumlar Where UrunID = $id";
$yorumlarGetir = $baglanti->query($urunyorumSorgu);
$sayac = 0;
$urunPuanTop = 0;
$urunYorumlarOrt = 0;

if (mysqli_num_rows($yorumlarGetir)>0) {
    $urunyorumlar .="
        <div class='card text-dark p-5' id='marg' style='width: 48rem;'>

        <h2 class='card-title text-center mt-4'>Yorumlar</h2>
        <div class='card-body bg-secondary rounded mt-3 border border-white'>";
    while ($yorumlarCikti = $yorumlarGetir->fetch_array()) {

        $sayac +=1;
        $urunPuanTop += $yorumlarCikti['UrunPuan'];
        $urunyorumlar .="
    
            <div class='card-text text-white border border-dark p-3 rounded'>
            <p>$yorumlarCikti[Mesaj]</p>
            </div>
            <div class='card-footer text-white  p-3'>
            <p>$yorumlarCikti[KullaniciAd] -> rumuzlu kullanıcı tarafından yazıldı.</p>
            <a class='btn btn-dark btn-sm' style='margin-top:0.2rem;' href='/ProjeE-ticaret/anaIslemler/yorumBildir.php?id=$yorumlarCikti[ID]'>Yorumu Bildir</a>
            </div>
                <br>
    
        
        ";
    }

    
    if ($sayac!=0) {
        $urunYorumlarOrtDeğer = $urunPuanTop/$sayac;

        $urunYorumlarOrt .="
        <div class='card text-dark p-5' id='margPuan' style='width: 48rem;'>
        <p>Ürünün Puan Ortalaması = $urunYorumlarOrtDeğer</p>        
        </div>";
    }


    if ($urunYorumlarOrt == NAN) {
        $urunYorumlarOrt = "Herhangi bir oy kaydı bulunamadı.";
    }
}else {
    $urunyorumlar .="";
    $urunYorumlarOrt .="";
}



echo    " <div>
    
        $html
        $urunYorumlarOrt
        $urunyorumlar
        </div>
        </div>
        <link rel='stylesheet' type='text/css' href='uruneGit.css' >

</div>";


$sorgu->close();
$baglanti->close();

?>


<?php include("../includes/footer.php"); }else {
    echo "giris yapin $_SESSION[id] $_SESSION[kullaniciAd]$_SESSION[sifre] ";
}  
?>