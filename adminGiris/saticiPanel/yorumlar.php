<?php
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {

    function yorumlar(){
        $id = $_SESSION["saticiID"];
        include("../../includes/baglanti.php");
        $sorgu = "SELECT y.ID,y.KullaniciAd,y.Mesaj,y.YorumTarih,y.UrunID From yorumlar y  INNER JOIN urunler u ON  y.UrunID = u.ID Where u.UrunEkleyenID = $id";
        
        $sonuc = $baglanti->query($sorgu);
        $html ="";

        while ($cikti = $sonuc->fetch_assoc()) {
            $urunSorgu = "SELECT UrunAdi From urunler Where ID = $cikti[UrunID]";
            $urunSonuc = $baglanti->query($urunSorgu);
            while ($urunCikti = $urunSonuc->fetch_assoc()) {
                $urunAd = $urunCikti['UrunAdi'];
            }
            

            $html .= "<tr>
                        <td>$cikti[KullaniciAd]</td>
                        <td>$cikti[Mesaj]</td>
                        <td>$cikti[YorumTarih]</td>
                        <td>$urunAd</td>  
                        <td><a class='btn btn-danger' href='/ProjeE-ticaret/adminGiris/saticiPanel/yorumBildir.php?id=$cikti[ID]'>Yorumu Bildir</a></td>
                     </tr>                      
                     ";
        }
        echo $html;
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
                        <li class="active"><a href="/ProjeE-ticaret/adminGiris/saticiPanel/yorumlar.php">Yorumlar</a></li>
                        <li><a href="/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php">Ürün İşlemleri</a></li>
                        <li><a class="btn btn-danger" href="/ProjeE-ticaret/adminGiris/cikis.php">Çıkış Yap</a></li>
                    </ul><br>
                </div>
                <br>

                <div class="col-sm-9">
                    <div class="well">
                        <h4>Yorumları İnceleyin</h4>
                        <strong>Sayın " <?php echo $_SESSION['saticiAd'] ?> " rumuzlu satıcımız , satışlarınıza gelen yorumları incelemek için bu sayfayı kullanabilirsiziniz. </strong>
                    </div>
                    <div class="row well " style="margin: 0.05rem; padding-bottom: 1rem;">
                        <div class="col-sm-12">
                            <div class="well" style="height:35rem;overflow:scroll;">
                                <div>
                                    
                                <h1 class="text-center"><strong>Yorumlar</strong></h1>
                                    <table class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kullanıcı</th>
                                                <th scope="col">Yorum</th>
                                                <th scope="col">Tarih</th>
                                                <th scope="col">Ürün</th>
                                                <th scope="col">Bildir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php yorumlar() ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                <div class="well text-center">
                                    <div>
                                        <h3>Hata veya öneriler için iletişim</h3>
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