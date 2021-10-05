<?php
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    function urunler()
    {
        include("../../includes/baglanti.php");
        $saticiID = $_SESSION["saticiID"];

        $sorgu = "SELECT u.ID,u.UrunAdi,u.UrunEklemeTarihi,u.UrunStok,u.UrunFiyat From urunler u INNER JOIN kullanicilar k ON u.UrunEkleyenID = k.ID Where UrunEkleyenID = $saticiID";
        $sonuc = $baglanti->query($sorgu);
        $html = "";
        while ($cikti = $sonuc->fetch_assoc()) {
            $html .= "<tr>
            <td>$cikti[UrunAdi]</td>
            <td>$cikti[UrunEklemeTarihi]</td>
            <td>$cikti[UrunFiyat]</td>
            <td>$cikti[UrunStok]</td>  
            <td>
            <a class='btn btn-info' href='/ProjeE-ticaret/adminGiris/saticiPanel/urunGuncelle.php?id=$cikti[ID]'>Fotoğraf, açıklama vb. değişimler için burayı kullanın.</a>
            <a class='btn btn-danger' style='margin-top:0.5rem;' href='/ProjeE-ticaret/adminGiris/saticiPanel/urunSil.php?id=$cikti[ID]'>Ürünü Sil</a>
            </td>
         </tr>";
        }
        echo $html;
        $baglanti->close();
        $sonuc->close();
    }

    function satistakiUrunSayisi()
    {
        include("../../includes/baglanti.php");
        $saticiID = $_SESSION["saticiID"];
        $sorgu = "SELECT COUNT(*) as toplam From urunler u INNER JOIN kullanicilar k ON u.UrunEkleyenID = k.ID Where UrunEkleyenID = $saticiID  ";

        $sonuc = $baglanti->query($sorgu);
        while ($cikti = $sonuc->fetch_assoc()) {
            echo $cikti['toplam'];
        }
        $baglanti->close();
        $sonuc->close();
    }

    function urunStokSayisi()
    {
        include("../../includes/baglanti.php");
        $saticiID = $_SESSION["saticiID"];
        $sorgu = "SELECT SUM(UrunStok) as toplam From urunler u INNER JOIN kullanicilar k ON u.UrunEkleyenID = k.ID Where UrunEkleyenID = $saticiID  ";
        $sonuc = $baglanti->query($sorgu);
        while ($cikti = $sonuc->fetch_assoc()) {
            echo $cikti['toplam'];
        }
    }

    function kategoriler(){
        include("../../includes/baglanti.php");
        $sorgu = "SELECT * From urunkategoriler";
        $sonuc = $baglanti->query($sorgu);
        $html = "";
        while ($cikti = $sonuc->fetch_assoc()) {
            $id = $cikti['ID'];
            if ($cikti['UstID']!=null) {
                $id =$cikti['UstID'];
            }
            $html .="                                 
                        <option value='$id'>$cikti[KategoriBaslik]</option>                
            ";
        }
        echo "<select class='form-control w-50 d-inline' name='urunKategoriID'>
        <option value='' selected disabled hidden>Kategoriyi Seçiniz.</option>
        $html
        </select>
        ";
    }

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

            input {
                margin-top: 0.1rem;
                margin-bottom: 2rem;
            }
        </style>
    </head>

    <body>

        <nav class="navbar navbar-inverse visible-xs">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p class="navbar-brand">Satıcı Paneli</p>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Dashboard</a></li>
                        <li><a href="#">Age</a></li>
                        <li><a href="#">Gender</a></li>
                        <li><a href="#">Geo</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav hidden-xs">
                    <h2>Satıcı Paneli</h2>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="/ProjeE-ticaret/adminGiris/saticiPanel/saticiPanel.php">Anasayfa</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/saticiPanel/profil.php">Satıcı Profili İşlemleri</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/saticiPanel/yorumlar.php">Yorumlar</a></li>
                        <li class="active"><a href="/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php">Ürün İşlemleri</a></li>
                        <li><a class="btn btn-danger" href="/ProjeE-ticaret/adminGiris/cikis.php">Çıkış Yap</a></li>
                    </ul><br>
                </div>
                <br>

                <div class="col-sm-9">
                    <div class="well">
                        <h4>Hoş Geldiniz</h4>
                        <strong>Sayın <?php echo $_SESSION['saticiAd'] . " rumuzlu satıcımız , iyi satışlar dileriz..." ?></strong>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="well">
                                <h4>Satıştaki Ürün Sayısı</h4>
                                <p><?php satistakiUrunSayisi() ?></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="well">
                                <h4>Ürün Stoğu Sayısı</h4>
                                <p><?php urunStokSayisi() ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row well " style="margin: 0.05rem; padding-bottom: 1rem;">
                        <h1 class="text-center">Ürün Ekleyin</h1>
                        <div style="border:  1px dotted gray; margin-bottom: 4rem; margin-top: 2rem"></div>
                        <form action="fotoEkle.php" method="post">
                            <div class="col-sm-6">

                                <label for="urunAd">Ürün Adı</label>
                                <input type="text" class="form-control" placeholder="Ör. Samsung GALAXY S3 Beyaz" name="urunAd">
                                <label for="fiyat">Fiyat</label>
                                <input type="text" class="form-control" placeholder="Ör. :35 TL" name="fiyat">
                                <label for="stok">Stok</label>
                                <input type="text" class="form-control" placeholder="Ör. : '25'" name="stok">

                            </div>
                            <div class="col-sm-6">
                                
                                <label for="urunDetay">Ürün Detayları</label>
                                <input type="textarea" class="form-control" style="height:5rem;" placeholder="Ürün Detaylarını girin." name="urunDetay">
                                <?php kategoriler() ?>

                            </div>
                            <input type="submit" class="btn btn-success form-control" value="Fotoğraf Eklemeye Geçin.">
                        </form>
                    </div>
                    <div class="row" style="margin-top: 2rem;">
                        <div class="col-sm-12">
                            <div class="well text-center">
                                <div class="well" style="height:38rem;overflow:scroll;">
                                    <div>

                                        <h1 class="text-center"><strong>Ürünler</strong></h1>
                                        <table class="table table-dark table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Ürün Adı</th>
                                                    <th scope="col">Tarih</th>
                                                    <th scope="col">Stok</th>
                                                    <th scope="col">Fiyat</th>
                                                    <th>Diğer İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php urunler() ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="well text-center">
                                <div>
                                    <h3>İletişim için mail adresi</h3>
                                    <a href="mailto:hamzarslan34@gmail.com">hamzarslan34@gmail.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>




<?php
}
?>