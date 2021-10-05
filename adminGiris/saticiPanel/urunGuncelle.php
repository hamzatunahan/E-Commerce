<?php
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    $id = $_GET['id'];
    include("../../includes/baglanti.php");
    $saticiID = $_SESSION["saticiID"];
    $sorgu = "SELECT ID,UrunAdi,UrunEklemeTarihi,UrunStok,UrunFiyat From urunler Where ID=$id";
    $sonuc = $baglanti->query($sorgu);
    while ($cikti = $sonuc->fetch_assoc()) {
        $ciktiID = $cikti['ID'];
        $urun = $cikti['UrunAdi'];
        $tarih = $cikti['UrunEklemeTarihi'];
        $fiyat = $cikti['UrunFiyat'];
        $stok = $cikti['UrunStok'];
    }

    function resimler()
    {
        $id = $_GET['id'];
        include("../../includes/baglanti.php");

        $sorgu = "SELECT ur.ID,u.UrunAdi,u.UrunFiyat,u.UrunDetay,ur.ResimURL,ur.ResimIndex,ur.AnaResimIndex From urunler u 
        INNER JOIN urunResimler ur ON u.ID = ur.UrunID Where u.ID = $id";
    
        $sonuc = $baglanti->query($sorgu);

        $ekleme = false;
        if (mysqli_num_rows($sonuc) < 3) {
            $ekleme = true;
        } else {
            $ekleme = false;
        }

        $html = "";
        $selectIcerik = "";

        if (!$ekleme) {

            while ($cikti = $sonuc->fetch_assoc()) {
                
                if ($cikti['ResimIndex'] == 1) {
                    $selectedMi="";
                    if($cikti['AnaResimIndex']==1){
                        $selectedMi="checked";
                    }else {
                        $selectedMi="";
                    }
                    $html .= "  
        
                <div class='col-md text-center'>
                <img class='rounded mx-auto' height='200rem' width='300rem' src='../$cikti[ResimURL]' alt='Ürün Resmi'>   
                    <div class='mt-3'> 
                    <div class='form-check'>
                    <input class='form-check-input' type='radio'  name='secim' $selectedMi  value='$cikti[ResimIndex]'>
                    <label class='form-check-label' for='flexRadioDefault1'>
                      Ana Resim
                    </label>
                  </div>   
                        <div>
                        <a class='btn btn-danger mt-3' href='resimSil.php?id=$cikti[ID]'>Resmi Sil</a>
                        </div>
                    </div>
                </div>
            ";
                } else if ($cikti['ResimIndex'] == 2) {
                    $selectedMi="";
                    if($cikti['AnaResimIndex']==1){
                        $selectedMi="checked";
                    }else {
                        $selectedMi="";
                    }
                    $html .= "  
        
                <div class='col-md text-center'>
                <img class='rounded mx-auto' height='200rem' width='300rem' src='../$cikti[ResimURL]' alt='Ürün Resmi'>   
                    <div class='mt-3'> 
                    <div class='form-check'>
                    <input class='form-check-input' type='radio' name='secim' $selectedMi value='$cikti[ResimIndex]' >
                    <label class='form-check-label' for='flexRadioDefault1'>
                      Ana Resim
                    </label>
                  </div>   
                        <div>
                        <a class='btn btn-danger mt-3' href='resimSil.php?id=$cikti[ID]'>Resmi Sil</a>
                        </div>
                    </div>
                </div>
            ";
                } else if ($cikti['ResimIndex'] == 3) {
                    $selectedMi="";
                    if($cikti['AnaResimIndex']==1){
                        $selectedMi="checked";
                    }else {
                        $selectedMi="";
                    }
                    $html .= "  
        
                <div class='col-md text-center'>
                <img class='rounded mx-auto' height='200rem' width='300rem' src='../$cikti[ResimURL]' alt='Ürün Resmi'>   
                    <div class='mt-3'> 
                    <div class='form-check'>
                    <input class='form-check-input' type='radio' name='secim' $selectedMi value='$cikti[ResimIndex]'>
                    <label class='form-check-label' for='flexRadioDefault1'>
                      Ana Resim
                    </label>
                  </div>   
                        <div>
                        <a class='btn btn-danger mt-3' href='resimSil.php?id=$cikti[ID]'>Resmi Sil</a>
                        </div>
                    </div>
                </div>
            ";
                }
            };
            echo $html;
        } else {


            while ($cikti = $sonuc->fetch_assoc()) {
                
                if ($cikti['ResimIndex'] == 1) {
                    $selectedMi="";
                    if($cikti['AnaResimIndex']==1){
                        $selectedMi="checked";
                    }else {
                        $selectedMi="";
                    }
                    $html .= "  
        
                <div class='col-md text-center'>
                <img class='rounded mx-auto' height='200rem' width='300rem' src='../$cikti[ResimURL]' alt='Ürün Resmi'>   
                    <div class='mt-3'> 
                    <div class='form-check'>
                    <input class='form-check-input' type='radio' name='secim' $selectedMi value='$cikti[ResimIndex]'>
                    <label class='form-check-label' for='secim'>
                      Ana Resim
                    </label>
                  </div>   
                        <div>
                        <a class='btn btn-danger mt-3' href='resimSil.php?id=$cikti[ID]'>Resmi Sil</a>
                        </div>
                    </div>
                </div>
            ";
                } else if ($cikti['ResimIndex'] == 2) {
                    $selectedMi="";
                    if($cikti['AnaResimIndex']==1){
                        $selectedMi="checked";
                    }else {
                        $selectedMi="";
                    }
                    $html .= "  
        
                <div class='col-md text-center'>
                <img class='rounded mx-auto' height='200rem' width='300rem' src='../$cikti[ResimURL]' alt='Ürün Resmi'>   
                    <div class='mt-3'> 
                    <div class='form-check'>
                    <input class='form-check-input' type='radio' name='secim' $selectedMi value='$cikti[ResimIndex]'>
                    <label class='form-check-label' for='flexRadioDefault1'>
                      Ana Resim
                    </label>
                  </div>   
                        <div>
                        <a class='btn btn-danger mt-3' href='resimSil.php?id=$cikti[ID]'>Resmi Sil</a>
                        </div>
                    </div>
                </div>
            ";
                } else if ($cikti['ResimIndex'] == 3) {
                    $selectedMi="";
                    if($cikti['AnaResimIndex']==1){
                        $selectedMi="checked";
                    }else {
                        $selectedMi="";
                    }
                    $html .= "  
        
                <div class='col-md text-center'>
                <img class='rounded mx-auto' height='200rem' width='300rem' src='../$cikti[ResimURL]' alt='Ürün Resmi'>   
                    <div class='mt-3'> 
                    <div class='form-check'>
                    <input class='form-check-input' type='radio' name='secim' $selectedMi value='$cikti[ResimIndex]' >
                    <label class='form-check-label' for='flexRadioDefault1'>
                      Ana Resim
                    </label>
                  </div>    
                        <div>
                        <a class='btn btn-danger mt-3' href='resimSil.php?id=$cikti[ID]'>Resmi Sil</a>
                        </div>
                    </div>
                </div>
            ";
                }
            };
            echo "
            $html
            <div class='col-md text-center ' style='margin:auto;'>
            <a class='btn btn-primary' href='resimEkle.php?id=$id'>
            Resim Ekle
            </a>
            </div>   
            ";
        }
    }

