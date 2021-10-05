<?php include("../includes/header.php"); ?>



<?php



if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {
    include("../includes/baglanti.php");

    $kullid = $_SESSION['id'];
    $sorgu = "SELECT
    su.ID,
	su.SepetID,
	s.KullaniciID,
	u.UrunAdi ,
	su.UrunAdet,
	su.UrunFiyat
    FROM
	sepeturunu AS su
	INNER JOIN urunler AS u ON su.UrunID = u.ID
	INNER JOIN sepet AS s ON s.ID = su.SepetID
    Where s.KullaniciID = $kullid
";
    $html = "";
    $fiyatToplam =0;
    $IDtext = "ID";
    
    $sonuc = $baglanti->query($sorgu);

   
    while ($cikti = $sonuc->fetch_array()) {
        $html .="
        <tr>
                    <td>$cikti[UrunAdi]</td>
                    <td>
                    <form action='adetDegis.php?id=".$cikti[$IDtext]."' method='post'>
                    <select class='form-control w-50 d-inline' name='adetValue'>
                        <option value='' selected disabled hidden>Mevcut miktar $cikti[UrunAdet]</option>
                        <option value='1'>1 Adet</option>
                        <option value='2'>2 Adet</option>
                        <option value='3'>3 Adet</option>
                        <option value='4'>4 Adet</option>
                        <option value='5'>5 Adet</option>
                        <option value='6'>6 Adet</option>
                        <option value='7'>7 Adet</option>
                        <option value='8'>8 Adet</option>
                        <option value='9'>9 Adet</option>
                        <option value='10'>10 Adet</option>
                    </select>
                    <input type='submit' class='btn btn-success btn-md mb-1' value='Kaydet'>
                </form>
                    </td>
                    <td>$cikti[UrunFiyat]</td>
                    <td><a class='btn btn-danger' href='sepettenSil.php?id=".$cikti[$IDtext]."'>Sil</a></td>
                </tr>
        ";
    }

    $sorguFiyat = "SELECT
	su.UrunAdet,
	su.UrunFiyat
    FROM
	sepeturunu AS su
	INNER JOIN urunler AS u ON su.UrunID = u.ID
	INNER JOIN sepet AS s ON s.ID = su.SepetID
    Where s.KullaniciID = $kullid
";

    $fiyatSonuc = $baglanti->query($sorguFiyat);

    while ($fiyatCikti = $fiyatSonuc->fetch_array()) {
        $fiyatToplam += $fiyatCikti['UrunAdet']*$fiyatCikti['UrunFiyat'];
    }






    echo "
    <div class='container-fluid row'>

    <div class='col-md-8 mt-4' style='height:100%;'>
        <table class='table table-dark table-hover '>
            <thead>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Miktarı Düzenleyin</th>
                    <th>Adet Fiyatı</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
            $html            
            </tbody>
        </table>
    </div>
    <div class='col-md-4 mt-4'>
        <div class='border border-light text-center' style='height:20rem;'>
            <a href='' class='btn btn-primary btn-md d-block p-3'>Alışverişi Tamamla</a>
            <h4 class='text-white mt-5'>
                Ürünlerin Toplam Fiyatı
            </h4>
            <h3 class='text-white mt-5'>
            $fiyatToplam
            </h3>
        </div>
    </div>

</div>

<link rel='stylesheet' type='text/css' href='template.css'>

    ";

}


?>


<?php include("../includes/footer.php");   ?>