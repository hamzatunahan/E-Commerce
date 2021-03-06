<?php
session_start();
ob_start();

if (isset($_SESSION["adminAd"], $_SESSION["adminID"])) {

    function urunSayisi()
    {
        include("../../includes/baglanti.php");
        $sorgu = "SELECT COUNT(*) as toplam From urunler";
        $sonuc = $baglanti->query($sorgu);
        while ($cikti = $sonuc->fetch_assoc()) {
            echo $cikti['toplam'];
        }
        $baglanti->close();
        $sonuc->close();
    }

    function kategoriSayisi()
    {
        include("../../includes/baglanti.php");
        $sorgu = "SELECT COUNT(*) as toplam From urunKategoriler";
        $sonuc = $baglanti->query($sorgu);
        while ($cikti = $sonuc->fetch_assoc()) {
            echo $cikti['toplam'];
        }
        $baglanti->close();
        $sonuc->close();
    }

    function selectIcerik(){
    

        include("../../includes/baglanti.php");
        $sorgu = "SELECT * From urunkategoriler";
        $sonuc = $baglanti->query($sorgu);
        $html = "";
        while ($cikti = $sonuc->fetch_array()) {
            $html ="
            <option value='$cikti[ID]'>$cikti[KategoriBaslik]</option>            
            ";
            echo $html;
        }

        
    }

    function kategoriler()
    {
        include("../../includes/baglanti.php");
        $sorgu = "SELECT ID,KategoriBaslik,KategoriAciklama,UstID From urunkategoriler";
        $sonuc = $baglanti->query($sorgu);
        $html = "";
        while ($cikti = $sonuc->fetch_assoc()) {
            
            $ustKategoriText = "";
            if (isset($cikti['UstID'])) {
                
                
                $ustSorgu = "SELECT KategoriBaslik From urunkategoriler Where ID = $cikti[UstID] ";
                $ustSonuc = $baglanti->query($ustSorgu);
                while ($ustCikti = $ustSonuc->fetch_assoc()) {
                    $ustKategoriText .= $ustCikti["KategoriBaslik"];
                }
            }

            $html .= "<tr>
                  <td>$cikti[KategoriBaslik]</td>
                  <td>$cikti[KategoriAciklama]</td>
                  <td>$ustKategoriText</td>
                  <td><a class='btn btn-info' href='/ProjeE-ticaret/adminGiris/adminPanel/kategoriGuncelle.php?id=$cikti[ID]'>G??ncelle</a></td> 
                  <td><a class='btn btn-danger' href='/ProjeE-ticaret/adminGiris/adminPanel/kategoriSil.php?id=$cikti[ID]'>Sil</a></td>
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
                        <li><a href="/ProjeE-ticaret/adminGiris/adminPanel/kullanicilar.php">Kullan??c?? ????lemleri</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/adminPanel/yorumlar.php">Yorum ????lemleri</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/adminPanel/urunler.php">??r??n ????lemleri</a></li>
                        <li class="active"><a href="/ProjeE-ticaret/adminGiris/adminPanel/kategoriler.php">Kategori ????lemleri</a></li>
                        <li><a class="btn btn-danger" href="/ProjeE-ticaret/adminGiris/cikis.php">????k???? Yap</a></li>
                    </ul><br>
                </div>
                <br>

                <div class="col-sm-9">
                    <div class="well">
                        <h4>??yi g??nler dileriz...</h4>
                        <strong>Say??n <?php echo $_SESSION['adminAd'] . " rumuzlu y??netici..." ?></strong>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="well">
                                <h4>??r??n Say??s??</h4>
                                <p><?php urunSayisi() ?></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="well">
                                <h4>Kategori Say??s??</h4>
                                <p><?php kategoriSayisi() ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="well  text-center">

                                <h1 class="text-success">Kategori Olu??tur</h1>
                                <form action="kategoriCreate.php" method="post">
                                    <label for="kAd">Kategori Ad??</label>
                                    <input class="form-control" type="text" placeholder="Kategori Ad??" name="kAd">
                                    <label for="kAciklama">Kategori A????klamas??</label>
                                    <input class="form-control" type="textarea" placeholder="A????klama" name="kAciklama">
                                    <label for="ustKat">??st Kategorisi</label>
                                    <select class="form-control" name="ustKat">
                                        <option value='' selected disabled hidden>
                                            ??r??n bir ??st kategoriye aitse, ait oldu??u kategoriyi se??iniz.
                                        </option>
                                        <?php selectIcerik() ?>
                                    </select>
                                    <input type="submit" class="btn btn-success " value="Olu??tur">
                                </form>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="well" style="height:35rem;overflow:scroll;">
                                <div>
                                    <h3 class="text-center"><strong>Kategori ????lemleri Tablosu</strong></h3>
                                    <table class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">A????klama</th>
                                                <th scope="col">??st Kategori</th>
                                                <th scope="col">G??ncelle</th>
                                                <th scope="col">Sil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php kategoriler() ?>
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