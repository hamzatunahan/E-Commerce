<?php 

session_start();
ob_start();
if (isset($_SESSION['adminID'], $_SESSION['adminAd']) || isset($_SESSION['saticiAd'], $_SESSION['saticiID'])) {
    

    echo "
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
</head>

<body style='background-color: lightslategrey;'>


    <nav class='p-3 border-5 border-bottom border-dark' style='background-color: #786569;'>

        <div class='row container-fluid'>


            <div class='col-sm-1'>
             
                    <a class='btn btn-secondary ' href='/ProjeE-ticaret/anaIslemler/anasayfa.php'>Ana Sayfa</a>
                
            </div>
            
            <div class='col-sm-9'>
                
            
            </div>
            <div class='col-sm-1'>

               
            <a class='btn btn-danger ' href='/ProjeE-ticaret/adminGiris/cikis.php'>Çıkış Yap</a>
               
            </div>
            <div class='col-sm-1'>

               
            <a class='btn btn-warning ' href='/ProjeE-ticaret/anaIslemler/sepetListele.php'>Sepete Git</a>
               
            </div>




        </div>



    </nav>
    ";


}elseif (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {
    

    echo "
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
  <script type='text/javascript' src='jquery-3.6.0.min.js'></script>
</head>

<body style='background-color: lightslategrey;'>


    <nav class='p-3 border-5 border-bottom border-dark' style='background-color: #786569;'>

        <div class='row container-fluid '>


            <div class='col-sm-3' style='margin-top:auto; margin-bottom:auto;'>
             
                    <a class='btn btn-secondary d-inline p-3'  href='/ProjeE-ticaret/anaIslemler/anasayfa.php'>Ana Sayfa</a>
                    <a class='btn btn-secondary d-inline p-3'  href='/ProjeE-ticaret/adminGiris/profilIslem/profil.php'>Profili Düzenle</a>

            </div>
            
            <div class='col-sm-7'>
                
            
            </div>
            <div class='col-sm-1'>

               
            <a class='btn btn-danger ' href='/ProjeE-ticaret/adminGiris/cikis.php'>Çıkış Yap</a>
               
            </div>
            <div class='col-sm-1'>

               
            <a class='btn btn-warning ' href='/ProjeE-ticaret/anaIslemler/sepetListele.php'>Sepete Git</a>
               
            </div>




        </div>



    </nav>
    ";

}else {
    echo "
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
    </head>
    
    <body style='background-color: lightslategrey;'>
    
    
        <nav class='p-3 border-5 border-bottom border-dark' style='background-color: #786569;'>
    
            <div class='row container-fluid'>
    
    
                <div class='col-sm-1'>
                 
                        <a class='btn btn-secondary ' href='/ProjeE-ticaret/anaIslemler/anasayfa.php'>Ana Sayfa</a>
                    
                </div>
                <div class='col-sm-1'>
                    
         <a class='btn btn-secondary ' href='/ProjeE-ticaret/adminGiris/adminGiris.php'>Giriş & Üyelik</a>
                    
                </div>
                <div class='col-sm-10'>
                    
                
                </div>
    
    
    
    
            </div>
    
    
    
        </nav>
        ";

}


?>


    