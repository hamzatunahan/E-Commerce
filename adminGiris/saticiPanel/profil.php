<?php
session_start();
ob_start();

if (isset($_SESSION["saticiAd"], $_SESSION["saticiID"])) {
  $id = $_SESSION["saticiID"];
  include("../../includes/baglanti.php");
  $sorgu = "SELECT * From kullanicilar Where ID = $id";  
  $sonuc = $baglanti->query($sorgu);
  while ($cikti = $sonuc->fetch_assoc()) {
    $adVal = $cikti['KullaniciAd'];
    $emailVal = $cikti['KullaniciEmail'];
    $rumuzVal = $cikti['KullaniciRumuz'];
  }


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

  function yorumSayisi()
  {
    include("../../includes/baglanti.php");
    $saticiID = $_SESSION["saticiID"];
    $sorgu = "SELECT COUNT(*) as toplam From urunler u INNER JOIN kullanicilar k ON u.UrunEkleyenID = k.ID INNER JOIN yorumlar y ON y.UrunID = u.ID Where UrunEkleyenID = $saticiID";
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
    $sorgu = "SELECT UrunAdi,UrunStok From urunler";
    $sonuc = $baglanti->query($sorgu);
    $html  = "";
    while ($cikti = $sonuc->fetch_assoc()) {
      $html .= "<tr>
                  <td>$cikti[UrunAdi]</td>
                  <td>$cikti[UrunStok]</td>
               </tr>";
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

      input{
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
            <li class="active"><a href="/ProjeE-ticaret/adminGiris/saticiPanel/profil.php">Satıcı Profili İşlemleri</a></li>
            <li><a href="/ProjeE-ticaret/adminGiris/saticiPanel/yorumlar.php">Yorumlar</a></li>
            <li><a href="/ProjeE-ticaret/adminGiris/saticiPanel/urunler.php">Ürün İşlemleri</a></li>
            <li><a class="btn btn-danger" href="/ProjeE-ticaret/adminGiris/cikis.php">Çıkış Yap</a></li>
          </ul><br>
        </div>
        <br>

        <div class="col-sm-9">
          <div class="well">
            <h4>Profil Düzenle</h4>
            <strong>Sayın <?php echo $_SESSION['saticiAd'] . " rumuzlu satıcımız , satıcı profiliyle alakalı işlemleriniz için bu sayfayı kullanabilirsiziniz." ?></strong>
          </div>
          <div class="row well " style="margin: 0.05rem; padding-bottom: 1rem;">
            <h1 class="text-center">Satıcı Profilinizi Düzenleyin</h1>
            <div style="border:  1px solid gray; margin-bottom: 4rem; margin-top: 2rem" ></div>
            <form action="profilGuncelle.php?id=<?php echo $id ?>" method="post">
              <div class="col-sm-6">

                <label for="kAd">Adınız</label>
                <input type="text" class="form-control" name="kAd" value="<?php echo $adVal ?>">
                <label for="kEmail">E-mail</label>
                <input type="email" class="form-control" name="kEmail" value="<?php echo $emailVal ?>">                

              </div>
              <div class="col-sm-6">

                <label for="kRumuz">Satıcı Dükkan Adı</label>
                <input type="text" class="form-control" name="kRumuz" value="<?php echo $rumuzVal ?>">           
                <label>Şifre</label>
                <a class="btn btn-warning form-control" style="display: block;" href="sifre.php?id=<?php echo $id ?>">Şifre işlemleri için tıklayın.</a>

              </div>
              <input type="submit" class="btn btn-success form-control" value="Değişiklikleri Kaydet">
            </form>
          </div>
          <div class="row" style="margin-top: 2rem;">
            <div class="col-sm-12">
              <div class="well text-center">
                <div>
                  <h3>Hata veya öneriler için iletişim</h3>
                  <a href="mailto:erhanasik8@gmail.com">erhanasik8@gmail.com</a>
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