?>




    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Proje E- ticaret</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
        <style>
            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
            .row.content {
                height: 550px
            }

            /* Set gray background color and 100% height */
            .sidenav {
                background-color: #f1f1f1;
                height: 100%;
            }

            /* On small screens, set height to 'auto' for the grid */
            @media screen and (max-width: 767px) {
                .row.content {
                    height: auto;
                }
            }
        </style>
    </head>

    <body style="background-color: lightgreen;">
        <div class="container mt-5 mb-5">


            <form action="urunUpdate.php?id=<?php echo $id ?>" method="post">
                <div class="form-group">
                    <label for="kullID">Ürün ID</label>
                    <input type="text" class="form-control" disabled value="<?php echo $id; ?>">
                </div>
                <div class="form-group">
                    <label for="urun">Ürün Adı</label>
                    <input type="text" name="urun" class="form-control" value="<?php echo $urun; ?>">
                </div>
                <div class="form-group">
                    <label for="tarih">Ekleme Tarihi</label>
                    <input type="text" name="tarih" class="form-control" disabled value="<?php echo $tarih; ?>">
                </div>
                <div class="form-group">
                    <label for="fiyat">Fiyat</label>
                    <input type="text" name="fiyat" class="form-control" value="<?php echo $fiyat; ?>">
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" name="stok" class="form-control" value="<?php echo $stok; ?>">
                </div>
                <h2>Ürün Resimleri</h2>
                <h4 style="color: #EE5847;">En fazla 3 ürün fotoğrafı ekleyebilirsiniz.</h4>
                <h5 style="color: #EE5847;">Seçilen ana resim anasayfada gözüken ürünün kapak fotoğrafı olarak gözükecektir</h5>
                <div class="container row jumbotron mx-auto">
                    <?php resimler() ?>
                </div>
                <input type="submit" class="btn btn-success mt-3" value="Güncelle"></input>
            </form>

        </div>
    </body>


<?php
}
?>