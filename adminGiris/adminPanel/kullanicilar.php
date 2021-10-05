<?php
session_start();
ob_start();

if (isset($_SESSION["adminAd"], $_SESSION["adminID"])) {

    function kullaniciSayisi()
    {
        include("../../includes/baglanti.php");
        $sorgu = "SELECT COUNT(*) as toplam From kullanicilar";
        $sonuc = $baglanti->query($sorgu);
        while ($cikti = $sonuc->fetch_assoc()) {
            echo $cikti['toplam'];
        }
        $baglanti->close();
        $sonuc->close();
    }


    function saticiSayisi()
    {
        include("../../includes/baglanti.php");
        $sorgu = "SELECT COUNT(*) as toplam From kullanicilar Where KullaniciDurum = 1";
        $sonuc = $baglanti->query($sorgu);
        while ($cikti = $sonuc->fetch_assoc()) {
            echo $cikti['toplam'];
        }
        $baglanti->close();
        $sonuc->close();
    }

    function kullanicilar()
    {
        include("../../includes/baglanti.php");
        $sorgu = "SELECT ID,KullaniciAd,KullaniciDurum,KullaniciYetki From kullanicilar";
        $sonuc = $baglanti->query($sorgu);
        $html = "";
        while ($cikti = $sonuc->fetch_assoc()) {
            $durum = "";
            $yetki = "";


            if ($cikti['KullaniciDurum'] == 1) {
                $durum = "Satış yetkisi <strong>VAR</strong>.";
            } else {
                $durum = "Satış yetkisi <strong>YOK</strong>.";
            }

            if ($cikti['KullaniciYetki'] == 1) {
                $yetki = "Admin erişimi <strong>VAR</strong>.";
            } else {
                $yetki = "Admin erişimi <strong>YOK</strong>.";
            }

            $html .= "<tr>
                  <td>$cikti[KullaniciAd]</td>
                  <td>$durum</td>
                  <td>$yetki</td>
                  <td><a class='btn btn-info' href='/ProjeE-ticaret/adminGiris/adminPanel/kullaniciGuncelle.php?id=$cikti[ID]'>Güncelle</a></td> 
                  <td><a class='btn btn-danger' href='/ProjeE-ticaret/adminGiris/adminPanel/kullaniciSil.php?id=$cikti[ID]'>Sil</a></td>
               </tr>";
        }

        echo $html;
    }


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Admin Panel</title>
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
                    <p class="navbar-brand">Admin Paneli</p>
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
                    <h2>Admin Paneli</h2>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="/ProjeE-ticaret/adminGiris/adminPanel/adminPanel.php">Anasayfa</a></li>
                        <li class="active"><a href="/ProjeE-ticaret/adminGiris/adminPanel/kullanicilar.php">Kullanıcı İşlemleri</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/adminPanel/yorumlar.php">Yorum İşlemleri</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/adminPanel/urunler.php">Ürün İşlemleri</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/adminPanel/kategoriler.php">Kategori İşlemleri</a></li>
                        <li><a class="btn btn-danger" href="/ProjeE-ticaret/adminGiris/cikis.php">Çıkış Yap</a></li>
                    </ul><br>
                </div>
                <br>

                <div class="col-sm-9">
                    <div class="well">
                        <h4>İyi günler dileriz...</h4>
                        <strong>Sayın <?php echo $_SESSION['adminAd'] . " rumuzlu yönetici..." ?></strong>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="well">
                                <h4>Kullanıcı Sayısı</h4>
                                <p><?php kullaniciSayisi() ?></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="well">
                                <h4>Satıcı Sayısı</h4>
                                <p><?php saticiSayisi() ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="well" style="height:35rem;overflow:scroll;">
                                <div>
                                    <h3 class="text-center"><strong>Kullanıcı İşlemleri Tablosu</strong></h3>
                                    <table class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kullanıcı Adı</th>
                                                <th scope="col">Durum</th>
                                                <th scope="col">Yetki</th>
                                                <th scope="col">Güncelle</th>
                                                <th scope="col">Sil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php kullanicilar() ?>
                                        </tbody>
                                    </table>
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